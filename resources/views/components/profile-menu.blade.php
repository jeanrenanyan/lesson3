@auth
    <details class="profile-menu">
        <summary class="profile-menu__trigger">
            <svg class="profile-menu__icon" viewBox="0 0 24 24" aria-hidden="true">
                <path d="M12 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm0 2c-4.42 0-8 2.24-8 5v1h16v-1c0-2.76-3.58-5-8-5Z" />
            </svg>
            <span>{{ auth()->user()->name }}</span>
            <svg class="profile-menu__chevron" viewBox="0 0 16 16" aria-hidden="true">
                <path d="m3 6 5 5 5-5" />
            </svg>
        </summary>
        <div class="profile-menu__dropdown">
            <a href="{{ route('feed.index') }}">Лента друзей</a>
            <a href="{{ route('users.index') }}">Пользователи</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">Выйти</button>
            </form>
        </div>
    </details>
@else
    <div class="profile-menu__guest">
        <a class="btn btn-outline-primary" href="{{ route('login') }}">Войти</a>
        <a class="btn btn-primary" href="{{ route('register') }}">Регистрация</a>
    </div>
@endauth
