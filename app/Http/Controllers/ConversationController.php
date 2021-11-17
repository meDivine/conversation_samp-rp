<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ConversationController extends Controller
{
    /*
     * тестовая версия
     */
    public function parse()
    {
        $client = new Client([
            'base_uri' => 'https://logs.samp-rp.su/"',
            'verify' => false,
            'allow_redirects' => false,
            'headers' => [
                'User-Agent' => 'Mozilla/5.0 (Linux 3.4; rv:64.0) Gecko/20100101 Firefox/15.0',
                'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
                'Content-Type' => 'application/x-www-form-urlencoded'
            ]
        ]);

        $login = $client -> request('POST','/work/',[
            'form_params' => [
                'admin_login'   => '',
                'admin_password'      => '',
                'admin_key'      => ''
            ]
        ]);
        print($login -> getStatusCode());
        $cookie   = $login  -> getHeaderLine('Set-Cookie');

        $discounts = $client -> request('GET','/work/paylog.php',[
            'headers' => [
                'Cookie' => $cookie
            ],
            /*'debug' => true*/
        ]);
        echo $discounts -> getBody() -> getContents();

        //print $articles -> getStatusCode();
        return $login -> getBody() -> getContents();


    }
}
