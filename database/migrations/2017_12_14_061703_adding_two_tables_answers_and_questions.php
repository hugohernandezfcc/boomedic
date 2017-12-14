<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddingTwoTablesAnswersAndQuestions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions_clinic_history', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code_translation')->nullable();
            $table->string('question');
            $table->string('text_help')->nullable();
            $table->timestamps();
        });

        Schema::create('answers_clinic_history', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code_translation')->nullable();
            $table->string('answer');
            $table->string('text_help')->nullable();
            $table->integer('question')->unsigned();
            $table->foreign('question')->references('id')->on('questions_clinic_history');
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
        Schema::dropIfExists('questions_clinic_history');
        Schema::dropIfExists('answers_clinic_history');
    }
}
