<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team_staff', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('team_id')->unsigned();
            $table->foreign('team_id')
                ->references('id')->on('teams')
                ->onDelete('cascade');

            $table->integer('person_id')->unsigned();
            $table->foreign('person_id')
                ->references('id')->on('team_members')
                ->onDelete('cascade');

            $table->enum('role', ['Trener', 'Kierownik']);

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
        Schema::dropIfExists('team_staff');
    }
}
