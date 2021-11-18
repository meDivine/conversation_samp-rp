<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConversationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conversations', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('type');
            $table->string('social', '64');
            $table->string('nickname', '64');
            $table->text('about');
            $table->string('real_name');
            $table->text('leaderships');
            $table->unsignedBigInteger('who_start');
            $table->foreign('who_start')->references('id')->on('users');
            $table->integer('agree');
            $table->integer('disagree');
            $table->integer('neutral');
            $table->integer('who_close')->nullable();
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
        Schema::dropIfExists('conversations');
    }
}
