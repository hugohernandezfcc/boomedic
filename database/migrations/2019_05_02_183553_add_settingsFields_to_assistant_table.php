<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSettingsFieldsToAssistantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('assistant', function (Blueprint $table) {
            $table->enum('profile', ['none', 'read', 'write'])->default('none');
            $table->enum('calendar', ['none', 'read', 'write'])->default('none');
            $table->enum('chat', ['none', 'read', 'write'])->default('none');   
            $table->enum('assistant', ['none', 'read', 'write'])->default('none');      
            $table->enum('workboard', ['none', 'read', 'write'])->default('none');                                      
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('assistant', function (Blueprint $table) {
            $table->dropColumn('profile');
            $table->dropColumn('calendar');
            $table->dropColumn('chat');   
            $table->dropColumn('assistant');      
            $table->dropColumn('workboard');       
        });
    }
}
