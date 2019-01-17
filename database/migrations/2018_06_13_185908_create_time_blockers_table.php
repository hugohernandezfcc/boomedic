<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimeBlockersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('time_blockers', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('type', ['professional commitment', 'Isnt possible attended'])->default('Isnt possible attended');
            $table->datetime('start');
            $table->datetime('end');
            $table->string('horary')->nullable();
            $table->integer('professional_inf')->unsigned();
            $table->foreign('professional_inf')->references('id')->on('professional_information');
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
        Schema::dropIfExists('time_blockers');
    }
}
