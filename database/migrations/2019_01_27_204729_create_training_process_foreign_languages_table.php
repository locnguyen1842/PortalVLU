<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrainingProcessForeignLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training_process_foreign_languages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('language')->nullable();
            $table->string('usage_level')->nullable();
            $table->integer('scientific_background_id')->nullable()->unsigned();
            $table->timestamps();

            $table->foreign('scientific_background_id','sb_training_process_languages_foreign')->references('id')->on('scientific_backgrounds');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('training_process_foreign_languages');
    }
}
