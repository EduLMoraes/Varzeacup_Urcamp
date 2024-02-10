<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;
    public $id;
    public $points;
    public $games;
    public $name;
    public $victory;
    public $draw;
    public $lost;

}
