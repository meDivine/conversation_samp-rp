<?php

namespace App\Classes\Admin;

use App\Classes\LogsTableManipulate;

class Parse
{
    public $input;

    public function __construct($input)
    {
        $this->input = $input;
    }

    private function tableToDom($getLogResponse)
    {
        $logsTable = new LogsTableManipulate($getLogResponse);
        return $logsTable->tableAdmTime();
    }

    public function parseFile(): array
    {
        $file = $this->tableToDom($this->input);
        $atime = [];
        foreach ($file as $item) {
            $cols = $item->getElementsByTagName('td');
            $nicknameColumns = [
                'nickname' => trim($cols[0]->nodeValue ?? null, "[]"),
                'level' => trim($cols[2]->nodeValue ?? null, "[]"),
                'time' => trim($cols[4]->nodeValue ?? null, "[]"),
            ];
            $atime[] = $nicknameColumns;
        }
        unset($atime[0]);
        return $atime;
    }
}
