<?php

namespace App\Classes;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Stidges\CountryFlags\CountryFlag;

class ipApi
{
    public $ip;

    public function __construct($ip)
    {
        $this->ip = $ip;
    }

    public function getIpInfo(): Response
    {
        return Http::get("https://ip-api.com/$this->ip/json/");
    }

    public function getCountryFlag($counrtyCode): string
    {
        return (new CountryFlag)->get($counrtyCode);
    }
}
