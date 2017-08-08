<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CorrectingFieldsUsersCamelCase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('userName');
            $table->dropColumn('firstName');
            $table->dropColumn('lastName');
            $table->dropColumn('placeBirth');
            $table->dropColumn('birthDate');
            $table->dropColumn('maritalStatus');
            $table->dropColumn('streetNumber');
            $table->dropColumn('interiorNumber');
            $table->dropColumn('officePhone');
            $table->dropColumn('familyDoctor');
            $table->dropColumn('phoneFd');
            $table->dropColumn('reasonForLastAppointment');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
