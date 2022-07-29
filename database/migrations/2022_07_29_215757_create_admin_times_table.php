<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_times', function (Blueprint $table) {
            $table->id();
            $table->integer('week_id');
            $table->string('nickname', 24);
            $table->integer('level');
            $table->tinyInteger('hours');
            $table->tinyInteger('minutes');
            $table->tinyInteger('seconds');
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
        Schema::dropIfExists('admin_times');
    }
};
