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
        $reg = $bot->getRegInfo("Pavel_Snow");
    }

    private function getConvers($id) {
        $conv = new conversation();
        return $conv->getConvers($id);
    }

    public function index($id) {
        $convinfo = $this->getConvers($id);
        $warns = $convinfo->convlog->warns;
        $kicks = $convinfo->convlog->kicks;
        $bans = $convinfo->convlog->bans;
        $stats = $convinfo->convlog->reg_info;
        return view('components.get.admin.admininfo', compact('convinfo', 'warns', 'kicks', 'bans', 'stats'));
    }
}
