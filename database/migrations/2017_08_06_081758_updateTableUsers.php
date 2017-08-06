<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTableUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->string('userName');
            $table->string('firstName');
            $table->string('lastName');
            $table->integer('age');
            $table->enum('gender', ['male', 'female']);
            $table->text('placeBirth');
            $table->date('dateBirth');
            $table->string('occupation');
            $table->string('scholarship');
            $table->string('maritalStatus');
            $table->text('country');
            $table->text('state');
            $table->text('delegation');
            $table->text('colony');
            $table->text('street');
            $table->text('streetNumber');
            $table->text('interiorNumber');
            $table->text('phone');
            $table->text('officePhone');
            $table->text('familyDoctor');
            $table->text('phoneFd');
            $table->longText('reasonForLastAppointment');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user');
    }
}
