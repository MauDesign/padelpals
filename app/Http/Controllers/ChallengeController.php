<?php

namespace App\Http\Controllers;

use App\Models\Challenge;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ChallengeRequest;

class ChallengeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $challenges = Challenge::all();
        return view('challenges.index', compact('challenges'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('challenges.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ChallengeRequest $request)
    {
        $challenge = new Challenge();
        $challenge->name = $request->name;
        $challenge->date = $request->date;
        $challenge->time = $request->time;
        $challenge->courts = $request->courts;
        $challenge->no_players = $request->players;
        $challenge->club_id = $request->clubInputID;

        $challenge->type = "";
        $challenge->endpoint = "";
        $challenge->tie_break = 0;
        $challenge->matching = "";

        echo "Challenge: " . $challenge;
        $challenge->save(); // Esto guarda el jugador en la base de datos

        return redirect()->route('challenges.index')->with('success', 'Challenge agregada correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Challenge $challenge)
    {
        //
        echo "HOLA";
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Challenge $challenge)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Challenge $challenge)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Challenge $challenge)
    {
        //
    }
}
