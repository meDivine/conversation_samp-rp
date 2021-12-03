<div class="sidebar-menu">
    <ul class="menu">
        <li class="sidebar-title">Zero Two</li>

        <li class="sidebar-item  ">
            <a href="{{ route('home') }}" class='sidebar-link'>
                <i class="bi bi-house-fill"></i>
                <span>Главная</span>
            </a>
        </li>
        <li class="sidebar-item  ">
            <a href="{{ route('add') }}" class='sidebar-link'>
                <i class="bi bi-bar-chart-line-fill"></i>
                <span>Выдвижение</span>
            </a>
        </li>
        <li class="sidebar-item  ">
            <a href="none" class='sidebar-link'>
                <i class="bi bi-eye-fill"></i>
                <span>[WIP] Досье</span>
            </a>
        </li>

        <li class="sidebar-item">
            <a href="{{ route('logs') }}" class='sidebar-link'>
                <i class="bi bi-archive-fill"></i>
                <span>Логи</span>
            </a>
        </li>

        <li class="sidebar-title">Остальное</li>


        <li class="sidebar-item  has-sub">
            <a href="#" class='sidebar-link'>
                <i class="bi bi-person-badge-fill"></i>
                <span>[WIP] Файлы</span>
            </a>
            <ul class="submenu ">
                <li class="submenu-item ">
                    <a href="auth-login.html">Программное обеспечение</a>
                </li>
                <li class="submenu-item ">
                    <a href="auth-register.html">Плагины/скрипты</a>
                </li>
                <li class="submenu-item ">
                    <a href="auth-forgot-password.html">Полезные темки</a>
                </li>
            </ul>
        </li>
        <li class="sidebar-item  ">
            <a href="{{ route('settings') }}" class='sidebar-link'>
                <i class="bi bi-gear-fill"></i>
                <span>Настройки</span>
            </a>
        </li>
    </ul>
</div>
