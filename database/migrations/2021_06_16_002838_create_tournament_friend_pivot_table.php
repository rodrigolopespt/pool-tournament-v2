<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTournamentFriendPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tournament_friend', function (Blueprint $table) {
            $table->foreignId('tournament_id')->constrained();
            $table->foreignId('friend_id')->constrained();
            $table->integer('current_rank')->default(0);
            $table->integer('games_played')->default(0);
            $table->integer('points')->default(0);
            $table->integer('balls_left')->default(0);
            $table->integer('wins')->default(0);    
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tournament_friend');
    }
}
