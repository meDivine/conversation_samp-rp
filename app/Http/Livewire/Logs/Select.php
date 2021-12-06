<?php

namespace App\Http\Livewire\Logs;

use Livewire\Component;

class Select extends Component
{
    public $log;

    public function updated() {
        $this->emit('updateTable', $this->log);
    }
    public function render()
    {

        return view('livewire.logs.select');
    }
}
