<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDiagnosticsTableCliRecipes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cli_recipes_tests', function (Blueprint $table) {
            $table->integer('diagnostic')->unsigned()->nullable();
            $table->foreign('diagnostic')->references('id')->on('diagnostics');
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
