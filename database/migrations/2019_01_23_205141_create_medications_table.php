<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medications', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('active', ['Confirmed', 'Not Confirmed', 'Finished'])->default('Not Confirmed'); 
            $table->integer('recipe_medicines')->unsigned()->nullable();
            $table->foreign('recipe_medicines')->references('id')->on('cli_recipes_tests');
            $table->datetime('start_date');
            $table->text('posology')->nullable();
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
        Schema::dropIfExists('medications');
    }
}
