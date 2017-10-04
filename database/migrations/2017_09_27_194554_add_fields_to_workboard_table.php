<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToWorkboardTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('workboard', function (Blueprint $table) {
            $table->boolean('monday')->nullable();
            $table->boolean('tuesday')->nullable();
            $table->boolean('wednesday')->nullable();
            $table->boolean('thursday')->nullable();
            $table->boolean('friday')->nullable();
            $table->boolean('saturday')->nullable();
            $table->boolean('sunday')->nullable();

            $table->time('startMon')->nullable();
            $table->time('startTue')->nullable();
            $table->time('startWed')->nullable();
            $table->time('startThu')->nullable();
            $table->time('startFri')->nullable();
            $table->time('startSat')->nullable();
            $table->time('startSun')->nullable();

            $table->time('endMon')->nullable();
            $table->time('endTue')->nullable();
            $table->time('endWed')->nullable();
            $table->time('endThu')->nullable();
            $table->time('endFri')->nullable();
            $table->time('endSat')->nullable();
            $table->time('endSun')->nullable();

            $table->dropColumn(['workingDays', 'workingHours']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('workboard', function (Blueprint $table) {
            $table->dropColumn(['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday', 'startMon', 'startTue', 'startWed', 'startThu', 'startFri', 'startSat', 'startSun', 'endMon', 'endTue', 'endWed', 'endThu', 'endFri', 'endSat', 'endSun']);
            $table->string('workingDays')->nullable();
            $table->string('workingHours')->nullable();
        });
    }
}