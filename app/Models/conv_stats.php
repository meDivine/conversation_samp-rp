<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class conv_stats extends Model
{
    use HasFactory;

    protected $fillable = [
        'conv_id',
        'nick',
        'warns',
        'bans',
        'kicks',
        'report_log',
        'support_log'
    ];
    protected $casts = [
        'warns' => 'array',
        'kicks' => 'array',
        'bans' => 'array',
        'reg_info' => 'array',
        'support_log' => 'array'
    ];

    private function getPunishments($conv_id) {
        return self::where('conv_id', $conv_id)->first();
    }
    public function createConvLog($conv_id, $nick) {
        return self::create([
            'conv_id' => $conv_id,
            'nick' => $nick,
            'warns' => json_encode('Пусто', JSON_UNESCAPED_UNICODE),
            'bans' => json_encode('Пусто', JSON_UNESCAPED_UNICODE),
            'kicks' => json_encode('Пусто',JSON_UNESCAPED_UNICODE),
            'report_log' => json_encode('Пусто', JSON_UNESCAPED_UNICODE),
            'support_log' => json_encode('Пусто', JSON_UNESCAPED_UNICODE),
        ]);
    }

    public function updateConvStatsPunish($conv_id, $nick) {
        $bot = new Bot();
        $punish = $bot->getPunishmentsLog($nick);
        return self::where('conv_id', $conv_id)
            ->update([
                'warns' => $punish['Warns'],
                'bans' => $punish['Bans'],
                'kicks' => $punish['Kicks']
            ]);
    }
    public function updateIpStats($conv_id, $nick) {
        $bot = new Bot();
        $userStats = $bot->getRegInfo($nick);
        return self::where('conv_id', $conv_id)
            ->update([
                'reg_info' => $userStats
            ]);
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function updateSupportLogStats($conv_id, $nick) {
        $bot = new Bot();
        $userStats = $bot->getSupportReportLog($nick);
        return self::where('conv_id', $conv_id)
            ->update([
                'support_log' => $userStats
            ]);
    }
}
