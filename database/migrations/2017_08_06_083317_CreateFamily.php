<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFamily extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('family', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('active_user')->unsigned();
            $table->integer('passive_user')->unsigned();
            $table->enum('relationship', ['mother', 'father', 'siblings', 'son', 'wife', 'husband', 'uncles', 'grandparents']);

            $table->foreign('active_user')->references('id')->on('user');
            $table->foreign('passive_user')->references('id')->on('user');

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
        Schema::dropIfExists('family');
    }
}
