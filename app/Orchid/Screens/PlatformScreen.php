<?php

declare(strict_types=1);

namespace App\Orchid\Screens;

use App\Orchid\Layouts\Home\HomeLayout;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Request;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class PlatformScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Get Started';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'Welcome to your Orchid application.';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            Link::make('Website')
                ->href('http://orchid.software')
                ->icon('globe-alt'),

            Link::make('Documentation')
                ->href('https://orchid.software/en/docs')
                ->icon('docs'),

            Link::make('GitHub')
                ->href('https://github.com/orchidsoftware/platform')
                ->icon('social-github'),
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]
     */
    public function layout(): array
    {
        return [
            HomeLayout::class
        ];
    }

    /**
     * Ничего лучше не придумал)
     * @return void
     */
    public function setConvStatus() {
        if(Redis::get('convStat') == 0) {
            Redis::set('convStat', 1);
            Toast::info('Статус голосования на "Разрешено"');
        }
        else
        {
            Redis::set('convStat', 0);
            Toast::info('Статус голосования на "Запрещено"');
        }

    }
}
