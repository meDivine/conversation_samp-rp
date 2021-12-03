<?php

namespace App\Http\Livewire\Logs;

use Livewire\Component;

class Select extends Component
{
    public $log;
    public function render()
    {
        return view('livewire.logs.select');
    }
}
