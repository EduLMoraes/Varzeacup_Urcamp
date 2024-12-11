<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GameController extends Controller
{
    public function index()
    {
        $games = Game::orderBy('date', 'desc')->get();

        foreach ($games as $game) {
            $home_team = \App\Models\Team::find($game->id_home)->name_team;
            $visitor_team = \App\Models\Team::find($game->id_visitor)->name_team;
            $game->id_home = $home_team;
            $game->id_visitor = $visitor_team;
        }

        echo $games;
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $home = \App\Models\Team::where('name_team', $request->home)->first();
        $visitor = \App\Models\Team::where('name_team', $request->visitor)->first();

        if ($request->hgols > $request->vgols){
            $home->victory_team += 1;
            $visitor->lost_team += 1;
        }else if ($request->hgols < $request->vgols){
            $home->lost_team += 1;
            $visitor->victory_team += 1;
        }else{
            $home->draw_team += 1;
            $visitor->draw_team += 1;
        }

        $home->games_team++;

        $visitor->games_team++;

        $visitor->save();
        $home->save();

        $game = new Game;
        $game->id_home = $home->id;
        $game->id_visitor = $visitor->id;
        $game->home_gols = intval($request->hgols);
        $game->visitor_gols = intval($request->vgols);
        $game->date = $request->date;
        $game->group_name = $request->group;
        $game->hour = $request->hour;

        $game->save();

        
    }

    public function show(Game $game)
    {
        //
    }

    public function edit(Game $game)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        $home = \App\Models\Team::where('name_team', $request->home)->first();
        $visitor = \App\Models\Team::where('name_team', $request->visitor)->first();

        Game::where('id', $id)->update([
            'id_home' => $home->id,
            'id_visitor' => $visitor->id,
            'home_gols' => intval($request->hgols),
            'visitor_gols' => intval($request->vgols),
            'date' => $request->date,
            'group_name' => $request->group,
            'hour' => $request->hour
        ]);

        response()->json(['message' => 'team updated with sucess'], 200);
    }

    public function destroy(string $id)
    {
         Game::destroy($id);
    }


}
