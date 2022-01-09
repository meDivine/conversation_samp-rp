<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Auth;
use Orchid\Screen\AsSource;

class conv_voting extends Model
{
    use HasFactory;
    use AsSource;

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

    public function profile(): HasOne {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    /**
     * Преобразуем тип голоса в смайлик
     * Мега костыль, исправлю как наберусь опыта :3
     * TODO исправить костыль
     * @param $vodeId
     * @return string|void
     */
    public static function getMyVotingStat($vodeId) {
        $voteInfo = self::where('conv_id', $vodeId)
            ->where('user_id', Auth::id())
            ->first();
        // \xF0\x9F\x91\x8D like
        // \xF0\x9F\x91\x8E dislike

        if (empty($voteInfo)) return "";
        else if ($voteInfo->agree) return "\xF0\x9F\x98\x8D";
        else if ($voteInfo->disagree) return "\xF0\x9F\x92\xA9";
        else if ($voteInfo->neutral) return "\xF0\x9F\x98\x91";
    }
}
