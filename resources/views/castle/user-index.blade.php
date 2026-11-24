<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ mix('css/styles.css') }}">
    <title>Замки пользователя {{ $user->username }} — Замки Эстонии</title>
</head>
<body>
    <main class="container py-4">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
            <div>
                <a href="{{ route('users.index') }}">← Все пользователи</a>
                <h1 class="h2 mt-2 mb-0">Замки пользователя {{ $user->username }}</h1>
            </div>
            <a class="btn btn-outline-primary" href="{{ route('castles.index') }}">Все замки</a>
        </div>
        @if (auth()->check() && auth()->user()->is_admin)
            <p><a href="{{ route('admin.users.castles', $user->username) }}">Показать также удалённые замки</a></p>
        @endif
        <div class="row gap-3 justify-content-center">
            @forelse ($castles as $castle)
                <div class="col-12 col-md-6 col-lg-4">
                    <article class="card h-100">
                        <img src="{{ asset('storage/' . $castle->image) }}" alt="{{ $castle->name }}" class="card-img-top">
                        <div class="card-body d-flex flex-column">
                            <h2 class="h5">{{ $castle->name }}</h2>
                            <p>{{ $castle->description }}</p>
                            <a class="btn btn-primary mt-auto" href="{{ route('castles.show', $castle) }}">Подробнее</a>
                            @auth
                                @can('update-castle', $castle)
                                    <a class="btn btn-outline-secondary mt-2" href="{{ route('castles.edit', $castle) }}">Редактировать</a>
                                @endcan
                                @can('delete-castle', $castle)
                                    <form class="mt-2" method="POST" action="{{ route('castles.destroy', $castle) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-outline-danger w-100" type="submit">Удалить</button>
                                    </form>
                                @endcan
                            @endauth
                        </div>
                    </article>
                </div>
            @empty
                <p class="text-muted">У этого пользователя пока нет замков.</p>
            @endforelse
        </div>
    </main>
</body>
</html>
