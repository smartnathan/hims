<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->string('name')->nullable();
            $table->integer('roomtype_id')->nullable();
            $table->text('description')->nullable();
            $table->string('room_number')->nullable();
            $table->decimal('price')->nullable();
            $table->boolean('is_booked')->nullable();
            $table->integer('added_by')->nullable();
            $table->dateTime('date_booked')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('rooms');
    }
}
