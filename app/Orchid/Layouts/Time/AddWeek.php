<?php

namespace App\Orchid\Layouts\Time;

use Orchid\Screen\Actions\Button;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;

class AddWeek extends Rows
{
    /**
     * Used to create the title of a group of form elements.
     *
     * @var string|null
     */
    protected $title = "Создать неделю";

    /**
     * Get the fields elements to be displayed.
     *
     * @return Field[]
     */
    protected function fields(): iterable
    {
        return [
            DateTimer::make('start')
                ->title('Начало')
                ->format('Y-m-d'),
            DateTimer::make('end')
                ->title('Конец')
                ->format('Y-m-d'),
            Input::make('norma')
                ->title('Норма')
                ->type('number'),
            Button::make('Добавить')
                ->method('addWeek'),
        ];
    }
}
