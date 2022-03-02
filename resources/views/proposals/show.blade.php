@extends('layouts.app')
@section('content')
<div class="fila">
	<div class="columna columna-1">
		<div class="title2">
			<h6>Procesos > Propuestas > Revisar</h6>
		</div>
	</div>
</div>
<div class="fila">
	<div class="columna columna-1">
		<a onclick="showForm('gen')">
			<h6 id="gen_subt" class="title3">Datos generales</h6>
			<p id="icn-gen" class="icn-sct"><i class="fa fa-minus fa-icon"></i></p>
		</a>
	</div>
</div>
<div id="div-gen">
	<div class="fila">
		<div class="columna columna-5">
			<p>Código único :</p>
		</div>
		<div class="columna columna-5">
			<input type="text" value="{{ $proposal->code }}" readonly>
		</div>
		<div class="columna columna-5">
			<p>Fecha de propuesta :</p>
		</div>
		<div class="columna columna-5">
			<input type="text" value="{{ Carbon\Carbon::parse($proposal->happen_at)->format('d/m/Y') }}" readonly>
		</div>
		<div class="columna columna-5">
			<input type="text" value="{{ $proposal->status === 'P' ? 'Pendiente' : ($proposal->status === 'A' ? 'Aprobado' : 'Rechazado') }}" style="text-align:center" readonly>
		</div>
	</div>
	<div class="fila">
		<div class="columna columna-5">
			<p>Datos del cliente :</p>
		</div>
		<div class="columna columna-5">
			<input type="text" value="{{ $proposal->customer->ruc ?? '' }}" readonly>
		</div>
		<div class="columna columna-5d">
			<input type="text" value="{{ ($proposal->customer->name ?? '').' ('.($proposal->customer->code ?? '').')' }}" readonly>
		</div>
		<div class="columna columna-5">
			<button type="button" class="btn-effie-inv" style="width:100%" disabled><i class="fa fa-search"></i>&nbsp;{{ __('Buscar cliente') }}</button>
		</div>
	</div>
	<div class="fila">
		<div class="columna columna-5">
			<p>Datos del responsable :</p>
		</div>
		<div class="columna columna-5">
			<input type="text" value="{{ $proposal->accountable->document ?? '' }}" readonly>
		</div>
		<div class="columna columna-5d">
			<input type="text" value="{{ ($proposal->accountable->name ?? '').' '.($proposal->accountable->lastname ?? '').' ('.($proposal->accountable->code ?? '').')' }}" readonly>
		</div>
		<div class="columna columna-5">
			<button type="button" class="btn-effie-inv" style="width:100%" disabled><i class="fa fa-search"></i>&nbsp;{{ __('Buscar colab.') }}</button>
		</div>
	</div>
	<div class="fila">
		<div class="columna columna-5">
			<p>Datos de la propuesta :</p>
		</div>
		<div class="columna columna-5">
			<input type="text" value="{{ ($proposal->projectType->name ?? '').' ('.($proposal->projectType->code ?? '').')' }}" readonly>
		</div>
		<div class="columna columna-5d">
			<input type="text" value="{{ $proposal->name }}" readonly>
		</div>
		<div class="columna columna-5">
			<input type="text" value="{{ 'Versión '.$proposal->version }}" style="text-align:center" readonly>
		</div>
	</div>
	<div class="fila">
		<div class="columna columna-1">
			<label class="lbl-msg"><b>{{ $proposal->visit_id ? '' : 'Nota: Propuesta sin visita previa'}}</b><label>
		</div>
	</div>
</div>
<div class="fila">
	<div class="space"></div>
	<div class="columna columna-1">
		<a onclick="showForm('cmp')">
			<h6 id="cmp_subt" class="title3">Datos complementarios</h6>
			<p id="icn-cmp" class="icn-sct"><i class="fa fa-minus fa-icon"></i></p>
		</a>
	</div>
</div>
<div id="div-cmp">
	<div class="fila">
		<div class="columna columna-5">
			<p>Moneda de pago</p>
			<input type="text" value="{{ ($proposal->currency->name ?? '').' ('.($proposal->currency->code ?? '').')' }}" readonly>
		</div>
		<div class="columna columna-5">
			<p>Modalidad de pago</p>
			<input type="text" value="{{ $proposal->mode->name ?? '' }}" readonly>
		</div>
		<div class="columna columna-5">
			<p>Tipo de pago</p>
			<input type="text" value="{{ $proposal->type->name ?? '' }}" readonly>
		</div>
		<div class="columna columna-5">
			<p>Plazo de pago (sem)</p>
			<input type="text" value="{{ $proposal->term_weeks }}" readonly>
		</div>
		<div class="columna columna-5">
			<p>N° Orden de servicio</p>
			<input type="text" value="{{ $proposal->serv_order }}" readonly>
		</div>
	</div>
	<div class="fila">
		<div class="columna columna-5">
			<p>Total horas</p>
			<input type="text" value="{{ $proposal->totalHours }}" readonly>
		</div>
		<div class="columna columna-5">
			<p>Costo total (PEN)</p>
			<input type="text" value="{{ number_format($proposal->totalCost,2) }}" readonly>
		</div>
		<div class="columna columna-5">
			<p>Ajuste (%)</p>
			<input type="text" value="{{ number_format($proposal->perc_fit,2) }}" readonly>
		</div>
		<div class="columna columna-5">
			<p>Total comisión (%)</p>
			<input type="text" value="{{ number_format($proposal->totalCommission,2) }}" readonly>
		</div>
		<div class="columna columna-5">
			<p>Total proyecto (PEN)</p>
			<input type="text" value="{{ number_format($proposal->totalFinal,2) }}" readonly>
		</div>
	</div>
</div>
<div class="fila">
	<div class="space"></div>
	<div class="columna columna-1">
		<div class="tab-step">
			<!-- Tab links -->
			<div class="tab">
				<button type="button" class="tablinks active" onclick="openTab(event,'tabemp')">Colaboradores</button>
				<button type="button" class="tablinks" onclick="openTab(event,'tabfre')">Independientes</button>
				<button type="button" class="tablinks" onclick="openTab(event,'tabpro')">Proveedores</button>
				<button type="button" class="tablinks" onclick="openTab(event,'tabsel')">Vendedores</button>
			</div>
			<!-- Tab content -->
			<div class="mycontent">
				@include('proposals/readonly/employees')
				@include('proposals/readonly/independents')
				@include('proposals/readonly/providers')
				@include('proposals/readonly/sellers')
			</div>
		</div>
	</div>
</div>
<div class="fila">
	<div class="space"></div>
	<div class="columna columna-1">
		<center>
		<a href="{{ route('proposals.index') }}" class="btn-effie-inv"><i class="fa fa-reply"></i>&nbsp;Regresar</a>	
		</center>
	</div>
</div>
@endsection

@section('script')
<script src="{{ asset('js/questions.js') }}"></script>
<script src="{{ asset('js/resources/employees3.js') }}"></script>
<script src="{{ asset('js/resources/independents3.js') }}"></script>
<script src="{{ asset('js/resources/providers3.js') }}"></script>
<script src="{{ asset('js/resources/sellers2.js') }}"></script>
@endsection