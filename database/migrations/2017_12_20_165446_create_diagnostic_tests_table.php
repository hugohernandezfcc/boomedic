<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiagnosticTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diagnostic_tests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->string('code')->nullable();
            $table->integer('parent')->unsigned()->nullable();
            $table->foreign('parent')->references('id')->on('diagnostic_tests');
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
        Schema::dropIfExists('diagnostic_tests');
    }
}
