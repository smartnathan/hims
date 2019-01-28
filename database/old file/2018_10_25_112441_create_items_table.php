<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->integer('item_category_id')->nullable();
            $table->integer('item_brand_id')->nullable();
            $table->integer('item_group_id')->nullable();
            $table->string('name')->nullable();
            $table->string('code')->nullable();
            $table->text('description')->nullable();
            $table->decimal('price')->nullable();
            $table->boolean('has_instances')->nullable();
            $table->boolean('is_active')->nullable();
            $table->string('tag')->nullable();
            $table->integer('quantity')->nullable();
            $table->integer('added_by')->nullable();
            $table->string('oem')->nullable();
            $table->text('warranty_terms')->nullable();
            $table->string('model_number')->nullable();
            $table->integer('item_uom_id')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('items');
    }
}
