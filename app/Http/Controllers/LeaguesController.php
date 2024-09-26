<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\League;
use Illuminate\Http\Request;
use App\Http\Requests\CreateLeaguesRequest;
class LeaguesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $leagues = League::get();

        return view('leagues.index', compact('leagues'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('leagues.create',['league' => new League]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateLeaguesRequest $request)
    {

        League::create($request->validated());
        return to_route('leagues.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
