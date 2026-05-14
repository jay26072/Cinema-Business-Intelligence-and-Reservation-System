<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovieModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movie_models', function (Blueprint $table) {
            $table->id();
            $table->string('movie_name');
            $table->string('movie_image');
            $table->string('movie_description');
            $table->string('movie_type');
            $table->string('movie_duration');
            $table->string('language');
            $table->string('screen_type');
            $table->string('release_date');
            $table->string('movie_trailer');
            $table->string('movie_trailer_date');
            $table->string('movie_cast');
            $table->string('movie_crew');
            $table->string('status')->default('1');

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
        Schema::dropIfExists('movie_models');
    }
}
