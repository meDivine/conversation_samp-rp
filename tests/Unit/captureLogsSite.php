<?php

namespace Tests\Unit;

use App\Classes\Logs;
use PHPUnit\Framework\TestCase;

class captureLogsSite extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $logs = new Logs("capture_search","asd", "asd", "09.11.2021", "10.11.2021");
        $logs->getLogs();
    }
}
