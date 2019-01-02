<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyWorkloadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('workloads', function (Blueprint $table) {
            $table->integer('session_id')->unsigned();
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
        Schema::table('workloads', function (Blueprint $table) {
            //
        });
    }
}
