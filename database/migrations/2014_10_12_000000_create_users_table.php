<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->integer('vk_id', 11);
            $table->text('avatar');
            $table->string('nickname',32);
            $table->bool('punishmentsLog')->default(false);
            $table->bool('captureLog')->default(false);
            $table->bool('ipAuthLog')->default(false);
            $table->bool('GangBangLog')->default(false);
            $table->bool('nickNameLog')->default(false);
            $table->bool('inviteGiverankLog')->default(false);
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
        Schema::dropIfExists('users');
    }
}
