<?php

namespace App\Models;

use DOMDocument;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bot extends Model
{
    use HasFactory;


    /*
     * Авторизуемся и получим куки
     */
    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function login(): string
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

        $login = $client->request('POST', '/work/', [
            'form_params' => [
                'admin_login' => config('services.logsbot.bot_name'),
                'admin_password' => config('services.logsbot.bot_password'),
                'admin_key' => config('services.logsbot.bot_secret')
            ]
        ]);
        return $login->getHeaderLine('Set-Cookie');
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    /*
     *Получим табличку и распарсим ее
     *
     */
    public function getCaptureLog(): array
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

        $discounts = $client->request('POST', '/work/capture.php', [
            'headers' => [
                'Cookie' => $this->login()
            ],
            'form_params' => [
                'time_diapzon_1' => '14.11.2021',
                'time_diapzon_2' => '17.11.2021',
            ]
        ]);
        $tableObject = $discounts->getBody()->getContents();
        $dom = new domDocument();
        $dom->loadHTML($tableObject);
        $dom->preserveWhiteSpace = false;
        $tables = $dom->getElementsByTagName('table');
        $rows = $tables->item(0)->getElementsByTagName('tr'); //
        $capture = []; // пустой массив куда будем забивать данные
        foreach ($rows as $key) {
            $cols = $key->getElementsByTagName('td'); // берем все данные с таблички и в цикле считываем их
            $captureData = [
                'DateTime' => $cols[1],
                'Server' => $cols[2],
                'Faction' => $cols[3],
                'Player' => $cols[4],
                'Property' => $cols[5],
                'Owner' => $cols[6]
            ];
            array_push($capture, $captureData); // забьем массив данными
        }
        unset($capture[0]); // ключ 0 в массиве будет пустым ибо в табличке 1 строка пустая - пропустим ее
        return $capture;
    }
}
