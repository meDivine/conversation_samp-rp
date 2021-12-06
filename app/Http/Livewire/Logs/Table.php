<?php

namespace App\Http\Livewire\Logs;

use Livewire\Component;

class Table extends Component
{
    public $userinfo;

    protected $listeners = [
        'updateTable'
    ];

    public function updateTable($log) {
        $this->userinfo = $log;
    }

    public function render()
    {
        $unfo = $this->userinfo;
        return view('livewire.logs.table', compact('unfo'));
    }
}
