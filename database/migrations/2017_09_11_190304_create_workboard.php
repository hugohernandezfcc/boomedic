<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkboard extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workboard', function (Blueprint $table) {
            $table->increments('id');
            $table->string('workingDays');
            $table->string('workingHours');
            $table->integer('labInformation')->unsigned();
            $table->foreign('labInformation')->references('id')->on('labor_information');
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
        Schema::dropIfExists('workboard');
    }
}
