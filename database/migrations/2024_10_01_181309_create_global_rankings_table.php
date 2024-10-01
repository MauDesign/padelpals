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
        Schema::create('global_rankings', function (Blueprint $table) {
            $table->id();
            $table->integer('points');
            $table->integer('won_games');
            $table->integer('lost_games');
        });
        Schema::table('global_rankings', function (Blueprint $table) {
            $table->foreignId('league_id')->after('id')->constrained();
            $table->foreignId('player_id')->after('id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('global_rankings');
    }
};
