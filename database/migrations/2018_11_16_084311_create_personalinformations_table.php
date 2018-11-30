<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonalInformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personalinformations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('employee_code',10)->unique();
            $table->string('full_name');
            $table->string('first_name');
            $table->boolean('gender');
            $table->date('date_of_birth');
            $table->string('place_of_birth');
            $table->string('permanent_address');
            $table->string('contact_address');
            $table->string('identity_card',12)->unique();
            $table->date('date_of_issue');
            $table->string('place_of_issue');
            $table->string('phone_number',12);
            $table->string('email_address')->unique();
            $table->date('date_of_recruitment');
            $table->string('position');
            $table->string('professional_title');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personalinformations');
    }
}
