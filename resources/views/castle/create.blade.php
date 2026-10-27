<button><a href="/castles">На главную</a></button>


<h1>Добавить новый замок</h1>

<form action="/castles" method="post" enctype="multipart/form-data">
    <div>
        <label for="name">Название</label>
        <input type="text" name="name" autocomplete="off" value={{ old("name") }}>
        @error('name')
            <p style="color: red;">{{$message}}</p>
        @enderror
    </div>

    <div>
        <label for="description">Описание</label>
        <input type="text" name="description" autocomplete="off" value={{ old("description") }}>
        @error('description') <p style=" color: red;">{{$message}}</p>
        @enderror
    </div>

    <div>
        <label for="type">Тип</label>
        <input type="text" name="type" autocomplete="off" value={{ old("type") }}>
        @error('type') <p style=" color: red;">{{$message}}</p>
        @enderror
    </div>

    <div>
        <label for="full_description">Полное описание</label>
        <input type="text" name="full_description" autocomplete="off" value={{ old("full_description") }}>
        @error('full_description') <p style=" color: red;">{{$message}}</p>
        @enderror
    </div>

    <div>
        <label for="image">Изображение</label>
        <input type="file" name="image" accept="image/*" autocomplete="off" value={{ old("image") }}>
        @error('image') <p style=" color: red;">{{$message}}</p>
        @enderror
    </div>

    @csrf

    <button>Добавить</button>

</form>