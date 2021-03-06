<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('confirmation_requests', function (Blueprint $table) {
            
            $table->boolean('status')->nullable()->default(0);
            $table->boolean('is_printed')->nullable()->default(0);
            $table->integer('number_of_month_income')->nullable();
            


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('confirmation_requests', function (Blueprint $table) {
            //
        });
    }
}
