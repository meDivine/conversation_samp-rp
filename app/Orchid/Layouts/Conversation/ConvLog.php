<?php

namespace App\Orchid\Layouts\Conversation;

use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class ConvLog extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'conv_info.convVote';

    /**
     * @var string
     */
    protected $title = 'Лог голосований';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('profile.name', 'Имя')
                ->render(function ($id) {
                    return $id->profile->name ?? "DELETED";
                }),

            TD::make('profile.nickname', 'Ник')
                ->render(function ($id) {
                    return $id->profile->nickname ?? "DELETED";
                }),

            TD::make('type', 'Решение')
            ->render(function ($type) {
                if ($type->agree == 1) return "За";
                if ($type->disagree == 1) return "Против";
                if ($type->neutral == 1) return "Нейтрально";
            }),

            TD::make('comment', 'Комментарий'),

            TD::make('created_at', 'Дата создания')
                ->render(function ($date) {
                    return $date->created_at->format("d/m/y h:i:s");
                }),

            TD::make('created_at', 'Дата обновления')
                ->render(function ($date) {
                    return $date->updated_at->format("d/m/y h:i:s");
                }),

            TD::make('id', 'id')
        ];
    }
}
