<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScientificResearchWorkloadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scientific_research_workloads', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('personalinformation_id')->unsigned();
            $table->integer('session_id')->unsigned();
            $table->string('name_of_work');
            $table->string('detail_of_work');
            $table->string('explain_of_work');
            $table->string('unit_of_work');
            $table->float('quantity_of_work');
            $table->float('converted_standard_time');
            $table->float('converted_time');
            $table->string('note');
            $table->timestamps();

            $table->foreign('personalinformation_id')->references('id')->on('personalinformations');
            $table->foreign('session_id')->references('id')->on('workloadsessions');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scientific_research_workloads');
    }
}
