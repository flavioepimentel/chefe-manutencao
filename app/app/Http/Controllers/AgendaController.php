<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAgendaRequest;
use App\Http\Requests\UpdateAgendaRequest;

class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([Agenda::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAgendaRequest $request)
    {
        return request()->json([Agenda::create($request->all())]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Agenda $agenda)
    {
        return response()->json(
            Agenda::findOrFail($agenda->id)
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAgendaRequest $request, Agenda $agenda)
    {
        return response()->json(Agenda::findOrFail($agenda->id)->update($request->all()));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Agenda $agenda)
    {
        return response()->json(Agenda::findOrFail($agenda->id)->delete());
    }
}
