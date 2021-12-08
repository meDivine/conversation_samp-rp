<?php

namespace App\Http\Livewire\Logs;

use App\Classes\Logs;
use Carbon\Carbon;
use Livewire\Component;

class Form extends Component
{
    public $type;
    public $nickname = "asd";
    public $nickname2 = "asd";
    public $dateStart;
    public $dateEnd;
    public array $result;
    protected $listeners = [
        'updateTable'
    ];

    public function updateTable($log) {
        $this->type = $log;
    }

    public function updating() {
        if ($this->type == "capture_search") {
            $this->dateStart = "disable";
        }
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getInfo() {
        $dateStart = Carbon::parse($this->dateStart);
        $dateEnd = Carbon::parse($this->dateEnd);
        $logs = new Logs($this->type, $this->nickname, $this->nickname2,
            $dateStart->format('d.m.Y'), $dateEnd->format('d.m.Y'));
        $result = $logs->getLogs();
        $this->emit('getLogs', $result);

    }

    public function render()
    {
        return view('livewire.logs.form');
    }
}
