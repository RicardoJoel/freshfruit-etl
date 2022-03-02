@extends('layouts.app')
@section('content')
<div class="fila">
    <div class="columna columna-1">
        <div class="title2">
            <h6>{{ __('Procesos > Proyectos') }}</h6>
        </div>
    </div>
</div>
<div class="fila">
    <div class="columna columna-1">
        <div class="tab">
            <button type="button" class="tablinks active" onclick="openTab(event,'open')">Abiertos</button>
            <button type="button" class="tablinks" onclick="openTab(event,'clos')">Cerrados</button>
            <button type="button" class="tablinks" onclick="openTab(event,'canc')">Anulados</button>
        </div>
        <!-- Tab content -->
        <div>
            @include('projects/tabs/open')
            @include('projects/tabs/clos')
            @include('projects/tabs/canc')
        </div>
    </div>
</div>
<div class="fila">
    <div class="space2"></div>
    <div class="columna columna-1">
        <center>
        <a href="{{ route('projects.create') }}" class="btn-effie"><i class="fa fa-plus"></i>&nbsp;Nuevo</a>
        <a href="{{ route('home') }}" class="btn-effie-inv"><i class="fa fa-home"></i>&nbsp;Ir al inicio</a>
        </center>
    </div>
</div>
@endsection