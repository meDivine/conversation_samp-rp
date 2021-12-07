<?php

namespace App\Classes;

use App\Models\Bot;
use DOMDocument;

class Logs
{
    public string $type;
    public string $nicknameOne;
    public string $nicknameTwo;
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


    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function getCaptureLog(): array {
        /*
         * Создадим экземпляры нужных классов для работы
         */
        $bot = new Bot();
        $dom = new domDocument();
        /*
         * Используем заранее подготовленные данные о клиенте
         */
        /*
         * Отправим запрос
         * Залогинимся через метод login
         */
        $getLogResponse = $bot->Client()->request('POST', '/work/capture.php', [
            'headers' => [
                'Cookie' => $bot->login()
            ],
            'form_params' => [
                'time_diapzon_1' => $this->dateStart,
                'time_diapzon_2' => $this->dateEnd,
            ]
        ]);

        $tableObject = $getLogResponse->getBody()->getContents(); // Возьмем тело html документа после выполненного запроса
        $dom->loadHTML($tableObject);
        $dom->preserveWhiteSpace = false;
        $tables = $dom->getElementsByTagName('table'); // Найдем данные внутри тэга <table>
        $rows = $tables->item(0)->getElementsByTagName('tr'); // берем данные внутри тэга <tr>

        $capture = []; // пустой массив куда будем забивать данные
        foreach ($rows as $row) { // пройдемся циклом по таблице
            $cols = $row->getElementsByTagName('td'); // выберем все данные внутри тэга <td>
            $captureStruct = [
                'Server Time' => trim($cols[1]->nodeValue ?? null,"[]"), // удаляем лишнее
                'Server' => (int)trim($cols[2]->nodeValue ?? null,"[]"),
                'Fraction' => (int)trim($cols[3]->nodeValue ?? null,"[]"),
                'Player' => trim($cols[4]->nodeValue ?? null,"[]"),
                'Property' => (int)trim($cols[5]->nodeValue ?? null,"[]"),
                'Owner' => (int)trim($cols[6]->nodeValue ?? null,"[]"),
            ];
            $capture[] = $captureStruct; // заполняем массив
        }
        unset($capture[0]); // удалим массив с ключом 0 ибо он всегда null в нашем случае
        return $capture; // вернем значение
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getLogs():array {
        if ($this->type == "capture_search") {
            return $this->getCaptureLog();
        }
    }
}
