<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistorySession extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_session', function (Blueprint $table) {
            $table->increments('id');

            $table->string('browser');
            $table->string('ip');
            $table->dateTime('dateIn');
            $table->boolean('status');
            $table->dateTime('dateOut');

            $table->integer('createdBy')->unsigned();
            $table->foreign('createdBy')->references('id')->on('users');

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
        Schema::dropIfExists('history_session');
    }
}
