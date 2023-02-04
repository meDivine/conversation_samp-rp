<?php

namespace App\Http\Controllers\Api;

use App\Classes\Api\Warns;
use App\Http\Controllers\Controller;
use App\Models\apicodes;
use Illuminate\Http\Request;

class WarnController extends Controller
{
    public function index($nick, $key)
    {
        if (apicodes::query()->where('user_key', $key)->first()) {
            $warns = new Warns($nick);
            return $warns->getWarnLogs();
        } else
            abort(403);
    }
}
