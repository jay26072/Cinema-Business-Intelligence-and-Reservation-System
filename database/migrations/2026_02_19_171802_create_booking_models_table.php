<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_models', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('show_id');
            $table->string('movie_id');
            $table->string('theater_id');
            $table->string('booking_reference')->unique();
            $table->string('payment_id')->nullable();
            $table->string('seat_number');
            $table->string('screen_type');
            $table->string('screen_no');
            $table->string('language');
            $table->decimal('total_price', 8, 2);
            $table->decimal('gst_amount', 8, 2);
            $table->decimal('final_price', 8, 2);
            $table->string('payment_method');
            $table->enum('payment_status', ['pending', 'completed', 'failed']);
            $table->enum('booking_status', ['locked', 'confirmed', 'cancelled']);
            $table->enum('is_scanned', ['0', '1'])->default('0');
            $table->datetime('scanned_at')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->decimal('discount_amount',8,2)->default(0);
            $table->string('promo_code')->nullable();
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
        Schema::dropIfExists('booking_models');
    }
}
