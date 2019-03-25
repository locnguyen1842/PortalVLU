<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateAcedemicRanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('academic_ranks', function (Blueprint $table) {
            $table->string('specialized');
            $table->date('date_of_recognition');
            $table->integer('industry_id')->unsigned();

            $table->foreign('industry_id')->references('id')->on('industries');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('academic_ranks', function (Blueprint $table) {
            $table->dropColumn('specialized');
            $table->dropColumn('date_of_recognition');
            $table->dropForeign('academic_ranks_indistry_id_foreign');
            $table->dropColumn('industry_id');
        });
    }
}
