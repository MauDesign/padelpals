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
        Schema::create('league_players', function (Blueprint $table) {
            $table->id();
        });
        Schema::table('league_players', function (Blueprint $table) {
            $table->foreignId('league_id')->after('id')->constrained();
            $table->foreignId('player_id')->after('id')->constrained();
            $table->foreignId('initial_court_id')->after('id')->constrained('courts');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('league_players');
    }
};
