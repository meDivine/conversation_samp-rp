<?php

namespace App\Classes;

use App\Models\Bot;
use App\Models\Fraction;
use DOMNodeList;
use GuzzleHttp\Exception\GuzzleException;


class Logs
{
    public $type;
    public $nicknameOne;
    public $nicknameTwo;
    public $dateStart;
    public $dateEnd;

    public function __construct($type, $nicknameOne, $nicknameTwo, $dateStart, $dateEnd)
    {
        $this->type = $type;
        $this->nicknameOne = $nicknameOne;
        $this->nicknameTwo = $nicknameTwo;
        $this->dateStart = $dateStart;
        $this->dateEnd = $dateEnd;
    }

    private function renameFractionByID($id): string
    {
        $fraction = new Fraction();
        return $fraction->renameFracName($id);
    }

    private function tableToDom($getLogResponse)
    {
        $logsTable = new LogsTableManipulate($getLogResponse);
        return $logsTable->tableToDom();
    }

    /**
     * @throws GuzzleException
     */
    private function getCaptureLog(): array
    {
        /*
         * Создадим экземпляр класса и выполним запрос
         * Нам вернётся html документ
         */
        $logsTableResponse = new LogsTableResponse(
            "capture",
            null,
            null,
            $this->dateStart,
            $this->dateEnd,
            null,
            null,
            "time_diapzon_1",
            "time_diapzon_2"
        );
        /*
         * Обработаем документ и вернем готовые данные
         */
        $table = $logsTableResponse->responseToLogsSampRp();
        $rows = $this->tableToDom($table);
        $capture = []; // пустой массив куда будем забивать данные
        foreach ($rows as $row) { // пройдемся циклом по таблице
            $cols = $row->getElementsByTagName('td'); // выберем все данные внутри тэга <td>
            $captureStruct = [
                'Server Time' => trim($cols[1]->nodeValue ?? null, "[]"), // удаляем лишнее
                'Server' => (int)trim($cols[2]->nodeValue ?? null, "[]"),
                'Fraction' => $this->renameFractionByID((int)trim($cols[3]->nodeValue ?? 1, "[]")), // поменяем название фракции c ида на имя
                'Player' => trim($cols[4]->nodeValue ?? null, "[]"),
                'Property' => (int)trim($cols[5]->nodeValue ?? null, "[]"),
                'Owner' => $this->renameFractionByID((int)trim($cols[6]->nodeValue ?? 1, "[]")),
            ];
            $capture[] = $captureStruct; // заполняем массив
        }
        unset($capture[0]); // удалим массив с ключом 0 ибо он всегда null в нашем случае
        return $capture ?? []; // вернем значение
    }

    /**
     * Возьмем логи ников
     * @throws GuzzleException
     */

    private function getNickNameLog(): array
    {
        $logsTableResponse = new LogsTableResponse(
            "changename",
            $this->nicknameOne,
            "rename",
            null,
            null,
            "user_name",
            "log",
            null,
            null
        );
        $table = $logsTableResponse->responseToLogsSampRp();
        $rows = $this->tableToDom($table);
        $nicknames = [];
        foreach ($rows as $row) {
            $cols = $row->getElementsByTagName('td'); // выберем все данные внутри тэга <td>
            $nicknameColumns = [
                'Дата/время' => trim($cols[0]->nodeValue ?? null, "[]"),
                'Сервер' => trim($cols[1]->nodeValue ?? null, "[]"),
                'Администратор' => trim($cols[2]->nodeValue ?? null, "[]"),
                'Старое имя' => trim($cols[3]->nodeValue ?? null, "[]"),
                'Новое имя' => trim($cols[4]->nodeValue ?? null, "[]"),
            ];
            $nicknames[] = $nicknameColumns;
        }
        unset($nicknames[0]);
        return $nicknames ?? [];
    }


    /*
     * Логи складов фракции
     */

