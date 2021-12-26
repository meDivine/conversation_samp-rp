<?php

namespace Tests\Unit;

use App\Models\server_logs;
use PHPUnit\Framework\TestCase;

class AddServerLogTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $serverLog = new server_logs();
        return $serverLog->addLog("Закрыл голосование");
    }
}
