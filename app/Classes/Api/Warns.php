<?php

namespace App\Classes\Api;

use App\Classes\Logs;
use Carbon\Carbon;
use GuzzleHttp\Exception\GuzzleException;

class Warns
{
    public $nick;

    public function __construct($nick)
    {
        $this->nick = $nick;
    }

    /**
     * @throws GuzzleException
     */
    public function getWarnLogs(): \Illuminate\Http\JsonResponse
    {
        $logs = new Logs("punishments_api_search", $this->nick, null, '01.01.2010', Carbon::now()->format('d.m.Y'));
        return response()->json($logs->getLogs());
    }
}
