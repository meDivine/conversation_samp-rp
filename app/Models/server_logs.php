<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Request;

class server_logs extends Model
{
    use HasFactory;

    protected $fillable = [
        'userid',
        'nick',
        'action',
        'ip',
        'city',
        'region',
        'country',
        'vpn',
    ];

    public function getipInfo ($ip) {
        $httpGet = Http::get("http://ip-api.com/json/$ip?fields=status,country,countryCode,regionName,city,lat,lon,timezone,isp,mobile,proxy,hosting&lang=ru");
        return json_decode($httpGet, true);
    }

    public function addLog($act) {
        $ipinfo = $this->getipInfo(Request::ip()) ?? "n/a";
        return self::create([
            'action' => $act,
            'city' => $ipinfo['city'],
            'ip' => Request::ip(),
            'country' => $ipinfo['country'],
            'nick' => Auth::user()->nickname,
            'userid' => Auth::id(),
            'vpn' => 'proxy',
            'region' => $ipinfo['regionName']
        ]);
    }
}
