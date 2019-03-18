<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnAboutAddressToPiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('personalinformations', function (Blueprint $table) {
            $table->dropColumn('permanent_address');
            $table->dropColumn('contact_address');
            $table->integer('permanent_address_id')->unsigned();
            $table->integer('contact_address_id')->unsigned();

            $table->foreign('permanent_address_id')->references('id')->on('addresses');
            $table->foreign('contact_address_id')->references('id')->on('addresses');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('personalinformations', function (Blueprint $table) {
            $table->string('permanent_address');
            $table->string('contact_address');
            $table->dropColumn('permanent_address_id');
            $table->dropColumn('contact_address_id');
        });
    }
}
