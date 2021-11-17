<?php

namespace App\Http\Controllers;

use App\Models\Bot;
use GuzzleHttp\Client;

class ConversationController extends Controller
{
    /*
     * тестовая версия
     */
    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function parse()
    {
        $bot = new Bot();
        $capture = $bot->getCaptureLog();
        foreach ($capture as $item) {
            $date = $item['DateTime']->nodeValue;
            $server = $item['Server']->nodeValue;
            echo "Дата $date, Сервер $server"."<br>";
        }
    }
}
