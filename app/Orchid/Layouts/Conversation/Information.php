<?php

namespace App\Orchid\Layouts\Conversation;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Label;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Layouts\Rows;

class Information extends Rows
{
    /**
     * Used to create the title of a group of form elements.
     *
     * @var string|null
     */
    protected $title = "Информация";

    /**
     * Get the fields elements to be displayed.
     *
     * @return Field[]
     */
    protected function fields(): array
    {
        return [
            Input::make('conv_info.nickname')
                ->title('Ник игрока'),
            Input::make('conv_info.real_name')
                ->title('Реальное имя'),
            TextArea::make('conv_info.leaderships')
                ->title('Лидерства'),
            Input::make('conv_info.profile.name')
                ->title('Кто начал'),
            Input::make('conv_info.closeInfo.name')
                ->title('Кто закрыл'),
            TextArea::make('conv_info.about')
                ->title('О нём/ней'),
            Label::make('conv_info.created_at')
                ->title('Дата начала'),
            Label::make('conv_info.updated_at')
                ->title('Дата обновления')
        ];
    }
}
