<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenamingTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('ProfessionalInformation', 'professional_information');
        Schema::rename('LaborInformation', 'labor_information');
        Schema::rename('history_session', 'history_session');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('professional_information', 'ProfessionalInformation');
        Schema::rename('labor_information', 'LaborInformation');
        Schema::rename('history_session', 'history_session');
    }
}
