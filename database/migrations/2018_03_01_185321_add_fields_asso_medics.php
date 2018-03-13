<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsAssoMedics extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('medical_association', function (Blueprint $table) {
            $table->integer('parent')->unsigned()->nullable();
            $table->foreign('parent')->references('id')->on('medical_association');
            $table->integer('members')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('email')->nullable();
            $table->text('address')->nullable();
            $table->text('phone')->nullable();
            $table->text('mobile')->nullable();
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('medical_association', function (Blueprint $table) {
            //
        });
    }
}
