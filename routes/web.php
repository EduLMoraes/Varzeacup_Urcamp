<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});

route::get('/login', function(){
    return view('auth/login');
});

route::get('/register', function(){
    return view('auth/register');
});

route::get('/admin', function(){
    return view('admin/admin')->with([Controller::class, 'get_times']);
});

route::get('/admin/times', function(){
    return view('admin/form/times');
});

route::get('/admin/games', [Controller::class, 'get_games']);

route::get('/admin/counts', function(){
    return view('admin/form/counts');
});