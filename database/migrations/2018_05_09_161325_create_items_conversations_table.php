<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsConversationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items_conversations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('by')->unsigned()->nullable();
            $table->foreign('by')->references('id')->on('users');
            $table->text('name')->nullable();
            $table->integer('conversation')->unsigned()->nullable();
            $table->foreign('conversation')->references('id')->on('conversations');          
            $table->enum('type', ['Question', 'Answer', 'Answer to Answer'])->nullable();
            $table->integer('parent')->unsigned()->nullable();
            $table->foreign('parent')->references('id')->on('items_conversations'); 
            $table->longtext('text_body')->nullable();                                   
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
        Schema::dropIfExists('items_conversations');
    }
}
