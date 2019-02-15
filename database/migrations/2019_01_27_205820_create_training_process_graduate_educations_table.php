<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrainingProcessGraduateEducationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training_process_graduate_educations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type_of_training');
            $table->string('place_of_training');
            $table->string('field_of_study');
            $table->string('nation_of_training');
            $table->string('year_of_graduation');
            $table->integer('scientific_background_id')->unsigned();
            $table->timestamps();

            $table->foreign('scientific_background_id','sb_training_process_graduate_foreign')->references('id')->on('scientific_backgrounds');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('training_process_graduate_educations');
    }
}
