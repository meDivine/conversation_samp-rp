<?php

namespace App\Http\Controllers\Api;

use App\Classes\Api\Captures;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GetCaptures extends Controller
{
    public function index(Request $request) {
        $input = $request->data;
        $captLogs = new Captures($input['dateStart'], $input['dateEnd']);
        $captLogs->getLogs();
    }
}
