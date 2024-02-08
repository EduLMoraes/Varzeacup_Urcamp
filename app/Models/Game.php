<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model{
    public $home;
    public $home_gols;
    public $visitor;
    public $visitor_gols;
    public $desc;
    public $id;
}