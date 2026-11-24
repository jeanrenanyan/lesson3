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
            <a class="btn btn-outline-primary" href="{{ route('castles.index') }}">К замкам</a>
        </div>
        <div class="list-group">
            @forelse ($users as $user)
                <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                   href="{{ route('users.castles', $user->username) }}">
                    <span>{{ $user->name }} <span class="text-muted">({{ $user->username }})</span></span>
                    <span class="btn btn-sm btn-outline-primary">Замки пользователя</span>
                </a>
            @empty
                <div class="list-group-item text-muted">Пользователи не найдены.</div>
            @endforelse
        </div>
    </main>
</body>
</html>
