<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Payments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paymentsmethods', function (Blueprint $table) {
            $table->increments('id');
            $table->string('provider')->nullable();
            $table->string('typemethod')->nullable();
            $table->string('country')->nullable();
            $table->string('dateexpired')->nullable();
            $table->integer('cvv')->nullable();
            $table->integer('cardnumber')->nullable();
            $table->integer('owner')->unsigned();
            $table->foreign('owner')->references('id')->on('users');
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
        Schema::dropIfExists('paymentsmethods');
    }
}
