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
        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="{{ url('/castles') }}" class="btn btn-outline-primary">← К списку замков</a>
            <x-profile-menu />
        </div>

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

        <section class="mt-4">
            <h2 class="h3 mb-3">Комментарии</h2>
            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            @auth
                <form class="comment-form mb-4" method="POST" action="{{ route('comments.store', $castle) }}">
                    @csrf
                    <label class="form-label" for="comment-text">Оставить комментарий</label>
                    <textarea class="form-control" id="comment-text" name="text" rows="3" maxlength="2000" required>{{ old('text') }}</textarea>
                    @error('text') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    <button class="btn btn-primary mt-2" type="submit">Отправить</button>
                </form>
            @else
                <p><a href="{{ route('login') }}">Войдите</a>, чтобы оставить комментарий.</p>
            @endauth

            <div class="d-flex flex-column gap-3">
                @forelse ($comments as $comment)
                    <article class="comment-card {{ in_array($comment->user_id, $friendIds) ? 'comment-card--friend' : '' }}">
                        <div class="d-flex justify-content-between align-items-start gap-2">
                            <strong>{{ $comment->user->name }}</strong>
                            <time class="text-muted small" datetime="{{ $comment->created_at->toIso8601String() }}">
                                {{ $comment->created_at->format('d.m.Y H:i') }}
                            </time>
                        </div>
                        @if (in_array($comment->user_id, $friendIds))
                            <span class="badge text-bg-primary mt-1">Друг</span>
                        @endif
                        <p class="mb-0 mt-2">{{ $comment->text }}</p>
                    </article>
                @empty
                    <p class="text-muted">Комментариев пока нет.</p>
                @endforelse
            </div>
        </section>
    </main>
</body>

</html>