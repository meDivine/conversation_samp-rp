<?php

namespace App\Jobs\Logs;

use App\Models\conv_stats;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ReportLog implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $conv_id;
    public $nick;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($conv_id, $nick)
    {
        $this->conv_id = $conv_id;
        $this->nick = $nick;
    }

    /**
     * Execute the job.
     *
     * @return void
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function handle()
    {
        $convLogs = new conv_stats();
        $convLogs->updateAdminLogStats($this->conv_id, $this->nick);
    }
}
