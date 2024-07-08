<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Club;
use Illuminate\Http\Request;

class ClubController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clubs = Club::all();
        return response()->json($clubs);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nameClub' => 'required|max:100',
        ]);
        $club = Club::create($request->all());
        return response()->json([
            'status' => 'Success',
            'data' => $club,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Club $club)
    {
        return response()->json($club);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Club $club)
    {
        $this->validate($request, [
            'nameClub' => 'required|max:100',
        ]);
        $club->update($request->all());
        return response()->json([
            'status' => 'Mise à jour avec succèss'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Club $club)
    {
        return response()->json([
            'status' => 'Supprimer avec succès'
        ]);
    }
}
