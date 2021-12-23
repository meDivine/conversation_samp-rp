<?php

namespace App\Orchid\Layouts\Conversation;

use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class TableConversationClosed extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'closed_conv';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('nickname', 'Ник'),
            TD::make('conversation.profile.name', 'Кто начал') // получим через связь ник того кто начал
            ->render(function ($name) {
                $nickName = $name->profile->nickname;
                $userName = $name->profile->name;
                return "$userName ($nickName)";
            }),
            TD::make('who_close', 'Кто закрыл'),

            TD::make('agree', 'За')
                ->render(function ($agree) {
                    return $agree->convVote->sum('agree');
                }),
            TD::make('agree', 'Против')
                ->render(function ($disagree) {
                    return $disagree->convVote->sum('disagree');
                }),
            TD::make('agree', 'Нейтрально')
                ->render(function ($neutral) {
                    return $neutral->convVote->sum('neutral');
                }),
            TD::make('created_at', 'Дата Начала')
                ->render(function ($date) {
                    return $date->created_at->format("d/m/y h:i:s");
                }),
            TD::make('created_at', 'Дата обновления')
                ->render(function ($date) {
                    return $date->updated_at->format("d/m/y h:i:s");
                }),
        ];
    }
}
