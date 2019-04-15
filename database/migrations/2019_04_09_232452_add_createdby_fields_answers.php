<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCreatedbyFieldsAnswers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('answers_clinic_history', function (Blueprint $table) {
            $table->integer('createdby')->unsigned()->nullable();
            $table->foreign('createdby')->references('id')->on('users');
            $table->boolean('active')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('answers_clinic_history', function (Blueprint $table) {
            //
        });
    }
}
