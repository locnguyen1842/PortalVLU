<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('personalinformation_id')->unsigned();
            $table->integer('type_id')->unsigned();
            $table->integer('title_id')->unsigned();
            $table->boolean('is_retired')->nullable();
            $table->date('date_of_retirement')->nullable();
            $table->boolean('is_excellent_teacher')->nullable();
            $table->boolean('is_national_teacher')->nullable();
            $table->timestamps();

            $table->foreign('personalinformation_id')->references('id')->on('personalinformations');
            $table->foreign('type_id')->references('id')->on('teacher_types');
            $table->foreign('title_id')->references('id')->on('teacher_titles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teachers');
    }
}
