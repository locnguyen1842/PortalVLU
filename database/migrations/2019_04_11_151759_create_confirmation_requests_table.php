<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfirmationRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('confirmation_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('personalinformation_id')->unsigned();
            $table->string('reason');
            $table->string('confirmation');
            $table->date('date_of_request')->nullable();
            $table->string('name_of_signer')->nullable();
            $table->string('first_signer')->nullable();
            $table->string('second_signer')->nullable();

            $table->timestamps();

            $table->foreign('personalinformation_id')->references('id')->on('personalinformations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('confirmation_requests');
    }
}
