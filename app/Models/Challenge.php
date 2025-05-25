<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'date', 'time','No_players', 'club_id', 'courts', 'type', 'endpoint', 'tie_break', 'matching', 'is_public', 'user_id'];

    /**
     * Get the user that created the challenge.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the players associated with the challenge.
     */
    public function players()
    {
        return $this->hasMany(ChallengePlayer::class);
    }

    /**
     * Get the matches for the challenge.
     */
    public function matches()
    {
        return $this->hasMany(ChallengeMatch::class);
    }
}
