<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTransactionBankTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transaction_bank', function (Blueprint $table) {
            $table->integer('company')->unsigned()->nullable();
            $table->foreign('company')->references('id')->on('company_information');
            $table->enum('type_doctor', ['Owed', 'Paid'])->default('Owed');
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
