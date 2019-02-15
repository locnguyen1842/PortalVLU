<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfessionalWorkingProcessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('professional_working_process', function (Blueprint $table) {
            $table->increments('id');
            $table->string('period_time');
            $table->string('place_of_work');
            $table->string('work_of_undertake');
            $table->integer('scientific_background_id')->unsigned();
            $table->timestamps();
            $table->foreign('scientific_background_id','sb_professional_process_foreign')->references('id')->on('scientific_backgrounds');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('professional_working_process');
    }
}
