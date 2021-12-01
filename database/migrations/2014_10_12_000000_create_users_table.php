<?php

use App\Models\User;
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
            $table->integer('vk_id');
            $table->text('avatar');
            $table->string('nickname',32)->nullable();
            $table->boolean('capture_info')->default(false);
            $table->rememberToken();
            $table->timestamps();
        });
        User::create([
            'name' => 'Александр',
            'avatar' => 'https://cs13.pikabu.ru/avatars/3425/x3425772-1402976383.png',
            'nickname' => 'Lucian_Butchers',
            'email' => 'test@test',
            'vk_id' => '228',
        ]);
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
