<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAcademicRanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('academic_ranks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('personalinformation_id')->unsigned();
            $table->integer('type_id')->unsigned();
            $table->timestamps();

            $table->foreign('personalinformation_id')->references('id')->on('personalinformations');
            $table->foreign('type_id')->references('id')->on('academic_rank_types');



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('academic_ranks');
    }
}
