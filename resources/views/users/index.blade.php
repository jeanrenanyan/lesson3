<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ mix('css/styles.css') }}">
    <title>Пользователи — Замки Эстонии</title>
</head>
<body>
    <main class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h2 mb-0">Пользователи</h1>
            <div class="d-flex gap-2">
                <a class="btn btn-outline-primary" href="{{ route('castles.index') }}">К замкам</a>
                <x-profile-menu />
            </div>
        </div>
        <div class="list-group">
            @forelse ($users as $user)
                <div class="list-group-item d-flex flex-wrap justify-content-between align-items-center gap-2">
                    <a href="{{ route('users.castles', $user->username) }}">
                        {{ $user->name }} <span class="text-muted">({{ $user->username }})</span>
                    </a>
                    <div class="d-flex flex-wrap gap-2">
                        <a class="btn btn-sm btn-outline-primary" href="{{ route('users.castles', $user->username) }}">Замки пользователя</a>
                        @auth
                            @if ((int) auth()->id() !== (int) $user->id)
                                @if (in_array($user->id, $friendIds))
                                    <form method="POST" action="{{ route('friends.destroy', $user->username) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger" type="submit">Удалить из друзей</button>
                                    </form>
                                @else
                                    <form method="POST" action="{{ route('friends.store', $user->username) }}">
                                        @csrf
                                        <button class="btn btn-sm btn-success" type="submit">Добавить в друзья</button>
                                    </form>
                                @endif
                            @endif
                        @endauth
                    </div>
                </div>
            @empty
                <div class="list-group-item text-muted">Пользователи не найдены.</div>
            @endforelse
        </div>
    </main>
</body>
</html>
