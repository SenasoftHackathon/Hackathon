<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Pagina Inicial</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center align-items-center vh-100">
            <div class="row">
            <h1>Bienvenido a Hackathon</h1> 
            </div>

            <div>
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </div>
            <div>
                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            </div>
        </div>
        
    </div>
</body>
</html>
