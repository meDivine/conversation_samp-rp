<?php

namespace App\Orchid\Layouts\Time;

use App\Models\Week;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layout;
use Orchid\Screen\Layouts\Rows;

class Form extends Rows
{
    /**
     * Used to create the title of a group of form elements.
     *
     * @var string|null
     */
    protected $title = "Добавить файл";

    /**
     * Get the fields elements to be displayed.
     *
     * @return Field[]
     */
    protected function fields(): iterable
    {
        return [
            Select::make('time')
                ->fromQuery(Week::query()->orderBy('week_start'), 'week_name', 'id')
            ->title('Выбрать неделю'),

            Input::make('file')
                ->type('file'),
            Button::make('Отправить')
                ->method('addFile'),
            Button::make('Удалить данные')
                ->method('clear')
        ];
    }
}
