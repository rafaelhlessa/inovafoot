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
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->integer('game');
            $table->unsignedBigInteger('homeTeam_id')->references('id')->on('teams');
            $table->unsignedBigInteger('awayTeam_id')->references('id')->on('teams');
            $table->integer('homeGoals')->default(0);
            $table->integer('awayGoals')->default(0);
            $table->integer('homeRedCard')->default(0);
            $table->integer('awayRedCard')->default(0);
            $table->integer('homeInjury')->default(0);
            $table->integer('awayInjury')->default(0);

            $table->timestamps();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
