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
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->unsignedBigInteger('conv_id');
            $table->foreign('conv_id')->references('id')->on('conversations');
            $table->string('nick');
            $table->json('warns');
            $table->json('kicks');
            $table->json('bans');
            $table->json('reg_info')->nullable();
            $table->json('report_log');
            $table->json('support_log');
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
