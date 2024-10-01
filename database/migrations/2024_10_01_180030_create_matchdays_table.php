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
        Schema::create('matchdays', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('date');
        });
        Schema::table('matchdays', function (Blueprint $table) {
            $table->foreignId('league_id')->after('id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matchdays');
    }
};
