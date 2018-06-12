<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSubStatusAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('medical_appointments', function (Blueprint $table) {
             $table->enum('sub_status', ['by doctor', 'by patient','in time', 'out of time by doctor', 'out of time by patient', 'cancel by doctor', 'cancel by patient'])->default('by patient');
             $table->boolean('aware')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('medical_appointments', function (Blueprint $table) {
            //
        });
    }
}
