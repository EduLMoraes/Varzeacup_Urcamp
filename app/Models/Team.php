<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;
    public $id_team;
    public $points;
    public $games;
    public $name;
    public $victory;
    public $draw;
    public $lost;
    public $timestamps = false;
    protected $table = 'teams';
    protected $guarded = ['id'];
    protected $fillable = ['points_team', 'games_team','name_team', 'victory_team', 'draw_team', 'lost_team'];


}
