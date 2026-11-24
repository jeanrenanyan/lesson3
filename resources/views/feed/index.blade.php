<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ mix('css/styles.css') }}">
    <title>Лента друзей — Замки Эстонии</title>
</head>
<body>
    <main class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h2 mb-0">Лента друзей</h1>
            <div class="d-flex align-items-center gap-2">
                <a class="btn btn-outline-primary" href="{{ route('castles.index') }}">К замкам</a>
                <x-profile-menu />
            </div>
        </div>

        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        <div class="row g-4">
            <aside class="col-12 col-lg-4 col-xl-3">
                <div class="friends-sidebar">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h2 class="h5 mb-0">Друзья</h2>
                        <a href="{{ route('users.index') }}">Найти</a>
                    </div>
                    <div class="list-group">
                        @forelse ($friends as $friend)
                            <div class="list-group-item d-flex justify-content-between align-items-center gap-2">
                                <a href="{{ route('users.castles', $friend->username) }}">
                                    {{ $friend->name }}
                                    <span class="small text-muted">({{ $friend->username }})</span>
                                </a>
                                <form method="POST" action="{{ route('friends.destroy', $friend->username) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" type="submit" aria-label="Удалить {{ $friend->name }} из друзей">×</button>
                                </form>
                            </div>
                        @empty
                            <div class="list-group-item text-muted">Пока нет друзей.</div>
                        @endforelse
                    </div>
                </div>
            </aside>

            <section class="col-12 col-lg-8 col-xl-9">
                <h2 class="mt-2 ms-2">Последние публикации и комментарии</h2>
                <div class="d-flex flex-column gap-3">
                    @forelse ($feed as $item)
                        @if ($item['type'] === 'castle')
                            @php($castle = $item['castle'])
                            <article class="feed-item">
                                <div class="d-flex justify-content-between flex-wrap gap-2">
                                    <strong>{{ $castle->user->name }} добавил(а) замок</strong>
                                    <time class="text-muted small">{{ $item['created_at']->format('d.m.Y H:i') }}</time>
                                </div>
                                <h3 class="h5 mt-2">
                                    <a href="{{ route('castles.show', $castle) }}">{{ $castle->name }}</a>
                                </h3>
                                <p class="mb-0">{{ $castle->description }}</p>
                            </article>
                        @else
                            @php($comment = $item['comment'])
                            <article class="feed-item">
                                <div class="d-flex justify-content-between flex-wrap gap-2">
                                    <strong>{{ $comment->user->name }} прокомментировал(а) замок</strong>
                                    <time class="text-muted small">{{ $item['created_at']->format('d.m.Y H:i') }}</time>
                                </div>
                                <p class="mt-2 mb-1">{{ $comment->text }}</p>
                                <a href="{{ route('castles.show', $comment->castle) }}">{{ $comment->castle->name }}</a>
                            </article>
                        @endif
                    @empty
                        <div class="feed-item text-muted">
                            В ленте пока пусто. Добавьте друзей или дождитесь их публикаций и комментариев.
                        </div>
                    @endforelse
                </div>
            </section>
        </div>
    </main>
</body>
</html>
