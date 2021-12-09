<?php

namespace App\Classes;

use DOMDocument;

class LogsTableManipulate
{
    public $table;

    public function __construct($table)
    {
        $this->table = $table;
    }

    public function tableToDom()
    {
        $dom = new domDocument();
        $dom->loadHTML($this->table);
        $dom->preserveWhiteSpace = false;
        $tables = $dom->getElementsByTagName('table');
        return $tables->item(0)->getElementsByTagName('tr');
    }
}
