<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDegreedetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('degreedetails', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date_of_issue');
            $table->string('place_of_issue');
            $table->integer('degree_id')->unsigned();
            $table->integer('personalinformation_id')->unsigned();
            $table->integer('industry_id')->unsigned();
            $table->timestamps();

            $table->foreign('industry_id')->references('id')->on('industries');
            $table->foreign('degree_id')->references('id')->on('degrees');
            $table->foreign('personalinformation_id')->references('id')->on('personalinformations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('degreedetails');
    }
}
