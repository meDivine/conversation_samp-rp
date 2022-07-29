<?php

namespace App\Http\Livewire\Time;

use Livewire\Component;

class Card extends Component
{

    public $date;

    public function render()
    {
        return view('livewire.time.card');
    }
}
