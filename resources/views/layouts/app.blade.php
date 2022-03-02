<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header('Content-Type: text/html');
?>
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="msapplication-TileImage" content="{{ asset('images/icon-fresh.png') }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap">
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('loadingModal/jquery.loadingModal.min.css') }}">
    <link rel="stylesheet" href="{{ asset('hc-offcanvas-nav-5.0.12/dist/hc-offcanvas-nav.css') }}">
    <link rel="icon" href="{{ asset('images/icon-fresh.png') }}" sizes="32x32">
	<link rel="icon" href="{{ asset('images/icon-fresh.png') }}" sizes="192x192">
	<link rel="apple-touch-icon-precomposed" href="{{ asset('images/icon-fresh.png') }}">
    <script src="https://code.jquery.com/jquery-3.1.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="{{ asset('hc-offcanvas-nav-5.0.12/dist/hc-offcanvas-nav.js') }}"></script>
    <script src="{{ asset('loadingModal/jquery.loadingModal.min.js') }}"></script>
    <script src="{{ asset('js/datatable.js') }}"></script>
    <script src="{{ asset('js/questions.js') }}"></script>
    <script src="{{ asset('js/moment2.js') }}"></script>
    <script src="{{ asset('js/utils.js') }}"></script>
</head>
<body>
    <div id="container">
        <header class="header-principal">
            <div class="wrapper cf">
                @auth
                <nav id="main-nav">
                    <ul class="first-nav">
                        <li class="search" data-nav-custom-content>
                            <div class="form-container">
                                <form class="search-form" action="https://www.google.com/search" target="_blank" method="get">
                                    <input type="text" name="q" placeholder="Buscar en Google..." style="width:100%" autocomplete="off">
                                </form>
                            </div>
                        </li>
                    </ul>
                    <ul class="second-nav">
                        <li><a href="{{ route('home') }}">
                            <i class='fa fa-home fa-menu'></i>
                            {{ __('Menú principal') }}
                        </a></li>
                        @if (Auth::user()->is_admin)
                        <li><a href="{{ route('users.index') }}">
                            <i class='fa fa-user-circle fa-menu'></i>
                            {{ __('Usuarios') }}
                        </a></li>
                        @endif
                        <li><a href="{{ route('manifests.index') }}">
                            <i class='fa fa-ship fa-menu'></i>
                            {{ __('Manifiestos') }}
                        </a></li>
                        <li><a href="{{ route('manifests.report') }}">
                            <i class='fa fa-bar-chart fa-menu'></i>
                            {{ __('Reportes') }}
                        </a></li>
                        @if (Auth::user()->is_admin)
                        <li><a href="{{ route('parameters.index') }}">
                            <i class='fa fa-gear fa-menu'></i>
                            {{ __('Ajustes') }}
                        </a></li>
                        @endif
                        <li><a href="{{ route('profile') }}">
                            <i class='fa fa-address-card fa-menu'></i>
                            {{ __('Mis datos') }}
                        </a></li>
                        <li><a href="{{ route('password') }}">
                            <i class='fa fa-lock fa-menu'></i>
                            {{ __('Seguridad') }}
                        </a></li>
                        @if (Route::has('login'))
                        <li>
                            @auth
                                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    <i class='fa fa-sign-out fa-menu'></i>
                                    {{ __('Cerrar sesión') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                                    @csrf
                                </form>
                            @else
                                <a href="{{ route('login') }}">
                                    <i class='fa fa-sign-in fa-menu'></i>
                                    {{ __('Iniciar sesión') }}
                                </a>
                            @endauth
                        </li>
                        @endif
                    </ul>
                </nav>
                @endauth
                <div class="container">
                    <div style="float:left">
                        @auth
                        <a class="toggle" href="#">
                            <span></span>
                        @endauth
                            <div class="columna columna-1">
                                <a href="{{ url('/') }}"><img src="{{ asset('images/logo.png') }}" class="img-header"></a>
                            </div>
                        @auth
                        </a>
                        @endauth
                    </div>
                    @if (Route::has('login'))
                    <div style="float:right">
                        @auth
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();"
                                class="btn-effie-inv" style="text-align:center;margin-top:20px">{{ __('Cerrar sesión') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                                @csrf
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="btn-effie-inv" style="margin-top:20px">{{ __('Iniciar sesión') }}</a>
                        @endauth
                    </div>
                    @endif
                </div>
            </div>
        </header>
        <main class="container">
            @auth
            <div class="fila">
                <div class="columna columna-1">
                    <h5 class="title1">{{ __('Bienvenido, ') }} {{ Auth::user()->name }}</h5>
                </div>
            </div>
            @endauth
            <div class="fila">
                <div class="columna columna-1">
                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>{{ __('¡Atención!') }}</strong>{{ __(' Revisa los campos obligatorios.') }}<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    @if (Session::has('success'))
                    <div class="alert alert-info">
                        <strong>{{ __('¡Excelente!') }}</strong> 
                        {{ Session::get('success') }}
                    </div>
                    @endif
                    @if (Session::has('error'))
                    <div class="alert alert-danger">
                        <strong>{{ __('¡Atención!') }}</strong> 
                        {{ Session::get('error') }}
                    </div>
                    @endif
                </div>
            </div>
            @yield('content')
            <div class="space2"></div>
        </main>
        <div class="pre-footer">
            <div class="container">
                <div class="fila">
                    <div class="columna columna-1">
                        <center><img src="{{ asset('images/logo-fresh-data-blanco.png') }}"></center>	
                    </div>
                </div>
            </div>
        </div>
        <footer>
            <p>{{ __('© 2021 ') }} {{ config('app.name', 'Laravel') }} {{ __(' todos los derechos reservados | Desarrollado por ') }}<a href="http://preciso.pe/">{{ __('Preciso - Agencia de contenidos') }}</a></p>
        </footer>
        <script src="{{ asset('js/nav-bar.js') }}"></script>
        @yield('script')
    </div>
</body>
</html>
