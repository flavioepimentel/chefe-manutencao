<?php

namespace App\Http\Controllers;

use App\Models\Clients;
use App\Http\Requests\StoreClientsRequest;
use App\Http\Requests\UpdateClientsRequest;
use Illuminate\Routing\Controller as BaseController;

class ClientsController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            Clients::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClientsRequest $request)
    {
        return response()->json([Clients::create(["name" => $request->input("name"), "gender" => $request->input("gender"), "age" => $request->input("age")])]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Clients $clients)
    {
        return response()->json([
            Clients::findOrFail($clients->id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClientsRequest $request, Clients $clients)
    {
        return response()->json(Clients::findOrFail($clients->id)->update($request->all()));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Clients $clients)
    {
        return response()->json(Clients::findOrFail($clients->id)->delete());
    }
}
