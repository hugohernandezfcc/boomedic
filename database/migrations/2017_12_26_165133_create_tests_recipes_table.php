<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestsRecipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipes_tests', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('type', ['Recipe', 'Test'])->nullable();
            $table->integer('doctor')->unsigned()->nullable();
            $table->foreign('doctor')->references('id')->on('users');
            $table->integer('patient')->unsigned()->nullable();
            $table->foreign('patient')->references('id')->on('users');
            $table->string('notes')->nullable();
            $table->string('folio')->nullable();
            $table->datetime('date');
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
        Schema::dropIfExists('recipes_tests');
    }
}
