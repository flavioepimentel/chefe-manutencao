<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class ReviewsReportController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function reviewsByBrand()
    {
        return response()->json([
            DB::table('reviews')
                ->join('vehicles', 'vehicles.id', '=', 'reviews.vehicleId')
                ->select(DB::raw('count(reviews.*) as reviews_count, vehicles.brand'))
                ->groupBy('vehicles.brand')
                ->orderBy('reviews_count', 'desc')
                ->get()
        ]);
    }


    public function reviewsByClient()
    {
        return response()->json([
            DB::table('reviews')
                ->join('clients', 'clients.id', '=', 'reviews.clientId')
                ->select(DB::raw('count(reviews.*) as reviews_count, clients.name'))
                ->groupBy('clients.id')
                ->orderBy('reviews_count', 'desc')
                ->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function reviewsByPeriod(string $beginFilter, string $endFilter)
    {
        return response()->json([
            DB::table('reviews')
                ->whereBetween('created_at', [$beginFilter, $endFilter])
                ->orderBy('created_at', 'desc')
                ->get()
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function averageTimeBetweenReviews(int $id)
    {
        return response()->json([
            DB::table('reviews as r')
                ->where('r.clientId', $id)
                ->join('reviews as r1', function ($join) {
                    $join->on('r.clientId', '=', 'r1.clientId')
                        ->where('r.created_at', '>', DB::raw('"r1"."created_at"'));
                })
                ->join('reviews as r2', function ($join) {
                    $join->on('r.clientId', '=', 'r2.clientId')
                        ->where('r2.created_at', '>', DB::raw('"r1"."created_at"'));
                })
                ->groupBy('r.clientId')
                ->select([
                    'r.clientId',
                    DB::raw('COALESCE(Round(AVG(EXTRACT(EPOCH FROM (r2.created_at - r1.created_at)) / 86400), 0), 0) AS media_tempo_entre_revisoes'),
                ])
                ->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function predictionReviews()
    {
        $results = DB::table('reviews as r')
            ->join('clients as c', 'r.clientId', '=', 'c.id')
            ->join('vehicles as v', 'r.vehicleId', '=', 'v.id')
            ->select(
                'c.name as client_name',
                'v.brand as vehicle_brand',
                DB::raw('MAX(r.created_at) as last_review_date'),
                'sub.avg_days_between_reviews'
            )  // Add 'sub.avg_days_between_reviews' to SELECT
            ->joinSub(
                DB::table('reviews as r1')
                    ->select(
                        'r1.vehicleId',
                        DB::raw('Round(COALESCE(AVG(EXTRACT(EPOCH FROM (r1.created_at - r2.created_at)) / 86400), 60), 0) as avg_days_between_reviews')
                    )
                    ->join('reviews as r2', function ($join) {
                        $join->on('r1.clientId', '=', 'r2.clientId')
                            ->on('r1.vehicleId', '=', 'r2.vehicleId')
                            ->where('r1.created_at', '>', DB::raw('r2.created_at'));
                    })
                    ->groupBy('r1.vehicleId'),
                'sub',
                function ($join) {
                    $join->on('r.vehicleId', '=', 'sub.vehicleId');
                }
            )
            ->addSelect(
                DB::raw('(MAX(r.created_at) + (sub.avg_days_between_reviews || \' days\')::interval) as next_review_date')
            )
            ->groupBy('r.vehicleId', 'c.name', 'v.brand', 'sub.avg_days_between_reviews') // Add it to GROUP BY

            ->get();

        return response()->json($results);
    }
    public function predictionReviewsV2()
    {
        // Create a subquery for avg_days_between_reviews
        $avgDaysBetweenReviewsSubquery = DB::table('reviews as r1')
            ->select('r1.vehicleId', DB::raw('AVG(EXTRACT(EPOCH FROM (r1.created_at - r2.created_at)) / 86400) AS avg_days_between_reviews'))
            ->join('reviews as r2', function ($join) {
                $join->on('r1.vehicleId', '=', 'r2.vehicleId')
                    ->whereRaw('r1.created_at > r2.created_at');
            })
            ->groupBy('r1.vehicleId');

        // Main query
        $query = DB::table('reviews')
            ->select(
                'clients.name as client_name',
                'vehicles.brand as vehicle_brand',
                DB::raw('MAX(reviews.created_at) as last_review_date'),
                DB::raw('COALESCE(ROUND(avg_days_between_reviews, 0), 60) as avg_days_between_reviews'),
                DB::raw('(MAX(reviews.created_at) + COALESCE(ROUND(avg_days_between_reviews, 0) * INTERVAL \'1\' DAY , INTERVAL \'60\' DAY)) as next_review_date')
            )
            ->join('clients', 'reviews.clientId', '=', 'clients.id')
            ->join('vehicles', 'reviews.vehicleId', '=', 'vehicles.id')
            ->leftJoinSub($avgDaysBetweenReviewsSubquery, 'sub', 'reviews.vehicleId', '=', 'sub.vehicleId')
            ->groupBy('reviews.clientId', 'clients.name', 'reviews.vehicleId', 'vehicles.brand', 'avg_days_between_reviews');

        $results = $query->get();

        return response()->json($results);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
