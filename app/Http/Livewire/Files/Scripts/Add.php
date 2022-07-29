<?php

namespace App\Http\Livewire\Files\Scripts;

use App\Models\script;
use Illuminate\Support\Facades\Request;
use Livewire\Component;

class Add extends Component
{
    public $description;

    public function insert() {
        $this->validate([
            'description' => 'required'
        ]);
        dd($this->description);
    }
    public function render()
    {
        return view('livewire.files.scripts.add');
    }
}
