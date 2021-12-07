<?php

namespace App\Http\Livewire\Logs;

use Livewire\Component;

class Table extends Component
{
    public $table;

    protected $listeners = [
        'getLogs'
    ];

    public function getLogs($result) {
        $this->table = $result;
    }

    public function render()
    {
        $unfo = $this->table;
        return view('livewire.logs.table', compact('unfo'));
    }
}
