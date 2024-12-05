<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'date', 'time','No_players', 'club_id', 'courts', 'type', 'endpoint', 'tie_break', 'matching'];
}
