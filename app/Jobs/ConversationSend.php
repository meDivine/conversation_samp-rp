<?php

namespace App\Jobs;

use App\Models\CaptureLog;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ConversationSend implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public string $user;
    public string $link;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($link, $user )
    {
        $this->user = $user;
        $this->link = $link;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $observer = new CaptureLog();
        $user = new User();
        $vkToSend = $user->getEnabledNotifyConversation();
        $message = "Начато голосование\nВыдвигают: $this->user\nПроголосовать\nhttps://zerotwo.monster/c/$this->link";
        foreach ($vkToSend as $key) {
            $observer->sendVkMess($key->vk_id, $message);
        }
    }
}
