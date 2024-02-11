<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'games';
    protected $guarded = ['id'];
    protected $fillable = ['id_home', 'id_visitor', 'home_gols', 'visitor_gols', 'date', 'group_name', 'hour'];
}
