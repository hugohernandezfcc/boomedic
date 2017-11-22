<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLaborInformation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('labor_information', function (Blueprint $table) {
            $table->increments('id');
            $table->string('workplace');
            $table->string('professionalPosition');

            $table->text('country')->nullable();
            $table->text('state')->nullable();
            $table->text('delegation')->nullable();
            $table->text('colony')->nullable();
            $table->text('street')->nullable();
            $table->text('streetNumber')->nullable();
            $table->text('interiorNumber')->nullable();
            $table->text('phone')->nullable();

            $table->integer('profInformation')->unsigned();
            $table->foreign('profInformation')->references('id')->on('professional_information');
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
        Schema::dropIfExists('labor_information');
    }
}