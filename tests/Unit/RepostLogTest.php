<?php

namespace Tests\Unit;

use App\Jobs\Logs\ReportLog;
use App\Models\Bot;
use App\Models\conv_stats;
use PHPUnit\Framework\TestCase;

class RepostLogTest extends TestCase
{

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function test_reportlog(){
       $convLogs = new Bot();
       dd($convLogs->getAdminReportLog("Richard_Watterson"));
   }
}
