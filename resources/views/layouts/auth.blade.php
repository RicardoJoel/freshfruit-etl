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
    <title>{{ config('app.name', 'Laravel') }} {{ __(' - Inicio de sesión') }}</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap">
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
	<link rel="icon" href="{{ asset('images/icon-fresh.png') }}" sizes="32x32">
	<link rel="icon" href="{{ asset('images/icon-fresh.png') }}" sizes="192x192">
	<link rel="apple-touch-icon-precomposed" href="{{ asset('images/icon-fresh.png') }}">
</head>
<body>
	<div class="body-login">
		<div class="login">
			<div class="box-login">
				<center>
				<a href="{{ url('/') }}"><img src="{{ asset('images/logo.png') }}" class="logo"></a>
				</center>
				<p>{{ __('Esto es una intranet. Para acceder a nuestro portal de noticias, presiona ') }}<a href="https://freshfruit.pe/">{{ __('aquí') }}</a>.</p>
                <main>
                    @if(Session::has('error'))
                        <div class="span-alert">
                            {{ Session::get('error') }}
                        </div>
                    @endif
                    @if(session('status'))
                        <div class="span-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @yield('content')
                </main>
            </div>
        </div>
		<div class="fondo-login">
			<img src="{{ asset('images/campo.jpg') }}" class="img-responsive">
		</div>
    </div>
    <footer>
        <p>{{ __('© 2021 ') }} {{ config('app.name', 'Laravel') }} {{ __(' todos los derechos reservados | Desarrollado por ') }}<a href="http://preciso.pe/">{{ __('Preciso - Agencia de contenidos') }}</a></p>
    </footer>
</body>
</html>