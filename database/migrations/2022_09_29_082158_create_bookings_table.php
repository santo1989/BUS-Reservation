<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('passenger_id')->nullable();
            $table->unsignedBigInteger('trip_id')->nullable();
            $table->unsignedBigInteger('event_id')->nullable();
            $table->integer('no_of_seat')->nullable();
            $table->string('seat')->nullable();
            $table->string('stoppage')->nullable();
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
        Schema::dropIfExists('bookings');
    }
}
