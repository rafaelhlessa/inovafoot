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
        Schema::create('championship', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('division');
            $table->integer('player_limit');
            $table->integer('team_limit');
            $table->string('format_championship');
            $table->integer('games');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('championship');
    }
};
