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

    public function addMessage($message, $conv_id) {
        return self::create([
            'user_id' => \Auth::id(),
            'convr_id' => $conv_id,
            'message' => $message
        ]);
    }
}
