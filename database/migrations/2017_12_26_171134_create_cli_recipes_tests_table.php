<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCliRecipesTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cli_recipes_tests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('medicine')->unsigned()->nullable();
            $table->foreign('medicine')->references('id')->on('medicines');
            $table->integer('test')->unsigned()->nullable();
            $table->foreign('test')->references('id')->on('diagnostic_tests');
            $table->integer('recipe_test')->unsigned()->nullable();
            $table->foreign('recipe_test')->references('id')->on('recipes_tests');
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
        Schema::dropIfExists('cli_recipes_tests');
    }
}
