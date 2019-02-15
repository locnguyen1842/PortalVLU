<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrainingProcessPostgraduateEducationDoctorDegreesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training_process_postgraduate_education_doctor_degrees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('field_of_study');
            $table->string('year_of_issue');
            $table->string('place_of_training');
            $table->string('thesis_title');
            $table->integer('scientific_background_id')->unsigned();
            $table->timestamps();

            $table->foreign('scientific_background_id','sb_training_process_doctor_foreign')->references('id')->on('scientific_backgrounds');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('training_process_postgraduate_education_doctor_degrees');
    }
}
