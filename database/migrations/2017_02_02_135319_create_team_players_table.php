<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamPlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team_players', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('team_id')->unsigned();
            $table->foreign('team_id')
                ->references('id')->on('teams')
                ->onDelete('cascade');

            $table->integer('player_id')->unsigned();
            $table->foreign('player_id')
                ->references('id')->on('team_members')
                ->onDelete('cascade');

            $table->integer('number')->unsigned()->nullable();
            $table->enum('position', ['Bramkarz', 'Skrzydłowy', 'Obrotowy', 'Rozgrywający']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('team_players');
    }
}
