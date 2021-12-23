<?php

namespace App\Orchid\Screens\Conversation;

use App\Models\conversation;
use App\Orchid\Layouts\Conversation\TableConversation;
use App\Orchid\Layouts\Conversation\TableConversationClosed;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class General extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Выдвижения';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'open_conv' => conversation::whereNull('who_close')->paginate(10),
            'closed_conv' => conversation::whereNotNull('who_close')->paginate(10),
        ];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [

        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [
            Layout::tabs([
                'Открытые' => TableConversation::class,
                'Закрытые' => TableConversationClosed::class,
            ])
        ];
    }
}
