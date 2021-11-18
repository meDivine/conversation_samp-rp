<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class server_logs extends Model
{
    use HasFactory;

    public function getipInfo ($ip) {
        $httpGet = Http::get("http://ip-api.com/json/$ip?fields=status,country,countryCode,regionName,city,lat,lon,timezone,isp,mobile,proxy,hosting&lang=ru");
        return json_decode($httpGet, true);
    }
}
