<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateScientificBackgroundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('scientific_backgrounds', function (Blueprint $table) {
            $table->string('address')->nullable();
            $table->string('highest_degree')->nullable();
            $table->string('orga_phone_number')->nullable();
            $table->string('home_phone_number')->nullable();
            $table->string('mobile_phone_number')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('scientific_backgrounds', function (Blueprint $table) {
            $table->dropColumn('address');
            $table->dropColumn('highest_degree');
            $table->dropColumn('organ_phone_number');
            $table->dropColumn('home_phone_number');
            $table->dropColumn('mobile_phone_number');
        });
    }
}
