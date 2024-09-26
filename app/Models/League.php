<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class League extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'courts', 'players', 'rounds', 'start_date'];

    public function league_players()
    {
        return $this->hasMany(Player::class);
    }
}
