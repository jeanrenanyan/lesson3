<button><a href="/castles/{{ $castle->id }}">На страницу замка</a></button>


<h1>Изменить замок</h1>

<form action="{{ url('/castles/' . $castle->id . '/edit') }}" method="post" enctype="multipart/form-data">

    @method('PUT')
    @csrf
    <div>
        <label for="name">Название</label>
        <input type="text" name="name" autocomplete="off" value={{ old("name", $castle->name) }}>
        @error('name')
            <p style="color: red;">{{$message}}</p>
        @enderror
    </div>

    <div>
        <label for="description">Описание</label>
        <input type="text" name="description" autocomplete="off" value={{ old("description", $castle->description) }}>
        @error('description') <p style=" color: red;">{{$message}}</p>
        @enderror
    </div>

    <div>
        <label for="type">Тип</label>
        <input type="text" name="type" autocomplete="off" value={{ old("type", $castle->type) }}>
        @error('type') <p style=" color: red;">{{$message}}</p>
        @enderror
    </div>

    <div>
        <label for="full_description">Полное описание</label>
        <input type="text" name="full_description" autocomplete="off" value={{ old("full_description", $castle->full_description) }}>
        @error('full_description') <p style=" color: red;">{{$message}}</p>
        @enderror
    </div>

    <div>
        <label for="image">Изображение</label>
        <div>
            <img src="{{ asset('storage/' . $castle->image) }}" alt="{{ $castle->name }}" style="max-width: 300px;">
        </div>
        <input type="file" name="image" accept="image/*" autocomplete="off">
        <small>Чтобы оставить текущую картинку, не выбирайте новый файл.</small>
        @error('image') <p style=" color: red;">{{$message}}</p>
        @enderror
    </div>

    <button>Обновить</button>

</form>