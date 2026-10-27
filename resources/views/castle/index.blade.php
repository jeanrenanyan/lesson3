<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{mix('css/styles.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Замки Эстонии</title>
</head>

<body>
    <div class="container">
        <header>
            <nav class="navbar navbar-expand-lg bg-body-tertiary p-0">
                <div class="container-fluid" id="header_container">
                    <div class="logo">
                        <a href="#">
                            <div>Э</div>
                        </a>
                        <p id="site_name">Замки Эстонии</p>
                    </div>
                    <a href="/castles/create">
                        <button class="btn btn-primary" class="button">Загрузить</button>
                    </a>
                </div>
            </nav>
        </header>
        <section class="py-3 py-md-4 py-lg-2">
            <h1 id="sec_header" class="mb-3 mb-md-4 text-center text-lg-start">Список замков Эстонии</h1>
            <div class="container text-left">
                <div class="row gap-3 align-items-stretch d-flex justify-content-center justify-content-lg-start">
                    @forelse ($castles as $castle)
                        <div class="col-12 col-md-10 col-lg-5 col-xl-4 col-xxl-3 col-3xl-2">
                            <div class="card">
                                <img src="{{ asset('storage/' . $castle->image) }}" alt="{{ $castle->name }}"
                                    class="card-img-top img-fluid">
                                <div class="card-body d-flex flex-column">
                                    <h2 class="card-title">{{ $castle->name }}</h2>
                                    <h3 class="card-text">{{ $castle->description }}</h3>
                                    <a href="{{ url('/castles/' . $castle->id) }}"
                                        class="button-more btn btn-primary mt-auto align-self-end">
                                        Подробнее</a>
                                </div>
                                <div id="object-type">{{ $castle->type ?? "Замок" }}</div>
                            </div>
                        </div>
                    @empty
                        <li>Замки не были найдены!</li>
                    @endforelse

                </div>
            </div>
        </section>
        <div data-comment="toasts">
            <div id="toastContainer" class="toast-container position-fixed bottom-0 end-0 p-3 d-flex flex-column">
                <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true"
                    style="display: none;">
                    <div class="toast-header">
                        <!-- <img src="..." class="rounded me-2" alt="..."> -->
                        <i class="fa-solid fa-spinner fa-spin me-2"></i>
                        <strong class="me-auto">Уведомление</strong>
                        <small>Сейчас</small>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body">
                        На текущий момент этот функционал не доступен!
                    </div>
                </div>
            </div>
        </div>
        <hr />
        <footer>
            <h3 id="author">Юлневич Т.К</h3>
            <div class="footer_pics">
                <a href="#">
                    <img class="img-fluid" id="tg-logo"
                        src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQAU2YVcCa-jxTkcIKXWspbn7qUbvaRknVnYo4OXvgnkOhoClsyKn8WrcA&s=10"
                        alt="pic">
                </a>
                <a href="#">
                    <img class="img-fluid" id="x-logo"
                        src="https://thumb.wikimedia.org/wikipedia/commons/thumb/c/cc/X_icon.svg/3840px-X_icon.svg.png?utm_source=commons.wikimedia.org&utm_campaign=index&utm_content=thumbnail"
                        alt="pic">
                </a>
                <a href="#">
                    <img class="img-fluid" id="facebook-logo"
                        src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQMegsZbIEeed5lTd23P0gSB32dk0O3w6dda_mLb740dbLRXT_t_nxqbW0&s=10"
                        alt="pic">
                </a>
            </div>
        </footer>
    </div>
    <script src="{{mix('js/app.js')}}"></script>
</body>

</html>