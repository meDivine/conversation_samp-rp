<?php

namespace App\Classes;

use App\Models\Bot;

class LogsTableResponse
{
    public $link;
    public $nicknameOne;
    public $nicknameTwo;
    public $time_diapazon_1;
    public $time_diapazon_2;
    public $postInputOne;
    public $postInputTwo;
    public $postInputThree;
    public $postInputFour;

    public function __construct(
        $link,
        $nicknameOne,
        $nicknameTwo,
        $time_diapazon_1,
        $time_diapazon_2,
        $postInputOne,
        $postInputTwo,
        $postInputThree,
        $postInputFour
    ) {
        $this->link = $link;
        $this->nicknameOne = $nicknameOne;
        $this->nicknameTwo = $nicknameTwo;
        $this->time_diapazon_1 = $time_diapazon_1;
        $this->time_diapazon_2 = $time_diapazon_2;
        $this->postInputOne = $postInputOne;
        $this->postInputTwo = $postInputTwo;
        $this->postInputThree = $postInputThree;
        $this->postInputFour = $postInputFour;
    }
    /*
     * Макс 4 инпута в пост запросе
     * Решил создавать класс с заранее забитыми данными
     */
    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function responseToLogsSampRp()
    {
        $bot = new Bot();
        return $bot->Client()->request('POST', "/work/$this->link.php", [
            'headers' => [
                'Cookie' => $bot->login()
            ],
            'form_params' => [
                $this->postInputOne = $this->nicknameOne,
                $this->postInputTwo = $this->nicknameTwo,
                $this->postInputThree => $this->time_diapazon_1,
                $this->postInputFour => $this->time_diapazon_2,
            ]
        ])->getBody()->getContents();
    }
}
