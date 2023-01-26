<?php

namespace App\Classes\Api;

use App\Classes\Logs;
use GuzzleHttp\Exception\GuzzleException;

class Captures
{

    public $type;
    public $dateStart;
    public $dateEnd;

    public function __construct($dateStart, $dateEnd)
    {
        $this->type = 'capture_search';
        $this->dateStart = $dateStart;
        $this->dateEnd = $dateEnd;
    }

    /**
     * @throws GuzzleException
     */
    public function getLogs() {
        $logs = new Logs($this->type,null, null, $this->dateStart,$this->dateEnd);
        $logs->getLogs();
    }
}
