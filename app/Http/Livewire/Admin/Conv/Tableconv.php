<?php

namespace App\Http\Livewire\Admin\Conv;

use App\Models\conversation;
use Livewire\Component;

class Tableconv extends Component
{
    public $table;

    private function getTable() {
        return conversation::all();
    }

    public function render()
    {
        $this->table = $this->getTable();
        return view('livewire.admin.conv.tableconv');
    }
}
