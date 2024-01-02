<?php

namespace App\Http\Controllers;

use App\Models\Vehicles;
use App\Http\Requests\StoreVehiclesRequest;
use App\Http\Requests\UpdateVehiclesRequest;
use Illuminate\Routing\Controller as BaseController;

class VehiclesController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([Vehicles::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVehiclesRequest $request)
    {
        return response()->json([Vehicles::create($request->all())]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Vehicles $vehicles)
    {
        return response()->json(Vehicles::findOrFail($vehicles->id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVehiclesRequest $request, Vehicles $vehicles)
    {
        return response()->json(Vehicles::findOrFail($vehicles->id)->update($request->all(), $vehicles));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehicles $vehicles)
    {
        return response()->json(Vehicles::findOrFail($$vehicles->id)->delete());
    }
}
