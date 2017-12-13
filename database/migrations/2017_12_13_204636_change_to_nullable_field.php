<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeToNullableField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('professional_information', function (Blueprint $table) {
            $table->string('specialty')->nullable()->change();
            $table->string('schoolOfMedicine')->nullable()->change();
            $table->string('facultyOfSpecialization')->nullable()->change();
            $table->integer('practiseProfessional')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('professional_information', function (Blueprint $table) {
            //
        });
    }
}
