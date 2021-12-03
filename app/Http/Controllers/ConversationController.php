<?php

namespace App\Http\Controllers;

use App\Models\Bot;
use App\Models\conversation;
use App\Models\User;
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
        /*$bot = new Bot();
        return $bot->getRegInfo("Pavel_Snow");*/
        $conv = new User();
        return $conv->getEnabledNotifyVK();
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
        $suplogs = $convinfo->convlog->support_log ?? null; // по сути это надо делать в шаблоне
        $replogs = $convinfo->convlog->report_log ?? null;
        return view('components.get.admin.admininfo', compact('convinfo', 'warns', 'kicks', 'bans', 'stats', 'suplogs', 'replogs'));
    }
}
