<div class="input-group mb-3">
    <label class="input-group-text"
           for="inputGroupSelect01">Тип</label>
    <select wire:model.lazy="log" class="form-select" id="inputGroupSelect01">
        <option selected>Выбери</option>
        @if(Auth::user()->hasAccess("ip_auth_search"))
            <option value="ip_auth_search">[WIP] IP авторизации</option>
        @endif
        @if (Auth::user()->hasAccess("auth_search"))
            <option value="auth_search">[WIP] Авторизация</option>
        @endif
        @if (Auth::user()->hasAccess("ban_ip_search"))
            <option value="ban_ip_search">[WIP] Бан IP</option>
        @endif
        @if (Auth::user()->hasAccess("black_jack_search"))
            <option disabled value="black_jack_search">[WIP] Блек Джек</option>
        @endif
        @if (Auth::user()->hasAccess("capture_search"))
            <option value="capture_search">Войны</option>
        @endif
        @if (Auth::user()->hasAccess("houses_search"))
            <option disabled value="houses_search">[WIP] Дома</option>
        @endif
        @if (Auth::user()->hasAccess("moneys_search"))
            <option value="moneys_search" disabled>[WIP] Деньги</option>
        @endif
        @if (Auth::user()->hasAccess("donate_search"))
            <option value="donate_search" disabled>[WIP] Донат</option>
        @endif
        @if (Auth::user()->hasAccess("durak_search"))
            <option value="durak_search" disabled>[WIP] Дурак</option>
        @endif
        @if (Auth::user()->hasAccess("names_search"))
            <option value="names_search">Имена</option>
        @endif
        @if (Auth::user()->hasAccess("inventory_search"))
            <option value="inventory_search" disabled>[WIP] Инвентарь</option>
        @endif
        @if (Auth::user()->hasAccess("email_search"))
            <option value="email_search">Емейлы</option>
        @endif
        @if (Auth::user()->hasAccess("bones_search"))
            <option value="bones_search" disabled>[WIP] Кости</option>
        @endif
        @if (Auth::user()->hasAccess("anticheat_search"))
            <option value="anticheat_search" disabled>[WIP] Кики античита</option>
        @endif
        @if (Auth::user()->hasAccess("missions_search"))
            <option value="missions_search" disabled>[WIP] Миссии</option>
        @endif
        @if (Auth::user()->hasAccess("punishments_search"))
            <option value="punishments_search">Наказания</option>
        @endif
        @if (Auth::user()->hasAccess("poker_search"))
            <option value="poker_search" disabled>[WIP] Покер</option>
        @endif
        @if (Auth::user()->hasAccess("promo_search"))
            <option value="promo_search" disabled>[WIP] Промокоды</option>
        @endif
        @if (Auth::user()->hasAccess("report_search"))
            <option value="report_search">Репорт</option>
        @endif
        @if (Auth::user()->hasAccess("warehouses_search"))
            <option value="warehouses_search">Склад фракции</option>
        @endif
        @if (Auth::user()->hasAccess("supports_search"))
            <option value="supports_search">Саппорты</option>
        @endif
        @if (Auth::user()->hasAccess("community_search"))
            <option value="community_search" disabled>[WIP] Сообщества</option>
        @endif
        @if (Auth::user()->hasAccess("tradestore_search"))
            <option value="tradestore_search" disabled>[WIP] Торговая площадка</option>
        @endif
        @if (Auth::user()->hasAccess("fraction_search"))
            <option value="fraction_search">Фракция</option>
        @endif
    </select>
</div>
