<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ mix('css/styles.css') }}">
    <title>Все замки пользователя {{ $user->username }} — Замки Эстонии</title>
</head>
<body>
    <main class="container py-4">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
            <div>
                <a href="{{ route('users.castles', $user->username) }}">← Активные замки</a>
                <h1 class="h2 mt-2 mb-0">Все замки пользователя {{ $user->username }}</h1>
            </div>
            <div class="d-flex align-items-center gap-2">
                <a class="btn btn-outline-primary" href="{{ route('users.index') }}">Пользователи</a>
                <x-profile-menu />
            </div>
        </div>
        <div class="list-group">
            @forelse ($castles as $castle)
                <div class="list-group-item d-flex flex-wrap justify-content-between align-items-center gap-2">
                    <div>
                        @if ($castle->trashed())
                            <span>{{ $castle->name }}</span>
                        @else
                            <a href="{{ route('castles.show', $castle) }}">{{ $castle->name }}</a>
                        @endif
                        <span class="text-muted">— {{ $castle->trashed() ? 'удалён' : 'активен' }}</span>
                    </div>
                    <div class="d-flex flex-wrap gap-2">
                        @if ($castle->trashed())
                            <form method="POST" action="{{ route('admin.castles.restore', $castle->id) }}">
                                @csrf
                                <button class="btn btn-sm btn-success" type="submit">Восстановить</button>
                            </form>
                            <form method="POST" action="{{ route('admin.castles.force-delete', $castle->id) }}"
                                  onsubmit="return confirm('Удалить замок без возможности восстановления?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" type="submit">Удалить навсегда</button>
                            </form>
                        @else
                            <a class="btn btn-sm btn-outline-secondary" href="{{ route('castles.edit', $castle) }}">Редактировать</a>
                            <form method="POST" action="{{ route('castles.destroy', $castle) }}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" type="submit">Удалить</button>
                            </form>
                        @endif
                    </div>
                </div>
            @empty
                <div class="list-group-item text-muted">У пользователя пока нет замков.</div>
            @endforelse
        </div>
    </main>
</body>
</html>
