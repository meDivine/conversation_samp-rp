<?php

namespace Tests\Unit;

use App\Models\Bot;
use App\Models\User;
use Tests\TestCase;

class SupportLogTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $user = User::find(1);

        $response = $this->actingAs($user)
            ->withSession(['blocked' => false])
            ->get('/');

        $response->assertStatus(200);
    }

    public function testGetSupportLogs() {
        $bot = new Bot();
        $bot->getSupportReportLog("Richard_Watterson");
    }
}
