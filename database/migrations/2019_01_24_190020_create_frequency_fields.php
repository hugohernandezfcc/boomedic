<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFrequencyFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cli_recipes_tests', function (Blueprint $table) {
            $table->integer('frequency_days')->nullable();
            $table->text('posology')->nullable();
        });
        Schema::table('medications', function (Blueprint $table) {
         $table->dropColumn('posology');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cli_recipes_tests', function (Blueprint $table) {
            //
        });
    }
}
