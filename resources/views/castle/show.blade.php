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
                <div class="card-text">
                    {{ $castle->full_description }}
                </div>

                <div class="d-flex flex-wrap gap-2 mt-4">
                    <a href="/castles/{{ $castle->id }}/edit">
                        <button type="button" class="btn btn-secondary" disabled>Изменить</button>
                    </a>
                    <form action="/castles/{{ $castle->id }}" method="post" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Удалить</button>
                    </form>
                </div>
            </div>
        </article>
    </main>
</body>

</html>