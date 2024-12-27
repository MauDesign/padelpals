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
        Schema::create('challenges', function (Blueprint $table) {
            $table->id();
            $table->club_id();
            $table->string('name');
            $table->date('date');
            $table->time('time');
            $table->integer('courts');
            $table->string('type');
            $table->string('endpoint');
            $table->boolean('tie_break');
            $table->string('matching');
            $table->string('no_players');
            $table->timestamps();
        });
        Schema::table('matches', function (Blueprint $table) {
            $table->foreignId('club_id')->after('date')->constrained();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('challenges');
    }
};
