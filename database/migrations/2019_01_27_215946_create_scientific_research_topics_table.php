<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScientificResearchTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scientific_research_topics', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_of_topic');
            $table->string('start_year');
            $table->string('end_year');
            $table->integer('topic_level_id')->unsigned();
            $table->integer('scientific_background_id')->unsigned();
            $table->string('responsibility');
            $table->timestamps();

            $table->foreign('scientific_background_id')->references('id')->on('scientific_backgrounds');
            $table->foreign('topic_level_id')->references('id')->on('topic_levels');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scientific_research_topics');
    }
}
