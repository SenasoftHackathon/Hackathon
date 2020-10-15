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
<body style="background:#2E4670">
    <div class="container" style="background-image: url('img/imagenPrincipal.jpg');">
        <div class="row justify-content-center align-items-center vh-100">
            <div class="col-6" style="background:#2E4670;border-radius: 20px;">
            <h1 class="text-center"><strong>Bienvenido</br>a</br> Facturación Manager</strong></h1>
                <div class="row" >
                    <div class="col-6">
                        <a class="btn btn-info float-right" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </div>
                    <div class="col-6">
                        <a class="btn btn-info float-left" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
