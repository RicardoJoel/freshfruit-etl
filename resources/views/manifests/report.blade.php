@extends('layouts.app')
@section('content')
<div class="fila">
	<div class="columna columna-1">
		<div class="title2">
			<h6>Reporte de manifiestos</h6>
		</div>
	</div>
</div>
<div class="fila">
    <div class="columna columna-1">
        <h6 id="gen_subt" class="title3">Filtros de búsqueda</h6>
    </div>
</div>
<form method="GET" action="{{ route('manifests.download') }}">
    <div class="fila">
        <div class="columna columna-4">
            <label>Rango de fecha</label>
        </div>
        <div class="columna columna-4">
            <input type="date" name="start_at" value="{{ old('start_at',Carbon\Carbon::parse($start_at)->toDateString()) }}" max="{{ Carbon\Carbon::today()->toDateString() }}" required>
        </div>
        <div class="columna columna-10">
            <label>al</label>
        </div>
        <div class="columna columna-4">
            <input type="date" name="end_at" value="{{ old('end_at',Carbon\Carbon::parse($end_at)->toDateString()) }}" max="{{ Carbon\Carbon::today()->toDateString() }}" required>
        </div>
    </div>
    <div class="fila">
        <div class="space"></div>
        <div class="columna columna-1">
            <center>
            <button type="submit" class="btn-effie" id="btn-download"><i class="fa fa-download"></i>&nbsp;Descargar</button>            
            <a href="{{ route('home') }}" class="btn-effie-inv"><i class="fa fa-home"></i>&nbsp;Ir al inicio</a>
            </center>
        </div>
    </div>
</form>
@endsection