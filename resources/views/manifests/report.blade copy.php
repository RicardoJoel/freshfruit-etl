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
        <h6 id="gen_subt" class="title3">Filtros de la búsqueda</h6>
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
            <button type="submit" class="btn-effie"><i class="fa fa-spinner"></i>&nbsp;Generar</button>
            <a href="{{ route('manifests.report') }}" class="btn-effie-inv"><i class="fa fa-paint-brush"></i>&nbsp;Limpiar</a>
            
            </center>
        </div>
    </div>
</form>
<div class="space2"></div>
<div class="fila">
    <div class="columna columna-1">
        <h6 class="title3">{{ $title }}</h6>
        <table id="tbl-report" class="tablealumno">
            <thead>
                <th style="width:10%">Tipo</th>
                <th style="width:15%">Manifiesto</th>
                <th style="width:10%">Fecha de Salida</th>
                <th style="width:30%">Empresa</th>
                <th style="width:5%">Nave</th>
                <th style="width:10%">N° Conoc.</th>
                <th style="width:10%">N° Detal.</th>
                <th style="width:10%">N° Conte.</th>
            </thead>
            <tbody>
                @foreach ($items as $item)
                <tr>
                    <td><center>{{ $item->tipo_man }}</center></td>
                    <td><center>{{ $item->manifiesto }}</center></td>
                    <td><center>{{ $item->fecha_salida }}</center></td>
                    <td>{{ $item->empresa }}</td>
                    <td><center>{{ $item->nave }}</center></td>
                    <td><center>{{ $item->tot_conoc }}</center></td>
                    <td><center>{{ $item->tot_detal }}</center></td>
                    <td><center>{{ $item->tot_conte }}</center></td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <th colspan="5">Total página / Total general :</th>
                <th></th>
                <th></th>
                <th></th>
            </tfoot>
        </table>
    </div>
</div>
<div class="fila">
    <div class="space2"></div>
    <div class="columna columna-1">
        <form method="GET" action="{{ route('manifests.download') }}">
            <input type="hidden" name="start_at" value="{{ $start_at }}">
            <input type="hidden" name="end_at" value="{{ $end_at }}">
            <center>
            <button type="submit" class="btn-effie" id="btn-download"><i class="fa fa-download"></i>&nbsp;Descargar</button>            
            <a href="{{ route('home') }}" class="btn-effie-inv"><i class="fa fa-home"></i>&nbsp;Ir al inicio</a>
            </center>
        </form>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('js/manifests/report.js') }}"></script>
@endsection