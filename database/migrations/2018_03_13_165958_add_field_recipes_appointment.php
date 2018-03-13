<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldRecipesAppointment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('recipes_tests', function (Blueprint $table) {
            $table->integer('appointment')->unsigned()->nullable();
            $table->foreign('appointment')->references('id')->on('medical_appointments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('recipes_tests', function (Blueprint $table) {
            //
        });
    }
}
