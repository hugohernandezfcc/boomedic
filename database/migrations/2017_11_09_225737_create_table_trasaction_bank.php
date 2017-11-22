<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTrasactionBank extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_bank', function (Blueprint $table) {
            $table->increments('id');
            $table->text('receiver');
            $table->decimal('amount', 8, 2);
            $table->integer('paymentmethod')->unsigned();
            $table->foreign('paymentmethod')->references('id')->on('paymentsmethods')->ondelete();
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
        Schema::dropIfExists('transaction_bank');
    }
}
