<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyColumnFacultyOnWorkloadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('workloads', function (Blueprint $table) {
            $table->integer('unit_id')->unsigned()->change();
            $table->foreign('unit_id')->references('id')->on('units');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('workloads', function (Blueprint $table) {
            //
        });
    }
}
