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
            $table->dateTime('starts_at');
            $table->integer('right_team_games');
            $table->integer('left_team_games');
            $table->boolean('is_final');
            $table->timestamps();
        });
        Schema::table('matches', function (Blueprint $table) {
            $table->foreignId('matchday_id')->after('id')->constrained();
            $table->foreignId('court_id')->after('id')->constrained();
            $table->foreignId('right_player_one_id')->after('id')->constrained('players');
            $table->foreignId('right_player_two_id')->after('id')->constrained('players');
            $table->foreignId('left_player_one_id')->after('id')->constrained('players');
            $table->foreignId('left_player_two_id')->after('id')->constrained('players');
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
