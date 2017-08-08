<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CorrectingFieldsUsersCamelCase2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->nullable();
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->text('placebirth')->nullable();
            $table->date('birthdate')->nullable();
            $table->string('maritalstatus')->nullable();
            $table->text('streetnumber')->nullable();
            $table->text('interiornumber')->nullable();
            $table->text('officephone')->nullable();
            $table->text('familydoctor')->nullable();
            $table->text('phone')->nullable();
            $table->longText('reasonforlastappointment')->nullable();
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