    public function getFractions() {
        $logsTableResponse = new LogsTableResponse(
            "inunvite",
            $this->nicknameOne,
            $this->nicknameTwo,
            $this->dateStart,
            $this->dateEnd,
            "Leader",
            "Player",
            "time_diapzon_1",
            "time_diapzon_2"
        );
        $table = $logsTableResponse->responseToLogsSampRpFraction();
        $rows = $this->tableToDom($table);
        $fracLog = [];
        foreach ($rows as $row) {
            $cols = $row->getElementsByTagName('td'); // выберем все данные внутри тэга <td>
            $fracTemplate = [
                'Дата/время' => trim($cols[1]->nodeValue ?? null, "[]"),
                'Сервер' => trim($cols[2]->nodeValue ?? null, "[]"),
                'Тип' => trim($cols[3]->nodeValue ?? null, "[]"),
                'Лидер' => trim($cols[4]->nodeValue ?? null, "[]"),
                'Игрок' => trim($cols[5]->nodeValue ?? null, "[]"),
                'Фракция' => trim($cols[6]->nodeValue ?? null, "[]"),
                'Ранг' => trim($cols[7]->nodeValue ?? null, "[]"),
                'Причина' => trim($cols[8]->nodeValue ?? null, "[]"),
            ];
            $fracLog[] = $fracTemplate;
        }
        unset($fracLog[0]);
        return $fracLog ?? []; // вернем пустой массив если парсер выдал пустые данные
    }

    private function getIpAuth() {
        $logsTableResponse = new LogsTableResponse(
            "login",
            $this->nicknameOne,
            $this->nicknameTwo,
            $this->dateStart,
            $this->dateEnd,
            "Player",
            "PlayerIP",
            "time_diapzon_1",
            "time_diapzon_2"
        );

        $table = $logsTableResponse->responseToLogsSampRpFraction();
        $rows = $this->tableToDom($table);
        $ipLog = [];
        foreach ($rows as $row) {
            $cols = $row->getElementsByTagName('td'); // выберем все данные внутри тэга <td>
            $ip = trim($cols[4]->nodeValue ?? null, "[]");
            $ipapi = new ipApi($ip);
            $ipInfo = $ipapi->getIpInfo();
            $ipAuthTemplate = [
                'Дата/время' => trim($cols[1]->nodeValue ?? null, "[]"),
                'Сервер' => trim($cols[2]->nodeValue ?? null, "[]"),
                'Игрок' => trim($cols[3]->nodeValue ?? null, "[]"),
                'IP Игрока' => $ip,
                'Страна' => $ipInfo->country_name,
                'Регион' => $ipInfo->region,
                'Город' => $ipInfo->region,
                'Провайдер' => $cols[7]->nodeValue ?? null
            ];
        }
    }

    /**
     * @throws GuzzleException
     */
    private function getPunishments() {
        $logsTableResponse = new LogsTableResponse(
            "kickban",
            $this->nicknameOne,
            $this->nicknameTwo,
            $this->dateStart,
            $this->dateEnd,
            "Player",
            "Admin",
            "time_diapzon_1",
            "time_diapzon_2"
        );
        $table = $logsTableResponse->responseToLogsSampRp();
        $rows = $this->tableToDom($table);
        $nicknames = [];
        foreach ($rows as $row) {
            $cols = $row->getElementsByTagName('td'); // выберем все данные внутри тэга <td>
            $nicknameColumns = [
                'Дата/время' => trim($cols[1]->nodeValue ?? null, "[]"),
                'Сервер' => trim($cols[2]->nodeValue ?? null, "[]"),
                'Тип' => trim($cols[3]->nodeValue ?? null, "[]"),
                'Админ' => trim($cols[4]->nodeValue ?? null, "[]"),
                'Игрок' => trim($cols[5]->nodeValue ?? null, "[]"),
                'Причина' => $cols[6]->nodeValue ?? null
            ];
            $nicknames[] = $nicknameColumns;
        }
        unset($nicknames[0]);
        return $nicknames ?? [];
    }
    /**
     * @throws GuzzleException
     */
    public function getLogs()
    {
        switch ($this->type) {
            case "capture_search":
                return $this->getCaptureLog();
            case "names_search":
                return $this->getNickNameLog();
            case "punishments_search":
                return $this->getPunishments();
            case "fraction_search":
                return $this->getFractions();
        }
    }
}
