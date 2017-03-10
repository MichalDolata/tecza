<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNextMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('next_matches', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('active')->nullable();
            $table->enum('type', ['home', 'away'])->nullable();
            $table->string('opponent')->nullable();
            $table->string('place')->nullable();
            $table->dateTime('date')->nullable();
        });

        DB::table('next_matches')->insert([
            'active' => false
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('next_matches');
    }
}
