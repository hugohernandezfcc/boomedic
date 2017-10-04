<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfessionalInformation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ProfessionalInformation', function (Blueprint $table) {
            $table->increments('id');
            $table->string('specialty');
            $table->string('schoolOfMedicine');
            $table->string('facultyOfSpecialization');
            $table->integer('practiseProfessional');
            $table->integer('user')->unsigned();
            $table->foreign('user')->references('id')->on('users');
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
        Schema::dropIfExists('ProfessionalInformation');
    }
}