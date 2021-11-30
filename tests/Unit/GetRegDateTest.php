<?php

namespace Tests\Unit;

use App\Models\Bot;
use App\Models\server_logs;
use PHPUnit\Framework\TestCase;

class GetRegDateTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $log = new server_logs();
        $log->getipInfo("90.150.52.129");
    }
}
