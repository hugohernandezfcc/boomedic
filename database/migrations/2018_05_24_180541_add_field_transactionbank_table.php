<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldTransactionbankTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transaction_bank', function (Blueprint $table) {
            $table->integer('appointments')->unsigned()->nullable();
            $table->foreign('appointments')->references('id')->on('medical_appointments'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transaction_bank', function (Blueprint $table) {
            //
        });
    }
}
