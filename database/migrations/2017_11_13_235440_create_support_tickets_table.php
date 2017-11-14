<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupportTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('support_tickets', function (Blueprint $table) {
            $table->increments('id');            
            $table->string('user')->nullable();
            $table->string('email')->nullable();
            $table->enum('userType', ['Doctor', 'paciente'])->nullable();
            $table->longText('ticketDescription')->nullable();

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
        Schema::dropIfExists('support_tickets');
    }
}
