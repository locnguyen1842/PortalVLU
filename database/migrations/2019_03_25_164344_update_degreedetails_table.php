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
            $table->integer('nation_of_issue_id')->unsigned()->default(1);
            $table->string('degree_type')->nullable();
            $table->dropColumn('specialized_id');
            $table->string('specialized');
            $table->foreign('nation_of_issue_id')->references('id')->on('countries');



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
