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
        Schema::table('users', function (Blueprint $table) {
            $table->string('userName')->nullable();
            $table->string('firstName')->nullable();
            $table->string('lastName')->nullable();
            $table->integer('age')->nullable();
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->text('placeBirth')->nullable();
            $table->date('dateBirth')->nullable();
            $table->string('occupation')->nullable();
            $table->string('scholarship')->nullable();
            $table->string('maritalStatus')->nullable();
            $table->text('country')->nullable();
            $table->text('state')->nullable();
            $table->text('delegation')->nullable();
            $table->text('colony')->nullable();
            $table->text('street')->nullable();
            $table->text('streetNumber')->nullable();
            $table->text('interiorNumber')->nullable();
            $table->text('phone')->nullable();
            $table->text('officePhone')->nullable();
            $table->text('familyDoctor')->nullable();
            $table->text('phoneFd')->nullable();
            $table->longText('reasonForLastAppointment')->nullable();
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
