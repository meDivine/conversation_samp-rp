<?php

namespace App\Classes;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

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
/**
 * Undocumented function
 *
 * @param [type] $link
 * @param [type] $nicknameOne
 * @param [type] $nicknameTwo
 * @param [type] $time_diapazon_1
 * @param [type] $time_diapazon_2
 * @param [type] $postInputOne
 * @param [type] $postInputTwo
 * @param [type] $postInputThree
 * @param [type] $postInputFour
 */
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

    private function Client():Client
    {
        return new Client([
            'base_uri' => 'https://logs.samp-rp.su/work/"',
            'verify' => false,
            'allow_redirects' => true,
            'headers' => [
                'User-Agent' => 'Mozilla/5.0 (Linux 3.4; rv:64.0) Gecko/20100101 Firefox/15.0',
                'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
                'Content-Type' => 'application/x-www-form-urlencoded'
            ]
        ]);
    }

    private function login(): string
    {
        $client = $this->Client();

        $login = $client->request('POST', '/work/', [
            'form_params' => [
                'admin_login' => config('services.logsbot.bot_name'),
                'admin_password' => config('services.logsbot.bot_password'),
                'admin_key' => config('services.logsbot.bot_secret')
            ]
        ]);
        return $login->getHeaderLine('Set-Cookie');
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function responseToLogsSampRp(): ResponseInterface
    {
        $client = new Client([
            'base_uri' => 'https://logs.samp-rp.su/"',
            'verify' => false,
            'allow_redirects' => false,
            'headers' => [
                'User-Agent' => 'Mozilla/5.0 (Linux 3.4; rv:64.0) Gecko/20100101 Firefox/15.0',
                'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
                'Content-Type' => 'application/x-www-form-urlencoded'
            ]
        ]);

        return $client->request('POST', "/work/$this->link.php", [
            'debug' => fopen('php://stderr', 'w'),
            'headers' => [
                'Cookie' => $this->login()
            ],
            'form_params' => [
                $this->postInputOne => $this->nicknameOne,
                $this->postInputTwo => $this->nicknameTwo,
                $this->postInputThree => $this->time_diapazon_1,
                $this->postInputFour => $this->time_diapazon_2,
            ]
        ]);
    }

    public function responseToLogsSampRpFraction(): ResponseInterface
    {
        $client = new Client([
            'base_uri' => 'https://logs.samp-rp.su/"',
            'verify' => false,
            'allow_redirects' => false,
            'headers' => [
                'User-Agent' => 'Mozilla/5.0 (Linux 3.4; rv:64.0) Gecko/20100101 Firefox/15.0',
                'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
                'Content-Type' => 'application/x-www-form-urlencoded'
            ]
        ]);

        return $client->request('POST', "/work/$this->link.php", [
            'debug' => fopen('php://stderr', 'w'),
            'headers' => [
                'Cookie' => $this->login()
            ],
            'form_params' => [
                $this->postInputOne => $this->nicknameOne,
                $this->postInputTwo => $this->nicknameTwo,
                $this->postInputThree => $this->time_diapazon_1,
                $this->postInputFour => $this->time_diapazon_2,
                'GangID_1' => true,
                'GangID_17' => true,
                'GangID_19' => true,
                'GangID_18' => true,
                'GangID_2' => true,
                'GangID_3' => true,
                'GangID_7' => true,
                'GangID_4' => true,
                'GangID_5' => true,
                'GangID_6' => true,
                'GangID_8' => true,
                'GangID_9' => true,
                'GangID_10' => true,
                'GangID_21' => true,
                'GangID_11' => true,
                'GangID_12' => true,
                'GangID_13' => true,
                'GangID_14' => true,
                'GangID_15' => true,
                'GangID_16' => true,
                'GangID_22' => true,
                'GangID_23' => true,
                'GangID_24' => true,
                'GangID_25' => true,
                'GangID_26' => true,
                'GangID_27' => true,
                'GangID_28' => true,
                'GangID_29' => true,
                'GangID_30' => true,
                'GangID_31' => true,
            ]
        ]);
    }
}
