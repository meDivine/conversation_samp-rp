<?php

namespace App\Classes;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class ipApi
{
    public $ip;

    public function __construct($ip)
    {
        $this->ip = $ip;
    }

    public function getIpInfo(): Response
    {
        return Http::get("https://ipapi.co/$this->ip/json/");
    }
}
