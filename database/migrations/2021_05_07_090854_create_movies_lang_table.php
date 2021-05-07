<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoviesLangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies_lang', function (Blueprint $table) {
            $table->unsignedBigInteger('todo_id');
            $table->unsignedInteger('language_id');
            $table->primary(['todo_id', 'language_id']);
            $table
                ->foreign('todo_id')
                ->references('id')
                ->on('todos')
                ->onDelete('cascade')
                ->onUpdate('cascade')
            ;
            $table
                ->foreign('language_id')
                ->references('id')
                ->on('languages')
                ->onDelete('cascade')
                ->onUpdate('cascade')
            ;
            $table->string('title',255);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movies_lang');
    }
}
