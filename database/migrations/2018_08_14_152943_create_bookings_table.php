<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

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
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->integer('room_id')->nullable();
            $table->dateTime('arrival_date')->nullable();
            $table->dateTime('departure_date')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('checked_in_by')->nullable();
            $table->integer('checked_out_by')->nullable();
            $table->boolean('paid')->nullable();
            $table->integer('payment_type_id')->nullable();
            $table->integer('duration')->nullable();
            $table->boolean('is_cancealed')->nullable();
            $table->dateTime('date_cancealed')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('bookings');
    }
}
