<?php

namespace App\Http\Livewire\Settings;

use App\Models\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Notify extends Component
{
    use LivewireAlert;

    public bool $notifyStateWar;
    public bool $notifyStateConvers;

    public function updated() {
        $user = new User();
        $user->updateNotifyState($this->notifyStateWar, $this->notifyStateConvers);
        $this->alert('success', 'Успешно', [
            'position' => 'bottom-end',
            'timer' => 3000,
            'toast' => true,
            'showConfirmButton' => true,
            'onConfirmed' => '',
            'confirmButtonText' => 'Закрыть',
            'text' => 'Состояние уведомлений обновлено',
        ]);
    }

    public function mount() {
        $frac = new User();
        $notifyState = $frac->getNotifyState();
        $this->notifyStateConvers = $notifyState->notify_conversation;
        $this->notifyStateWar = $notifyState->capture_info;
    }

    public function render()
    {
        return view('livewire.settings.notify',[
            'notifyStateWar' => $this->notifyStateWar,
            'notifyStateConvers' => $this->notifyStateConvers,
        ]);
    }
}
