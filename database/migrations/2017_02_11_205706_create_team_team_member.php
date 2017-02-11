<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamTeamMember extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team_team_member', function (Blueprint $table) {
            $table->integer('team_id');
            $table->integer('team_member_id');
            $table->enum('position', ['coach', 'goalkeeper', 'pivot', 'wingman', 'backcourt']);
            $table->unique(['team_id', 'team_member_id', 'position']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('team_team_member');
    }
}
