<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfirmationIncomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('confirmation_incomes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('confirmation_request_id')->unsigned();
            $table->date('date_of_income');
            $table->float('amount_of_income');

            $table->timestamps();

            $table->foreign('confirmation_request_id')->references('id')->on('confirmation_requests');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('confirmation_incomes');
    }
}
