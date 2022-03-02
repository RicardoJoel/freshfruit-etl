@extends('layouts.app')
@section('content')
<div class="fila">
	<div class="columna columna-1">
		<div class="title2">
			<h6>Carga de manifiestos</h6>
		</div>
	</div>
</div>
<div class="fila">
    <div class="columna columna-1">
        <div class="span-fail" id="div-span"><span id="msj-rqst"></span></div>
    </div>
</div>
<div class="fila">
    <div class="columna columna-1">
        <!-- Tab links -->
        <div class="tab">
            @if (Auth::user()->is_admin)
            <button type="button" class="tablinks active" onclick="openTab(event,'tabmar')">Búsqueda de marítimo</button>
            <button type="button" class="tablinks" onclick="openTab(event,'tabpro')">Búsqueda de provincia</button>
            <button type="button" class="tablinks" onclick="openTab(event,'tabaer')">Búsqueda de aéreo</button>
            @endif
            <button type="button" class="{{ Auth::user()->is_admin ? 'tablinks' : 'tablinks active' }} " onclick="openTab(event,'tabcon')">Generación de consolidado</button>
        </div>
        <!-- Tab content -->
        <div class="mycontent">
            @if (Auth::user()->is_admin)
            @include('manifests/tabs/maritimo')
            @include('manifests/tabs/provincia')
            @include('manifests/tabs/aereo')
            @endif
            @include('manifests/tabs/consolidado')
        </div>
    </div>
</div>
<div class="fila">
    <div class="space2"></div>
    <div class="columna columna-1">
        <center>
        <a href="{{ route('home') }}" class="btn-effie-inv"><i class="fa fa-home"></i>&nbsp;Ir al inicio</a>
        </center>
    </div>
</div>
@endsection

@include('popups/message')
@include('popups/confirm')

@section('script')
@if (Auth::user()->is_admin)
<script src="{{ asset('js/manifests/maritimo5.js') }}"></script>
<script src="{{ asset('js/manifests/provincia6.js') }}"></script>
<script src="{{ asset('js/manifests/aereo5.js') }}"></script>
@endif
<script src="{{ asset('js/manifests/consolidado5.js') }}"></script>
@endsection