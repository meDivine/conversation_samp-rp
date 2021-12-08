<?php

namespace App\Http\Livewire\Logs;

use Livewire\Component;

class Table extends Component
{
    public $table;
    public $arrKeys;
    protected $listeners = [
        'getLogs'
    ];

    public function getLogs($result) {
        $this->table = $result;
        $this->arrKeys = array_keys($result[1] ?? []);
    }

    public function render()
    {
        $unfo = $this->table;
        $keys = $this->arrKeys;
        return view('livewire.logs.table', compact('unfo', 'keys'));
    }
}
