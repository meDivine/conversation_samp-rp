<?php

namespace App\Http\Controllers;

use App\Models\Bot;
use App\Models\conversation;
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
        return $bot->getPunishmentsLog("Pavel_Snow");

    }

    private function getConvers($id) {
        $conv = new conversation();
        return $conv->getConvers($id);
    }

    public function index($id) {
        $convinfo = $this->getConvers($id);
        $warns = $convinfo->convlog->warns;
        return view('components.get.admin.admininfo', compact('convinfo', 'warns'));
    }
}
