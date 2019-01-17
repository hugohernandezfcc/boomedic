<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssistantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assistant', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_assist')->unsigned()->nullable();
            $table->foreign('user_assist')->references('id')->on('users');    
            $table->integer('user_doctor')->unsigned()->nullable();
            $table->foreign('user_doctor')->references('id')->on('users');     
            $table->boolean('confirmation')->default(false);                           
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
        Schema::dropIfExists('assistant');
    }
}
