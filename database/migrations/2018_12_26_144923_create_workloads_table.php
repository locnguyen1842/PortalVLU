<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkloadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workloads', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('personalinformation_id')->unsigned();
            $table->string('subject_code',10);
            $table->string('subject_name');
            $table->integer('number_of_lessons');
            $table->string('class_code',10);
            $table->integer('number_of_students');
            $table->float('total_workload');
            $table->float('theoretical_hours');
            $table->float('practice_hours');
            $table->string('note')->nullable();
            $table->string('faculty',10);
            $table->tinyInteger('semester');

            $table->timestamps();

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
        Schema::dropIfExists('workloads');
    }
}
