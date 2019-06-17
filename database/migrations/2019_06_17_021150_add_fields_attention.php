<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsAttention extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('medical_appointments', function (Blueprint $table) {
            $table->string('Height')->nullable();
            $table->string('weight')->nullable();
            $table->string('temperature')->nullable();
            $table->string('cranial_capacity')->nullable();
            $table->string('waist_diameter')->nullable();
            $table->string('blood_pressure_pa')->nullable();
            $table->string('heart_rate')->nullable();
            $table->string('breathing_frequency')->nullable();
            $table->string('descriptions')->nullable();
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
