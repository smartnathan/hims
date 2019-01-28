<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateItemInstancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_instances', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->integer('item_id')->nullable();
            $table->string('name')->nullable();
            $table->string('serial_number')->nullable();
            $table->integer('item_brand_id')->nullable();
            $table->text('warranty_terms')->nullable();
            $table->dateTime('expiry_date')->nullable();
            $table->dateTime('date_manufactured')->nullable();
            $table->integer('added_by')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('item_instances');
    }
}
