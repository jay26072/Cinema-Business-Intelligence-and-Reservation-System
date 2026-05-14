<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTheaterModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('theater_models', function (Blueprint $table) {
            $table->id();
            $table->string('theater_name');
            $table->string('theater_image');
            $table->string('cityid');
            $table->string('theater_address');
            $table->string('theater_contact');
            $table->string('theater_email');
            $table->string('password');
            $table->string('no_of_screen');
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
        Schema::dropIfExists('theater_models');
    }
}
