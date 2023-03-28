<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamPlayers extends Model
{
    use HasFactory;
    protected $table = 'team_players';
    protected $primaryKey = 'team_player_id';
}
