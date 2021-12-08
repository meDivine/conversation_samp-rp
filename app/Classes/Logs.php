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

    private function renameFractionByID($id):string {
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
    private function getCaptureLog(): array {
        /*
         * Создадим экземпляр класса и выполним запрос
         * Нам вернётся html документ
         */
        $logsTableResponse = new LogsTableResponse("capture", null, null, $this->dateStart, $this->dateEnd,
            null, null , "time_diapzon_1", "time_diapzon_2");
        /*
         * Обработаем документ и вернем готовые данные
         */
        $table = $logsTableResponse->responseToLogsSampRp();
        $rows = $this->tableToDom($table);
        $capture = []; // пустой массив куда будем забивать данные
        foreach ($rows as $row) { // пройдемся циклом по таблице
            $cols = $row->getElementsByTagName('td'); // выберем все данные внутри тэга <td>
            $captureStruct = [
                'Server Time' => trim($cols[1]->nodeValue ?? null,"[]"), // удаляем лишнее
                'Server' => (int)trim($cols[2]->nodeValue ?? null,"[]"),
                'Fraction' => $this->renameFractionByID((int)trim($cols[3]->nodeValue ?? 1,"[]")), // поменяем название фракции c ида на имя
                'Player' => trim($cols[4]->nodeValue ?? null,"[]"),
                'Property' => (int)trim($cols[5]->nodeValue ?? null,"[]"),
                'Owner' => $this->renameFractionByID((int)trim($cols[6]->nodeValue ?? 1,"[]")),
            ];
            $capture[] = $captureStruct; // заполняем массив
        }
        unset($capture[0]); // удалим массив с ключом 0 ибо он всегда null в нашем случае
        return $capture; // вернем значение
    }

    /*
     * Берем лог имён
     */


    /**
     * @throws GuzzleException
     */
    public function getLogs():array {
        if ($this->type == "capture_search") {
            return $this->getCaptureLog();
        }
    }
}