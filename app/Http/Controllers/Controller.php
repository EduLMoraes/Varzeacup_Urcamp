<?php

namespace App\Http\Controllers;
use App\Models\Game;
use App\Models\Time;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Psy\Readline\Hoa\Console;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    
    public function get_games(){
    
        $game1 = new Game();
        $game1->home = "Grêmio";
        $game1->home_gols = 3;
        $game1->visitor = "Internacional";
        $game1->visitor_gols = 0;
        $game1->desc = "Gremio3x0Internacional";
        $game1->id = 1;

        $games = [$game1, $game1, $game1];
    
        return $games;
    }

    public function get_times(){
        $time1 = new Time();

        $time1->name = "Gremio";
        $time1->victorys = 1;
        $time1->draws = 0;
        $time1->loses = 0;
        $time1->points = $time1->victorys*3 + $time1->draws*1;
        $time1->games = $time1->victorys + $time1->draws + $time1->loses;
        $time1->id = 1;

        $time2 = new Time();

        $time2->name = "Internacional";
        $time2->victorys = 0;
        $time2->draws = 0;
        $time2->loses = 1;
        $time2->points = $time2->victorys*3 + $time2->draws*1;
        $time2->games = $time2->victorys + $time2->draws + $time2->loses;
        $time2->id = 2;

        $times = [$time1, $time2];

        return $times;

    }
}
