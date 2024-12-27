<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateClubsRequest;
use App\Models\Club;
use Illuminate\Http\Request;

class ClubsController extends Controller
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
    public function store(CreateClubsRequest $request)
    {
        Club::create($request->validated());
        return to_route('clubs.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Club $club)
    {
        return view('clubs.show', ['club'=> $club,]);
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

    public function list(Request $request)
    {
        $search = $request->get('search', '');

        // Buscar las opciones que coincidan con el valor 'search' (si lo hay)
        $options = Club::where('name', 'like', "%$search%")->get();

        // Devolver las opciones como JSON
        return response()->json($options);
    }
}
