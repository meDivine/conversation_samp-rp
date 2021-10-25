<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConvStatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conv_stats', function (Blueprint $table) {
            $table->id();
            $table->integer('conv_id');
            $table->string('nick');
            $table->json('warns');
            $table->json('kicks');
            $table->json('bans');
            $table->json('report_log');
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
        Schema::dropIfExists('conv_stats');
    }
}
