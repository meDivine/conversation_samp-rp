<?php

namespace App\Http\Livewire\Logs;

use Livewire\Component;

class Form extends Component
{
    protected $listeners = ['updateTable'];

    public function updateTable() {

    }
    public function render()
    {
        return view('livewire.logs.form');
    }
}
