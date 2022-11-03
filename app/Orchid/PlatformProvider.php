<?php

declare(strict_types=1);

namespace App\Orchid;

use Orchid\Platform\Dashboard;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\OrchidServiceProvider;
use Orchid\Screen\Actions\Menu;
use Orchid\Support\Color;

class PlatformProvider extends OrchidServiceProvider
{
    /**
     * @param Dashboard $dashboard
     */
    public function boot(Dashboard $dashboard): void
    {
        parent::boot($dashboard);

        // ...
    }

    /**
     * @return Menu[]
     */
    public function registerMainMenu(): array
    {
        return [
            /*Menu::make('Example screen')
                ->icon('monitor')
                ->route('platform.example')
                ->title('Navigation')
                ->badge(function () {
                    return 6;
                }),

            Menu::make('Dropdown menu')
                ->icon('code')
                ->list([
                    Menu::make('Sub element item 1')->icon('bag'),
                    Menu::make('Sub element item 2')->icon('heart'),
                ]),

            Menu::make('Basic Elements')
                ->title('Form controls')
                ->icon('note')
                ->route('platform.example.fields'),

            Menu::make('Advanced Elements')
                ->icon('briefcase')
                ->route('platform.example.advanced'),

            Menu::make('Text Editors')
                ->icon('list')
                ->route('platform.example.editors'),

            Menu::make('Overview layouts')
                ->title('Layouts')
                ->icon('layers')
                ->route('platform.example.layouts'),

            Menu::make('Chart tools')
                ->icon('bar-chart')
                ->route('platform.example.charts'),

            Menu::make('Cards')
                ->icon('grid')
                ->route('platform.example.cards')
                ->divider(),

            Menu::make('Documentation')
                ->title('Docs')
                ->icon('docs')
                ->url('https://orchid.software/en/docs'),

            Menu::make('Changelog')
                ->icon('shuffle')
                ->url('https://github.com/orchidsoftware/platform/blob/master/CHANGELOG.md')
                ->target('_blank')
                ->badge(function () {
                    return Dashboard::version();
                }, Color::DARK()),*/

            Menu::make("Выдвижения")
                ->icon('user-follow')
                ->route('platform.conversation.general')
                ->permission('watch_convers')
                ->title("Действия"),

            Menu::make("Игровое время")
                ->icon('user-follow')
                ->route('platform.time')
                ->permission('game_time'),

            Menu::make(__('Users'))
                ->icon('user')
                ->route('platform.systems.users')
                ->permission('make_perm')
                ->title(__('Access rights')),

            Menu::make('Администраторы')
                ->icon('user')
                ->route('platform.user.verified')
                ->permission('make_perm'),

            Menu::make(__('Roles'))
                ->icon('lock')
                ->route('platform.systems.roles')
                ->permission('make_group'),
        ];
    }

    /**
     * @return Menu[]
     */
    public function registerProfileMenu(): array
    {
        return [
            Menu::make('Profile')
                ->route('platform.profile')
                ->icon('user'),
        ];
    }

    /**
     * @return ItemPermission[]
     */
    public function registerPermissions(): array
    {
        return [
            /*ItemPermission::group(__('System'))
                ->addPermission('platform.systems.roles', __('Roles'))
                ->addPermission('platform.systems.users', __('Users')),*/
            //админка
            ItemPermission::group('Администрирование')
                ->addPermission('make_perm', 'Управление правами')
                ->addPermission('make_group', 'Управление группами'),
            //модерка
            ItemPermission::group('Модерирование')
                ->addPermission('watch_convers', 'Просмотр голосований')
                ->addPermission('close_convers', 'Закрывать голосования')
                ->addPermission('watch_user_logs', 'Логи')
                ->addPermission('game_time', 'Игровое время'),
            //пользователь
            ItemPermission::group('Пользователь')
                ->addPermission('can_conv', 'Может голосовать')
                ->addPermission('can_start_conv', 'Может выдвигать'),
            //права на логи
            ItemPermission::group('Права на логи')
                ->addPermission('ip_auth_search', 'IP Авторизации')
                ->addPermission('auth_search', 'Авторизация')
                ->addPermission('ban_ip_search', 'Бан IP')
                ->addPermission('black_jack_search', 'Блек Джек')
                ->addPermission('capture_search', 'Войны')
                ->addPermission('houses_search', 'Дома')
                ->addPermission('moneys_search', 'Деньги')
                ->addPermission('donate_search', 'Донат')
                ->addPermission('durak_search', 'Дурак')
                ->addPermission('names_search', 'Имена')
                ->addPermission('inventory_search', 'Инвентарь')
                ->addPermission('email_search', 'Почты')
                ->addPermission('bones_search', 'Кости') // хз как игра кости на англ будет
                ->addPermission('anticheat_search', 'Кики античита')
                ->addPermission('missions_search', 'Миссии')
                ->addPermission('punishments_search', 'Наказания')
                ->addPermission('poker_search', 'Покер')
                ->addPermission('promo_search', 'Промокоды')
                ->addPermission('report_search', 'Репорт')
                ->addPermission('warehouses_search', 'Склад фракции')
                ->addPermission('supports_search', 'Вопросы сап.')
                ->addPermission('community_search', 'Сообщества')
                ->addPermission('tradestore_search', 'Торговая площадка')
                ->addPermission('fraction_search', 'Фракции'),
        ];
    }
}
