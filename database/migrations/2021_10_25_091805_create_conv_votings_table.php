<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConvVotingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conv_votings', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('conv_id');
            $table->string('comment')->nullable();
            $table->boolean('agree')->default(false);
            $table->boolean('disagree')->default(false);
            $table->boolean('neutral')->default(false);
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
        Schema::dropIfExists('conv_votings');
    }
}
