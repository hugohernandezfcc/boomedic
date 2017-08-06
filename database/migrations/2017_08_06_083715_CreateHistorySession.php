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
        Schema::create('historySession', function (Blueprint $table) {
            $table->increments('id');
            
            $table->string('Browser');
            $table->string('IP');
            $table->dateTime('DateIn');
            $table->boolean('Status');
            $table->dateTime('DateOut');

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
        Schema::dropIfExists('historySession');
    }
}
