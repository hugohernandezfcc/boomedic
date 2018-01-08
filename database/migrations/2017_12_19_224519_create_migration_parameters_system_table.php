<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMigrationParametersSystemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parameters_system', function (Blueprint $table) {
            $table->increments('id');

            $table->text('use')->nullable();
            $table->text('where')->nullable();
            $table->text('value')->nullable();
            $table->text('code')->nullable();
            $table->text('type')->nullable();

            $table->integer('self')->unsigned()->nullable();
            $table->foreign('self')->references('id')->on('parameters_system');

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
        Schema::dropIfExists('parameters_system');
    }
}
