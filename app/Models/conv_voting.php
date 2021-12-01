<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class conv_voting extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'conv_id',
        'comment',
        'agree',
        'disagree',
        'neutral'
    ];

    public function addVote($conv_id, $comment = null,
                            $agree = false, $disagree = false, $neutral = true): Model|conv_voting
    {
        $uid = Auth::id();
        return self::updateOrCreate(
            [
                'user_id'   => $uid,
                'conv_id'   => $conv_id
            ],
            [
                'user_id'   => $uid,
                'conv_id'   => $conv_id,
                'comment'   => $comment,
                'agree'     => $agree,
                'disagree'  => $disagree,
                'neutral'   => $neutral
            ]);
    }

    public function getVotingInfoByName($conv_id) {
        return conv_voting::where('user_id', \Auth::id())
            ->where('conv_id', $conv_id)
            ->whereNotNull('conv_id')
            ->WhereNotNull('user_id')
            ->first();
    }
}
