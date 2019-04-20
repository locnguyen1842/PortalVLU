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
            $table->string('full_name')->nullable();
            $table->boolean('gender')->nullable();
            $table->boolean('status')->nullable()->default(0);
            $table->boolean('is_printed')->nullable()->default(0);
            $table->date('date_of_birth')->nullable();
            $table->string('place_of_birth')->nullable();
            $table->string('identity_card')->nullable();
            $table->string('date_of_issue')->nullable();
            $table->string('address')->nullable();


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
