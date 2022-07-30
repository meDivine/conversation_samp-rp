<?php

namespace App\Http\Livewire\Time;

use App\Models\AdminTime;
use App\Models\Week;
use Livewire\Component;

class Table extends Component
{

    public $table;

    protected $listeners = ['week_get'];

    public function week_get($week) {
        $this->table = Week::query()->find($week);
    }

    public function render()
    {
        return view('livewire.time.table', ['unionTable' => $this->table]);
    }
}
