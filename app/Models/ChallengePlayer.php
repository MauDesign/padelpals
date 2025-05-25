<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChallengePlayer extends Model
{
    use HasFactory;

    protected $fillable = [
        'challenge_id', // Assuming this was from the original migration
        'player_id',    // Assuming this was from the original migration for a registered player
        'name',         // For guest player name
        'user_id',      // For linking to a User model instance
        'team_id',
    ];

    /**
     * Get the user associated with this challenge entry.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the challenge this entry belongs to.
     */
    public function challenge()
    {
        return $this->belongsTo(Challenge::class);
    }

    /**
     * Get the registered player associated with this entry (if any).
     * This assumes you have a 'player_id' column that links to a 'players' table.
     * If 'player_id' is not used when 'user_id' is present, this might need adjustment.
     */
    public function player()
    {
        return $this->belongsTo(Player::class);
    }

    /**
     * Get the matches where this challenge player is player1.
     */
    public function matchesAsPlayer1()
    {
        return $this->hasMany(ChallengeMatch::class, 'player1_id');
    }

    /**
     * Get the matches where this challenge player is player2.
     */
    public function matchesAsPlayer2()
    {
        return $this->hasMany(ChallengeMatch::class, 'player2_id');
    }
}
