<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsemailDiagnosticResult extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('diagnostic_test_result', function (Blueprint $table) {
            $table->longtext('header_email')->nullable(); 
            $table->longtext('body_email')->nullable(); 
            $table->longtext('structure_email')->nullable();
            $table->datetime('date_email')->nullable();
            $table->text('subject_email')->nullable();
            $table->longtext('text_email')->nullable(); 

            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('diagnostic_test_result', function (Blueprint $table) {
            //
        });
    }
}
