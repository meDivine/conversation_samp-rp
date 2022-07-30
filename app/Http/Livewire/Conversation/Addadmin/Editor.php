<?php

namespace App\Http\Livewire\Conversation\Addadmin;

use App\Jobs\ConversationSend;
use App\Jobs\Logs\getpunish;
use App\Jobs\Logs\Getregdate;
use App\Jobs\Logs\ReportLog;
use App\Jobs\Logs\SupportLog;
use App\Models\conv_stats;
use App\Models\conversation;
use Illuminate\Foundation\Bus\PendingDispatch;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Editor extends Component
{
    use LivewireAlert;

    public $gamenick;
    public $social;
    public $realname;
    public $about;
    public $leaderships;
    public $type = 0;
    public $forum;

    protected $rules = [
        'gamenick'      => 'required|min:3|max:24|string',
        'social'        => 'required|min:3|max:64|url',
        'realname'      => 'required|min:3|max:64|string',
        'about'         => 'required|min:3|max:1000|string',
        'leaderships'   => 'required|min:2|max:1000|string',
        'forum'         => 'required|url'
    ];

    protected $messages = [
        /*
         * gamenick
         */
        'gamenick.required'     => 'Игровой ник не может быть пустым',
        'gamenick.min'          => 'Игровой ник не может быть короче 3 символов',
        'gamenick.max'          => 'Игровой ник не может быть длиннее 24 символов',
        'gamenick.string'       => 'Игровой ник должен быть строкой',
        /*
         * social
         */
        'social.required'       => 'Соц. Сеть должна быть заполнена',
        'social.min'            => 'Соц. Сеть должна быть не менее 3 символов',
        'social.max'            => 'Соц. Сеть не должна быть длинее 64 символов',
        'social.url'            => 'Соц. Сеть должна быть указана ссылкой - https://site.ru',
        /*
         * realname
         */
        'realname.required'     => 'Реальное имя должно быть заполнено',
        'realname.min'          => 'Реальное имя должно быть длиннее 3 символов',
        'realname.max'          => 'Реальное имя должно быть короче 64 символов',
        'realname.string'       => 'Реальное имя должно быть строкой',
        /*
         * about
         */
        'about.required'        => 'Данные о кандидате должны быть заполнены',
        'about.min'             => 'Данные о кандидате должны быть длиннее 3 символов',
        'about.max'             => 'Данные о кандидате должны быть короче 1000 символов',
        'about.string'          => 'Данные о кандидате должны быть строкой',
        /*
         * leaderships
         */
        'leaderships.required'  => 'Лидерства не могут быть пустыми',
        'leaderships.min'       => 'Лидерства не могут быть менее 2 символов',
        'leaderships.max'       => 'Данные о лидерствах не могут быть длинее 1000 символов',
        'leaderships.string'    => 'Данные о лидерствах должны быть строкой',
        /*
         * Форумник
         */
        'forum.required'        => 'Ссылка на форумник не может быть пустой',
        'forum.url'             => 'Форумник должен быть ссылкой'
    ];

    /*
     * Пока синхронно
     */
    public function addConversation(): PendingDispatch
    {
        $this->validate();
        $uid = Auth::id();
        $conversation = new conversation();
        $conversationStats = new conv_stats();
        $convers = $conversation->createConversation($this->type, $this->social, $this->gamenick, $this->about, $this->realname, $this->leaderships, $uid, $this->forum);
        $conversId = $convers['id'];
        $conversationStats->createConvLog($convers['id'], $convers['nickname']);
        $this->alert('warning', 'Голосование', [
            'position' => 'bottom-end',
            'timer' => 5000,
            'toast' => true,
            'showConfirmButton' => true,
            'onConfirmed' => '',
            'confirmButtonText' => 'Закрыть',
            'text' => 'Голосование начато, доступ к нему появится после проверок, обычно 1-2 минуты',
        ]);
        ReportLog::dispatch($conversId, $this->gamenick);
        Getregdate::dispatch($conversId, $this->gamenick);
        SupportLog::dispatch($conversId, $this->gamenick);
        ConversationSend::dispatch($conversId, $this->gamenick);
        return getpunish::dispatch($conversId, $this->gamenick);
    }



    public function render()
    {
        return view('livewire.conversation.addadmin.editor');
    }
}
