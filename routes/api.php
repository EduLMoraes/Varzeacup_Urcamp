<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/user', function (Request $request) {
    echo $request;
});

// Route::get('/times', function(){
//     $control = new Controller();
//     $times = $control->get_times();
    
//     $times_arr = array();

//     for ($i = 0; $i < count($times); $i++){
//         $times_arr[$i] = 
//             (object)
//             [
//                 'name' => $times[$i] -> name,
//                 'victorys' => $times[$i] -> victorys,
//                 'draws' => $times[$i] -> draws,
//                 'loses' => $times[$i] -> loses,
//                 'points' => $times[$i] -> points,
//                 'games' => $times[$i] -> games,
//                 'id' => $times[$i] -> id,
//             ]
//         ;
//     }
//     // Retorna o array de objetos como JSON
//     header('Content-Type: application/json');
//     echo json_encode($times_arr);
// });

use App\Http\Controllers\TimeController;
Route::resource('times', TimeController::class);

Route::get('/games', function(){
    $control = new Controller();
    $games = $control->get_games();
    
    $games_arr = array();

    for ($i = 0; $i < count($games); $i++){
        $games_arr[$i] = 
            (object)
            [
                'id' => $games[$i] -> id,
                'home' => $games[$i] -> home,
                'home_gols' => $games[$i] -> home_gols,
                'visitor' => $games[$i] -> visitor,
                'visitor_gols' => $games[$i] -> visitor_gols,
                'desc' => $games[$i] -> desc,
            ]
        ;
    }

    header('Content-Type: application/json');
    echo json_encode($games_arr);
});