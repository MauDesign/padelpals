<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('challenge_id')->constrained()->onDelete('cascade');

            // For team-based matches (e.g., doubles)
            $table->string('team1_id')->nullable()->index(); // References team_id in challenge_players
            $table->string('team2_id')->nullable()->index(); // References team_id in challenge_players

            // For singles matches (linking to challenge_players entries)
            $table->foreignId('player1_id')->nullable()->constrained('challenge_players')->onDelete('set null');
            $table->foreignId('player2_id')->nullable()->constrained('challenge_players')->onDelete('set null');

            $table->string('score_team1')->nullable();
            $table->string('score_team2')->nullable();
            $table->string('winner_team_id')->nullable()->index(); // Stores the team_id of the winning team/player

            $table->string('status')->default('scheduled'); // e.g., scheduled, in_progress, completed, cancelled
            $table->date('match_date')->nullable();
            $table->time('match_time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matches');
    }
};
