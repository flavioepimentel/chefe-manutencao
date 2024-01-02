<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller as BaseController;


class ReportController extends BaseController
{
    /**
     * Store a newly created resource in storage.
     */
    public function index()
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
    public function show()
    {
        $query = DB::table('clients')
            ->select(DB::raw('count(*) as vehicles, gender'))
            ->groupBy('clients.gender')
            ->get();
        return response()->json([$query]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update()
    {
        $query = DB::table('vehicles')
            ->select(DB::raw('count(*) as vehicles, brand'))
            ->groupBy('vehicles.brand')
            ->get();
        return response()->json([$query]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $query = DB::table('vehicles')
            ->select(DB::raw('count(*) as vehicles, brand'), 'clients.gender')
            ->groupBy('vehicles.brand', 'clients.gender')
            ->get();
        return response()->json([$query]);
    }
}
