<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChallengeMatch extends Model
{
    use HasFactory;

    protected $table = 'matches'; // Explicitly set table name if model name differs significantly

    protected $fillable = [
        'challenge_id',
        'team1_id',
        'team2_id',
        'player1_id',
        'player2_id',
        'score_team1',
        'score_team2',
        'winner_team_id',
        'status',
        'match_date',
        'match_time',
    ];

    /**
     * Get the challenge that this match belongs to.
     */
    public function challenge(): BelongsTo
    {
        return $this->belongsTo(Challenge::class);
    }

    /**
     * Get the first player in a singles match (linked through challenge_players).
     */
    public function player1(): BelongsTo
    {
        return $this->belongsTo(ChallengePlayer::class, 'player1_id');
    }

    /**
     * Get the second player in a singles match (linked through challenge_players).
     */
    public function player2(): BelongsTo
    {
        return $this->belongsTo(ChallengePlayer::class, 'player2_id');
    }

    // Relationships for team1_id and team2_id to ChallengePlayer can be added here
    // For example, to get all ChallengePlayer entries for team1_id:
    // public function team1Players()
    // {
    //     return $this->hasMany(ChallengePlayer::class, 'team_id', 'team1_id')
    //                 ->where('challenge_id', $this->challenge_id); // Scope to the same challenge
    // }
    // Similar for team2Players.
}
