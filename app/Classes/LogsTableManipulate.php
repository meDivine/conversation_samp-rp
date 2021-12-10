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
        $tablePos = $this->table->getBody()->getContents();
        $dom = new domDocument();
        $dom->loadHTML("\xEF\xBB\xBF" . $tablePos, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $dom->preserveWhiteSpace = false;
        $tables = $dom->getElementsByTagName('table');
        return $tables->item(0)->getElementsByTagName('tr');
    }
}
