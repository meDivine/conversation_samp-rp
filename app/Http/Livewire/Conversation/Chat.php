<?php

namespace App\Http\Livewire\Conversation;

use App\Models\conv_discussion;
use Livewire\Component;

class Chat extends Component
{
    public $mess;
    public $conv_id;
    public $readyToLoad = false;
    
    protected $rules =[
        'mess'      => 'string|max:1024',
        'conv_id'   => 'integer|max:1024',
    ];

    protected $messages = [
        'mess.string'       =>  'Сообщение не является строкой',
        'mess.max'          =>  'Сообщение длиннее 1024 символов',
        'conv_id.integer'   =>  'Ид голосования не является цифрой'
    ];

    public function send() {
        $this->validate();
        $chat = new conv_discussion();
        $chat->addMessage($this->mess, $this->conv_id);
    }

    public function renderChatMessages() {
        $this->readyToLoad = true;
    }
    public function render()
    {
        $chat = new conv_discussion();
        return view('livewire.conversation.chat', [
            'chatMess' => $this->readyToLoad ? $chat->getMessages($this->conv_id) : []
        ]);
    }
}
