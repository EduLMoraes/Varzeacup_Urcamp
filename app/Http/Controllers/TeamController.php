<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $team = \App\Models\Team::orderBy('points_team', 'desc')->orderBy('games_team', 'desc')->get();
        echo $team;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $team = new \App\Models\Team;
        $team->points_team = intval($request->victory) * 3 + intval($request->draw);
        $team->games_team = intval($request->lost) + intval($request->victory) + intval($request->draw);
        $team->name_team = $request->name;
        $team->victory_team = intval($request->victory);
        $team->draw_team = intval($request->draw);
        $team->lost_team = intval($request->lost);
        $team->save();
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
        \App\Models\Team::where('id', $id)->update([
            'points_team' => intval($request->victory) * 3 + intval($request->draw),
            'games_team' => intval($request->lost) + intval($request->victory) + intval($request->draw),
            'name_team' => $request->name,
            'victory_team' => intval($request->victory),
            'draw_team' => intval($request->draw),
            'lost_team' => intval($request->lost)
        ]);

        response()->json(['message' => 'team updated with sucess'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        \App\Models\Team::destroy($id);
    }
}
