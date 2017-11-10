<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBankfieldToPayments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('paymentsmethods', function (Blueprint $table) {
            $table->enum('credit_debit', ['Credit', 'Debit'])->nullable();
            $table->string('bank')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('paymentsmethods', function (Blueprint $table) {
            //
        });
    }
}
