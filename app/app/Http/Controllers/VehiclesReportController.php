<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller as BaseController;


class VehiclesReportController extends BaseController
{
    /**
     * Store a newly created resource in storage.
     */
    public function vehicleByPerson()
    {
        $query = DB::table('vehicles')
            ->join('clients', 'clients.id', '=', 'vehicles.clientId')
            ->select('clients.name', 'vehicles.id')
            ->orderBy('clients.name')
            ->get();
        return response()->json([$query]);
    }

    /**
     * Display the specified resource.
     */
    public function vehicleByGender()
    {
        $query = DB::table('vehicles')
            ->join('clients', 'clients.id', '=', 'vehicles.clientId')
            ->select(DB::raw('count(*) as vehicles_count, clients.gender'))
            ->groupBy('clients.gender')
            ->get();
        return response()->json([$query]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function vehicleByBrand()
    {
        $query = DB::table('vehicles')
            ->select(DB::raw('count(*) as vehicles_count, brand'))
            ->groupBy('vehicles.brand')
            ->get();
        return response()->json([$query]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function vehicleByBrandGender()
    {
        $query = DB::table('vehicles')
            ->join('clients', 'clients.id', '=', 'vehicles.clientId')
            ->select('clients.gender', DB::raw('count(*) as vehicles_count, brand'))
            ->groupBy('vehicles.brand', 'clients.gender')
            ->orderBy('vehicles_count', 'desc')
            ->get();
        return response()->json([$query]);
    }
}
