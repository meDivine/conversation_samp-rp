<?php

namespace App\Models;

use DOMDocument;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Psr\Http\Message\ResponseInterface;

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

    public function getPunishmentsLog($nick)
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

        $getrow = $client->request('POST', '/work/kickban.php', [
            'headers' => [
                'Cookie' => $this->login()
            ],
            'form_params' => [
                'Player' => $nick,
                'Admin' => '',
                'time_diapzon_1' => '01.01.2015',
                'time_diapzon_2' => '17.11.2021',
            ]
        ]);
        $rows = $this->getRows($getrow); //
        $punishments = []; // пустой массив куда будем забивать данные
        foreach ($rows as $row) { // собираю массив
            $cols = $row->getElementsByTagName('td');
            $tableTemplate = [
                'DateTime' => $cols[1],
                'Server' => $cols[2],
                'Type' => $cols[3],
                'Admin' => $cols[4],
                'Player' => $cols[5],
                'Reason' => $cols[6]
            ];
            array_push($punishments, $tableTemplate);
        }
        unset($punishments[0]);
        /*
         * Пока не придумаю как лучше сделать, будет так
         * Пройдемся еще раз по массиву, но уже с фильтром.
         */
        $warns = [];
        $bans = [];
        $kicks = [];

        foreach ($punishments as $punishment) {
            $date = trim($punishment['DateTime']->nodeValue, "[]");
            $type = trim($punishment['Type']->nodeValue, "[]");
            $admin = trim($punishment['Admin']->nodeValue, "[]");
            $reason = $punishment['Reason']->nodeValue;
            switch ($type) {
                case "UnBan":
                    array_push($bans,"Дата: $date | Тип: Разбан | Админ: $admin | Причина: $reason");
                    break;
                case "Ban":
                    array_push($bans, "Дата: $date | Тип: Бан | Админ: $admin | Причина: $reason");
                    break;
                case "OffBan":
                    array_push($bans, "Дата: $date | Тип: ОффБан | Админ: $admin | Причина: $reason");
                    break;
                case "IBan":
                    array_push($bans, "Дата: $date | Тип: Бан 2038 | Админ: $admin | Причина: $reason");
                    break;
                case "IOffBan":
                    array_push($bans, "Дата: $date | Тип: ОффБан 2038 | Админ: $admin | Причина: $reason");
                    break;
                case "Kick":
                    array_push($kicks, "Дата: $date | Тип: Кик | Админ: $admin | Причина: $reason");
                    break;
                case "SKick":
                    array_push($kicks, "Дата: $date | Тип: Тихий кик | Админ: $admin | Причина: $reason");
                    break;
                case "Warn":
                    array_push($warns, "Дата: $date | Тип: Варн | Админ: $admin | Причина: $reason");
                    break;
                case "BWarn":
                    array_push($warns, "Дата: $date | Тип: БВарн | Админ: $admin | Причина: $reason");
                    break;
                case "UnWarn":
                    array_push($warns, "Дата: $date | Тип: Снятие варна | Админ: $admin | Причина: $reason");
                    break;
                case "DelWarn":
                    array_push($warns, "Дата: $date | Тип: Удаление варна | Админ: $admin | Причина: $reason");
                    break;
            }
        }
        return [
            'Warns' => json_encode($warns, JSON_UNESCAPED_UNICODE),
            'Bans'=> json_encode($bans, JSON_UNESCAPED_UNICODE),
            'Kicks' => json_encode($kicks, JSON_UNESCAPED_UNICODE)
        ];
    }

    public function getRegInfo($nick) {
        $server_logs = new server_logs();
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

        $getrow = $client->request('POST', '/work/register.php', [
            'headers' => [
                'Cookie' => $this->login()
            ],
            'form_params' => [
                'Player' => $nick,
                'Promocode' => '',
                'time_diapzon_1' => '01.01.2015',
                'time_diapzon_2' => '17.11.2021',
            ]
        ]);
        //
       $rows = $this->getRows($getrow);
       /*
        *
        */
        $userlog = [];
       foreach ($rows as $row) {
           $cols = $row->getElementsByTagName('td');
           array_push($userlog, $cols[4]);
       }
       unset($userlog[0]);

       $userip = trim($userlog[1]->nodeValue ?? null, "[]");
       return $userip != null? $server_logs->getipInfo($userip) : json_encode(['value' => 'пусто'], JSON_UNESCAPED_UNICODE);
    }

    public function getSupportReportLog($nick) {
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

        $getrow = $client->request('POST', '/work/support.php', [
            'headers' => [
                'Cookie' => $this->login()
            ],
            'form_params' => [
                'Sender' => $nick,
                'Recipient' => '',
                'time_diapzon_1' => '01.01.2011',
                'time_diapzon_2' => '17.11.2021',
            ]
        ]);
        $rows = $this->getRows($getrow); //
        $report = []; // пустой массив куда будем забивать данные
        foreach ($rows as $row) {
            $cols = $row->getElementsByTagName('td');
            $DateTime = $cols[1]->nodeValue ?? null;
            $Server = $cols[2]->nodeValue ?? null;
            $Sender = $cols[3]->nodeValue ?? null;
            $Recipient = $cols[4]->nodeValue ?? null;
            $Text = $cols[5]->nodeValue ?? null;
            array_push($report, "Дата $DateTime | Отправитель: $Sender | Получатель $Recipient | Текст: $Text");
        }
        unset($report[0]);
        var_dump($report);
    }
    /**
     * @param ResponseInterface $getrow
     * @return mixed
     */
    public function getRows(ResponseInterface $getrow)
    {
        $tableObject = $getrow->getBody()->getContents();
        $dom = new domDocument("1.0", "UTF-8");
        $dom->loadHTML("\xEF\xBB\xBF" . $tableObject, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $dom->preserveWhiteSpace = false;
        $tables = $dom->getElementsByTagName('table');
        return $tables->item(0)->getElementsByTagName('tr');
    }
}
