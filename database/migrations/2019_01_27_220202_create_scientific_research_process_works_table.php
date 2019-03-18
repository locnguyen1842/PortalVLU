<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScientificResearchProcessWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scientific_research_process_works', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_of_works')->nullable();
            $table->string('year_of_publication')->nullable();
            $table->string('name_of_journal')->nullable();
            $table->integer('scientific_background_id')->unsigned();
            $table->timestamps();

            $table->foreign('scientific_background_id','sb_research_works_foreign')->references('id')->on('scientific_backgrounds');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scientific_research_process_works');
    }
}
