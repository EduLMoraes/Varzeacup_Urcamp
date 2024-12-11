<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index()
    {
        $team = \App\Models\Team::orderBy('points_team', 'desc')->orderBy('games_team', 'desc')->get();
        echo $team;
    }

    public function create()
    {
        
    }

    public function store(Request $request)
    {
        $team = new \App\Models\Team;
        $team->games_team = intval($request->lost) + intval($request->victory) + intval($request->draw);
        $team->name_team = $request->name;
        $team->victory_team = intval($request->victory);
        $team->draw_team = intval($request->draw);
        $team->lost_team = intval($request->lost);
        $team->save();
    }

    public function show(string $id)
    {
    }

    public function edit(string $id)
    {
    }

    public function update(Request $request, string $id)
    {
        \App\Models\Team::where('id', $id)->update([
            'games_team' => intval($request->lost) + intval($request->victory) + intval($request->draw),
            'name_team' => $request->name,
            'victory_team' => intval($request->victory),
            'draw_team' => intval($request->draw),
            'lost_team' => intval($request->lost)
        ]);

        response()->json(['message' => 'team updated with sucess'], 200);
    }

    public function destroy(string $id)
    {
        \App\Models\Team::destroy($id);
    }
}
