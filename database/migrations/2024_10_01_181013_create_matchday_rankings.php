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
        Schema::create('matchday_rankings', function (Blueprint $table) {
            $table->id();
            $table->integer('won_games');
            $table->integer('lost_games');
            $table->integer('points');
        });
        Schema::table('matchday_rankings', function (Blueprint $table) {
            $table->foreignId('player_id')->after('id')->constrained();
            $table->foreignId('matchday_id')->after('id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matchday_rankings');
    }
};
