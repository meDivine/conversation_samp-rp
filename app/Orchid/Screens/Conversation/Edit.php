<?php

namespace App\Orchid\Screens\Conversation;

use App\Models\conv_voting;
use App\Models\conversation;
use App\Models\server_logs;
use App\Orchid\Layouts\Conversation\ConvLog;
use App\Orchid\Layouts\Conversation\Information;
use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;


class Edit extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Редактировать';
    /*
     * Display desc
     * @var string
     */
    public $description = 'Вставить текст';

    /**
     * @var conversation
     */
    private $conv;

    /**
     * Query data.
     * @param conversation $conv
     * @return array
     */

    public function query(conversation $conv): array
    {
        $this->conv = $conv;
        return [
            'conv_info' => conversation::find($this->conv->id),
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
            is_null($this->conv->who_close) != null ?
                Button::make('conv_info.who_close')
                    ->icon('lock')
                    ->method('closeConv')
                    ->name('Закрыть')
                    ->parameters(['id' => $this->conv->id]) :
                Button::make('conv_info.who_close')
                    ->icon('lock-open')
                    ->method('openConv')
                    ->name('Открыть')
                    ->parameters(['id' => $this->conv->id])
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
            Layout::block(Information::class)
                ->title('Выдвигаемый')
                ->description('Информация о выдвигаемом'),
            ConvLog::class,
        ];
    }

    public function openConv($id)
    {
        $serverLog = new server_logs();
        $serverLog->addLog("Открыл голосование $this->conv->id");
        conversation::find($id)
            ->update(['who_close' => NULL]);
        Toast::info('Голосование открыто');
    }

    public function closeConv($id): void
    {
        $serverLog = new server_logs();
        $serverLog->addLog("Закрыл голосование $this->conv->id");
        conversation::find($id)
            ->update(['who_close' => Auth::id()]);
        Toast::info('Голосование закрыто');
    }
}
