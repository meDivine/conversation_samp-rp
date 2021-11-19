<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCaptureLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('capture_logs', function (Blueprint $table) {
            $table->id();
            $table->dateTime('servertime');
            $table->tinyInteger('fraction');
            $table->integer('server');
            $table->string('player', 24);
            $table->integer('property');
            $table->integer('owner');
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
        Schema::dropIfExists('capture_logs');
    }
}
