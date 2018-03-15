<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddParentAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('answers_clinic_history', function (Blueprint $table) {
            $table->integer('parent')->unsigned()->nullable();
            $table->foreign('parent')->references('id')->on('answers_clinic_history');
            $table->text('parent_answer')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('answers_clinic_history', function (Blueprint $table) {
            //
        });
    }
}
