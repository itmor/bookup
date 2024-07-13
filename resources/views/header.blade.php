@vite('resources/css/app.css')
@vite('resources/js/app.js')

<link href="{{ asset('css/header.css') }}" rel="stylesheet">
<script src="{{asset('js/header.js')}}"></script>

<div class="header">
    <div><a class="header__logo" href="/">Bookup</a></div>
    <div class="header__links">
        <div>
            @guest
                <a class="header__link" href="/login">Логин</a>
                <a class="header__link" href="/register">Регестрация</a>
            @endguest
            @auth
                <a class="header__link" href="/logout">Выход</a>
            @endauth
        </div>
        <div id="burger-menu">
            <span></span>
        </div>
    </div>
</div>

<div class="header__menu">
    <a href="/">Главная</a>
    @auth
        <a href="/add_book">Додати книгу</a>
    @endauth
    <a href="/search">Пошук книги</a>
</div>


