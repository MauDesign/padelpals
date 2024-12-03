<?php

namespace App\Http\Controllers;

use App\Models\Club;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use App\Http\Requests\CreateClubRequest;

class ClubController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $clubs = Club::all();
         return view('clubs.index', compact('clubs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clubs.create',['club' => new Club]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Club::create($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(Club $club)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Club $club)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Club $club)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Club $club)
    {
        //
    }
}
