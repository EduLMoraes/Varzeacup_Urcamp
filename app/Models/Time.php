<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    use HasFactory;
    public $id_time;
    public $points_time;
    public $games_time;
    public $name_time;
    public $victory_time;
    public $draw_time;
    public $lost_time;

}
