<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsTableWorkboard extends Migration
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
             $table->string('workingDays')->nullable();
             $table->string('workingHours')->nullable();
             $table->string('start')->nullable();
             $table->string('end')->nullable();
             $table->boolean('fixed_schedule')->nullable();
             $table->longText('patient_duration_attention')->nullable();
             $table->integer('labInformation')->unsigned();
             $table->foreign('labInformation')->references('id')->on('labor_information');
            


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('workboard', function (Blueprint $table) {
            //
        });
    }
}
