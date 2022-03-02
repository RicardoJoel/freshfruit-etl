@extends('layouts.app')
@section('content')
<div class="fila">
    <div class="columna columna-1">
        <div class="title2">
            <h6>{{ __('Procesos > Propuestas') }}</h6>
        </div>
    </div>
</div>
<div class="fila">
    <div class="columna columna-1">
        <div class="tab">
            <button type="button" class="tablinks active" onclick="openTab(event,'pend')">Pendientes</button>
            <button type="button" class="tablinks" onclick="openTab(event,'apro')">Aprobadas</button>
            <button type="button" class="tablinks" onclick="openTab(event,'rech')">Rechazadas</button>
        </div>
        <!-- Tab content -->
        <div>
            @include('proposals/tabs/pend')
            @include('proposals/tabs/apro')
            @include('proposals/tabs/rech')
        </div>
    </div>
</div>
<div class="fila">
    <div class="space2"></div>
    <div class="columna columna-1">
        <center>
        <a href="{{ route('proposals.create') }}" class="btn-effie"><i class="fa fa-plus"></i>&nbsp;Nuevo</a>
        <a href="{{ route('home') }}" class="btn-effie-inv"><i class="fa fa-home"></i>&nbsp;Ir al inicio</a>
        </center>
    </div>
</div>
@endsection