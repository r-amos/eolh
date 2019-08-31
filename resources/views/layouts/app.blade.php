<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <title>{{ config('app.title', 'Eolh') }}</title>
    </head>
<body>
    <div id="app">
    <header class="header">
        <a href="/">
            <div class="header__logo">
                @include('svg.logo')
            </div>
        </a>
    </header>
    @auth
        @include('partials.user.nav')
    @endauth
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
