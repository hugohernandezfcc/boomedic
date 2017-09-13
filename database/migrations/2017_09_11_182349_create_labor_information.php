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
        Schema::create('LaborInformation', function (Blueprint $table) {
            $table->increments('id');
            $table->string('workplace');
            $table->string('professionalPosition');
            $table->string('address');
            $table->integer('profInformation')->unsigned();
            $table->foreign('profInformation')->references('id')->on('ProfessionalInformation');
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
        Schema::dropIfExists('LaborInformation');
    }
}