<?php

namespace App\Http\Controllers;

use App\Models\Services;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreServicesRequest;
use App\Http\Requests\UpdateServicesRequest;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([Services::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreServicesRequest $request)
    {
        return response()->json([Services::create($request->all())]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Services $services)
    {
        return response()->json([Services::findOrFail($services->id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateServicesRequest $request, Services $services)
    {
        return response()->json([Services::findOrFail($services->id)->update($request->all())]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Services $services)
    {
        return response()->json(Services::findOrFail($services->id)->delete());
    }
}
