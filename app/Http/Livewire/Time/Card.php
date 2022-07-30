<?php

namespace App\Http\Livewire\Time;

use App\Models\Week;
use Livewire\Component;

class Card extends Component
{

    public $date;

    public function updated()
    {
        $this->emit('week_get', $this->date);
    }

    public function render()
    {
        return view('livewire.time.card', [
            'weeks' => Week::query()->orderBy('week_start')->get()
        ]);
    }
}
