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

            $table->integer('activeUser')->unsigned();
            $table->integer('passiveUser')->unsigned();
            $table->enum('relationship', ['mother', 'father', 'siblings', 'son', 'wife', 'husband', 'uncles', 'grandparents']);

            $table->foreign('active_user')->references('id')->on('users');
            $table->foreign('passive_user')->references('id')->on('users');

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
