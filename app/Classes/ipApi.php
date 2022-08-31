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
        return Http::get("https://api.ipgeolocation.io/ipgeo?apiKey=7744c1ec2234467bb84832f4097b5072&ip=$this->ip");
    }

    public function getCountryFlag($counrtyCode): string
    {
        return (new CountryFlag)->get($counrtyCode);
    }
}
