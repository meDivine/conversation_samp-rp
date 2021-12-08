<?php

namespace App\Http\Controllers;

use App\Classes\Logs;
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
        $logs = new Logs("capture_search","asd", "asd", "09.11.2021", "10.11.2021");
        $log = $logs->getLogs();
        echo "<pre>";
        foreach ($log as $loger => $key) {
            print_r(array_keys($key))."<br>";
        }
        echo "</pre>";
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
