<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShowModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('show_models', function (Blueprint $table) {
            $table->id();
            $table->string('movie_id');
            $table->string('theater_id');
            $table->date('show_date');
            $table->time('show_time');
            $table->string('language');
            $table->string('screen_type');
            $table->string('screen_no');
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
        Schema::dropIfExists('show_models');
    }
}
