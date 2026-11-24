<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ mix('css/styles.css') }}">
    <title>Редактировать замок — Замки Эстонии</title>
</head>
<body>
    <main class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <a class="btn btn-outline-primary" href="{{ route('castles.show', $castle) }}">← К замку</a>
            <x-profile-menu />
        </div>
        <div class="form-panel">
            <h1 class="h2 mb-4">Изменить замок</h1>
            <form action="{{ route('castles.update', $castle) }}" method="post" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="mb-3">
                    <label class="form-label" for="name">Название</label>
                    <input class="form-control" id="name" type="text" name="name" value="{{ old('name', $castle->name) }}" required>
                    @error('name') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="description">Краткое описание</label>
                    <textarea class="form-control" id="description" name="description" rows="2" required>{{ old('description', $castle->description) }}</textarea>
                    @error('description') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="type">Тип</label>
                    <input class="form-control" id="type" type="text" name="type" value="{{ old('type', $castle->type) }}" required>
                    @error('type') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="full_description">Полное описание</label>
                    <textarea class="form-control" id="full_description" name="full_description" rows="5" required>{{ old('full_description', $castle->full_description) }}</textarea>
                    @error('full_description') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                </div>
                <div class="mb-4">
                    <label class="form-label" for="image">Изображение</label>
                    <img class="d-block img-thumbnail mb-2" src="{{ asset('storage/' . $castle->image) }}" alt="{{ $castle->name }}" style="max-width: 300px;">
                    <input class="form-control" id="image" type="file" name="image" accept="image/*">
                    <div class="form-text">Чтобы оставить текущую картинку, не выбирайте новый файл.</div>
                    @error('image') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                </div>
                <button class="btn btn-primary" type="submit">Сохранить</button>
            </form>
        </div>
    </main>
</body>
</html>
