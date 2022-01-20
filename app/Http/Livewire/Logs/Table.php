<?php

namespace App\Http\Livewire\Logs;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Table extends Component
{
    use LivewireAlert;

    public $table;
    public $arrKeys;
    protected $listeners = [
        'getLogs'
    ];

    public function getLogs($result) {
        $this->table = $result;
        $this->arrKeys = array_keys($result[1] ?? $this->info());
    }

    private function info() {
        $this->alert('info', 'Логи не найдены', [
            'position' => 'bottom-end',
            'timer' => 3000,
            'toast' => true,
            'text' => 'Ничего не найдено',
        ]);
        return [];
    }

    public function render()
    {
        $unfo = $this->table;
        $keys = $this->arrKeys;
        return view('livewire.logs.table', compact('unfo', 'keys'));
    }
}
