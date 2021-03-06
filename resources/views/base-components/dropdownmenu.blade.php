<div class="dropdown">
    <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
        <div class="user-menu d-flex">
            <div class="user-name text-end me-3">
                <h6 class="mb-0 text-gray-600">{{ Auth::user()->nickname }}</h6>
                <p class="mb-0 text-sm text-gray-600">Администратор</p>
            </div>
            <div class="user-img d-flex align-items-center">
                <div class="avatar avatar-md">
                    <img src="{{ Auth::user()->avatar }}">
                </div>
            </div>
        </div>
    </a>
    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
        <li>
            <h6 class="dropdown-header">Hello, John!</h6>
        </li>
        <li><a class="dropdown-item" href="#"><i class="icon-mid bi bi-person me-2"></i> My
                Profile</a></li>
        <li><a class="dropdown-item" href="#"><i class="icon-mid bi bi-gear me-2"></i>
                Settings</a></li>
        <li><a class="dropdown-item" href="#"><i class="icon-mid bi bi-wallet me-2"></i>
                Wallet</a></li>
        <li>
            <hr class="dropdown-divider">
        </li>
        <li><a class="dropdown-item" href="#"><i
                    class="icon-mid bi bi-box-arrow-left me-2"></i> Logout</a></li>
    </ul>
</div>
