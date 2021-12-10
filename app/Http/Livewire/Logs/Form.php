<?php

namespace App\Http\Livewire\Logs;

use App\Classes\Logs;
use Carbon\Carbon;
use Livewire\Component;

class Form extends Component
{
    public $type;
    public $nickname;
    public $nickname2;
    public $dateStart;
    public $dateEnd;
    public array $result;
    protected $listeners = [
        'updateTable'
    ];

    public function updateTable($log)
    {
        $this->type = $log;
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getInfo()
    {
        $dateStart = Carbon::parse($this->dateStart);
        $dateEnd = Carbon::parse($this->dateEnd);
        $logs = new Logs(
            $this->type,
            $this->nickname,
            $this->nickname2,
            $dateStart->format('d.m.Y'),
            $dateEnd->format('d.m.Y')
        );
        $result = $logs->getLogs();
        $this->emit('getLogs', $result);
    }


    /**
     * Сравним тип лога, и уберем лишние даннные с формы
     */

    private function setFirstNickHidden(): bool
    {
        return match ($this->type) {
            "capture_search" => true,
            default => false,
        };
    }

    private function setSecondNickHidden(): bool
    {
        return match ($this->type) {
            "capture_search", "names_search" => true,
            default => false,
        };
    }

    private function setStartDateHidden()
    {
        return match ($this->type) {
            "names_search" => true,
            default => false,
        };
    }

    private function setEndDateHidden()
    {
        switch ($this->type) {
            case "names_search":
                return true;
                break;
            default:
                return false;
                break;
        }
    }
    /**
     * Взять имя колонки может быть ник или ип адрес
     * Поэтому будем динамически менять данные
     *
     * @return string
     */
    private function getFirstName()
    {
        return match ($this->type) {
            "fraction_search" => "Лидер",
            default => "Игровой ник",
        };
    }

    private function getSecondName()
    {
        return match ($this->type) {
            "fraction_search" => "Игрок",
            default => "Игровой ник",
        };
    }

    public function render()
    {
        return view('livewire.logs.form', [
            'stateFirstName' => $this->setFirstNickHidden(),
            'stateSecondName' => $this->setSecondNickHidden(),
            'stateDateState' => $this->setStartDateHidden(),
            'endDateState' => $this->setEndDateHidden(),
            'getFirstNameText' => $this->getFirstName(),
            'getSecondNameText' => $this->getSecondName()
        ]);
    }
}
