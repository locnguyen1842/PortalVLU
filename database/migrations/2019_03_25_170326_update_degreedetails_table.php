<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateDegreedetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('degreedetails', function (Blueprint $table) {
            $table->dropColumn('specialized_id');
            $table->string('specialized');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('degreedetails', function (Blueprint $table) {
            $table->dropColumn('specialized');
        });
    }
}
