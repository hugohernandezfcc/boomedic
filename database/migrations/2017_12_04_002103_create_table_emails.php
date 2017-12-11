<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableEmails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emails', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user')->nullable();
            $table->string('email')->nullable();
            $table->date('date')->nullable();
            $table->string('sender')->nullable();
            $table->string('recipient')->nullable();
            $table->text('subject')->nullable();
            $table->string('message')->nullable();
            

            $table->integer('userId')->unsigned();            
            $table->foreign('userId')->references('id')->on('users');

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
        Schema::dropIfExists('emails');
    }
}
