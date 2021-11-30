<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class conv_discussion extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'conv_id',
        'message'
    ];
    /*
     * Добавление сообщения
     */
    public function addMessage($message, $conv_id)
    {
        return self::create([
            'user_id' => \Auth::id(),
            'conv_id' => $conv_id,
            'message' => $message
        ]);
    }
    /*
     * Связь с таблицей Users
     */
    public function userInfo() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    /*
     * Достаем сообщения с инфой о юзере
     * если делать запрос без with, то получим N+1
     */
    public function getMessages($conv_id) {
        return self::where('conv_id', $conv_id)
            ->with('userInfo')
            ->latest()
            ->get();
    }
}
