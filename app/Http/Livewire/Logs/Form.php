<?php

namespace App\Http\Livewire\Logs;

use App\Classes\Logs;
use Livewire\Component;

class Form extends Component
{
    public string $type;
    public string $nickname = "asd";
    public string $nickname2 = "asd";
    public string $dateStart = '09.11.2021';
    public string $dateEnd = '10.11.2021';
    public array $result;
    protected $listeners = [
        'updateTable'
    ];

    public function updateTable($log) {
        $this->type = $log;
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getInfo() {
        $logs = new Logs($this->type, $this->nickname, $this->nickname2, $this->dateStart, $this->dateEnd);
        $result = $logs->getLogs();
        $this->emit('getLogs', $result);
    }

    public function render()
    {
        return view('livewire.logs.form');
    }
}
