<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUsersAdditionalInformationToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('firstname')->nullable();
            $table->string('surname')->nullable();
            $table->string('othername')->nullable();
            //$table->string('mobile_number')->unique();
            $table->string('mobile_number')->nullable();
            $table->string('username')->nullable();
            $table->string('address')->nullable();
            $table->unsignedInteger('lga_id')->nullable();
            $table->unsignedInteger('added_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
