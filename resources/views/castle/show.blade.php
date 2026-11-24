<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ mix('css/styles.css') }}">
    <title>{{ $castle->name }} — Замки Эстонии</title>
</head>

<body>
    <main class="container py-4">
        <a href="{{ url('/castles') }}" class="btn btn-outline-primary mb-3">← К списку замков</a>

        <article class="card">
            <img src="{{ asset('storage/' . $castle->image) }}" alt="{{ $castle->name }}" class="card-img-top h-50">

            <div class="card-body">
                <p class="text-muted mb-1">{{ $castle->type ?: 'Замок' }}</p>
                <h1 class="card-title">{{ $castle->name }}</h1>
                <p class="lead">{{ $castle->description }}</p>
                @if ($castle->user)
                    <p class="text-muted">Автор:
                        <a href="{{ route('users.castles', $castle->user->username) }}">{{ $castle->user->username }}</a>
                    </p>
                @endif
                <div class="card-text">
                    {{ $castle->full_description }}
                </div>

                <div class="d-flex flex-wrap gap-2 mt-4">
                    @auth
                        @can('update-castle', $castle)
                            <a class="btn btn-secondary" href="{{ route('castles.edit', $castle) }}">Изменить</a>
                        @endcan
                        @can('delete-castle', $castle)
                            <form action="{{ route('castles.destroy', $castle) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Удалить</button>
                            </form>
                        @endcan
                    @endauth
                </div>
            </div>
        </article>
    </main>
</body>

</html>