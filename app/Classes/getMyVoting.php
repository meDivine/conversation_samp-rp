<?php

namespace App\Classes;

use App\Models\conv_voting;

class getMyVoting
{
    /**
     * TODO исправить - временное и неправильное решение
     * Мега костыль, наберусь чуть опыта и исправлю :)
     * @param $vote
     * @return mixed
     */
    public static function getMyVote($vote) {
        $vote = new conv_voting();
        return $vote->getVotingInfoByName($vote);
    }
}
