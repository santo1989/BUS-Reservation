<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBussesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('busses', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('reg_number')->unique();
            $table->integer('no_of_seat')->nullable();
            $table->integer('left_part')->nullable();
            $table->integer('right_part')->nullable();
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
        Schema::dropIfExists('busses');
    }
}
