<?php

namespace App\Http\Controllers;

use App\Models\Clients;
use App\Http\Requests\StoreClientsRequest;
use App\Http\Requests\UpdateClientsRequest;
use Illuminate\View\View;
use Illuminate\Routing\Controller as BaseController;

class ClientsController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $client =  Clients::all();
        return response()->json([
            $client
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(StoreClientsRequest $request)
    {
        //
        return Clients::create($request->all());
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClientsRequest $request)
    {
        $client =  Clients::create($request->all());
        return response()->json([
            $client
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return response()->json([
            Clients::findOrFail($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Clients $clients)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClientsRequest $request, $id)
    {
        $clients = Clients::findOrFail($id);
        $clients->update($request->all());
        return $clients;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $clients = Clients::findOrFail($id);
        $clients->delete();
    }
}
