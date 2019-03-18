<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOfficersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('officers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('personalinformation_id')->unsigned();
            $table->integer('type_id')->unsigned();
            $table->integer('position_id')->unsigned();
            $table->boolean('is_concurrently'); //kiem nhiem
            $table->timestamps();

            $table->foreign('personalinformation_id')->references('id')->on('personalinformations');
            $table->foreign('type_id')->references('id')->on('officer_types');
            $table->foreign('position_id')->references('id')->on('position_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('officers');
    }
}
