<?php

namespace App\Http\Livewire\Conversation\Addadmin;

use App\Models\conversation;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Editor extends Component
{
    public $gamenick;
    public $social;
    public $realname;
    public $about;
    public $leaderships;

    protected $rules = [
        'gamenick'      => 'required|min:3|max:24|string',
        'social'        => 'required|min:3|max:64|url',
        'realname'      => 'required|min:3|max:64|string',
        'about'         => 'required|min:3|max:1000|string',
        'leaderships'   => 'required|min:2|max:1000|string'
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
        'leaderships.string'    => 'Данные о лидерствах должны быть строкой'
    ];

    /*
     * Пока синхронно
     */
    public function addConversation() {
        $this->validate();
        $uid = Auth::id();
        $conversation = new conversation();
        return $conversation->createConversation(0, $this->social, $this->gamenick, $this->about, $this->realname, $this->leaderships, $uid);
    }
    public function render()
    {
        return view('livewire.conversation.addadmin.editor');
    }
}
