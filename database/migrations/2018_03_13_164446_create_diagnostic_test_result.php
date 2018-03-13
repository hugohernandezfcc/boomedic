<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiagnosticTestResult extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diagnostic_test_result', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('details')->nullable();
            $table->text('url')->nullable();
            $table->text('email')->nullable();
            $table->integer('patient')->unsigned()->nullable();
            $table->foreign('patient')->references('id')->on('users');
            $table->integer('diagnostic_test')->unsigned()->nullable();
            $table->foreign('diagnostic_test')->references('id')->on('diagnostic_tests');
            $table->integer('recipes_test')->unsigned()->nullable();
            $table->foreign('recipes_test')->references('id')->on('recipes_tests');
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
        Schema::dropIfExists('diagnostic_test_result');
    }
}
