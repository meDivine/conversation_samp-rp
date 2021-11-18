<div class="sidebar-menu">
    <ul class="menu">
        <li class="sidebar-title">Zero Two</li>

        <li class="sidebar-item  ">
            <a href="{{ route('home') }}" class='sidebar-link'>
                <i class="bi bi-grid-fill"></i>
                <span>Главная</span>
            </a>
        </li>

        <li class="sidebar-item has-sub">
            <a href="#" class='sidebar-link'>
                <i class="bi bi-grid-1x2-fill"></i>
                <span>Добавить</span>
            </a>
            <ul class="submenu ">
                <li class="submenu-item ">
                    <a href="{{ route('addadmin') }}">Администратора</a>
                </li>
                <li class="submenu-item ">
                    <a href="auth-register.html">Игрового помошника</a>
                </li>
                <li class="submenu-item ">
                    <a href="auth-forgot-password.html">Голосование</a>
                </li>
            </ul>
        </li>

        <li class="sidebar-title">Остальное</li>


        <li class="sidebar-item  has-sub">
            <a href="#" class='sidebar-link'>
                <i class="bi bi-person-badge-fill"></i>
                <span>Файлы</span>
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

    </ul>
</div>
