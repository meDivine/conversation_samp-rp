<?php

namespace App\Http\Livewire\Admin\Conv;

use App\Models\conversation;
use Livewire\Component;

class Tableconv extends Component
{

    public function render()
    {
        $all = conversation::all();
        return view('livewire.admin.conv.tableconv', compact('all'));
    }
}
