<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('author_id')->unsigned();
            $table->foreign('author_id')
                ->references('id')->on('users')
                ->onDelete('cascade'); // TODO: not sure if cascade

            $table->string('title');
            $table->string('slug')->unique();

            $table->text('lead');
            $table->text('content');

            $table->string('image_id');

            $table->timestamp('published_at')->nullable();
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
        Schema::dropIfExists('news');
    }
}
