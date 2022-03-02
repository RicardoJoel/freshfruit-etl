@extends('layouts.app')
@section('content')
<div class="fila">
	<div class="columna columna-1">
		<div class="span-fail" id="fail-div"><span id="fail-msg"></span></div>
	</div>
</div>
<div class="fila">
	<div class="columna columna-1">
		<div class="title2">
			<h6>Procesos > Propuestas > Nueva</h6>
		</div>
	</div>
</div>
<form method="POST" action="{{ route('proposals.store') }}" role="form" id="frm-prop">
	@csrf
	<input type="hidden" name="visit_id" id="visit_id" value="{{ old('visit_id') }}">
	<input type="hidden" name="aux_code" id="aux_code" value="{{ old('aux_code') }}">
	<input type="checkbox" id="has_proposal" checked="checked" style="display:none">
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
				<input type="text" name="code" id="prop_code" value="{{ old('code') }}" readonly>
			</div>
			<div class="columna columna-5">
				<p>Fecha de propuesta* :</p>
			</div>
			<div class="columna columna-5">
				<input type="date" name="happen_at" id="happen_at" value="{{ old('happen_at') }}" required>
			</div>
			<div class="columna columna-5">
				<input type="text" value="Pendiente" style="text-align:center" readonly>
			</div>
		</div>
		<div class="fila">
			<div class="columna columna-5">
				<p>Datos del cliente* :</p>
			</div>
			<div class="columna columna-5">
				<input type="hidden" name="customer_id" id="customer_id" value="{{ old('customer_id') }}">
				<div class="search_field">
					<input type="text" name="customer_ruc" id="customer_ruc" value="{{ old('customer_ruc') }}" maxlength="11" placeholder="R. U. C." required>
					<a onclick="clearDataCust()"><i class="fa fa-close fa-icon"></i></a>
				</div>
			</div>
			<div class="columna columna-5d">
				<input type="text" name="customer_name" id="customer_name" value="{{ old('customer_name') }}" placeholder=" -- No hay información para mostrar -- " readonly required>
			</div>
			<div class="columna columna-5">
				<button type="button" id="btn-sch-cust" class="btn-effie-inv" style="width:100%"><i class="fa fa-search"></i>&nbsp;Buscar cliente</button>
			</div>
		</div>
		<div class="fila">
			<div class="columna columna-5">
				<p>Datos del responsable* :</p>
			</div>
			<div class="columna columna-5">
				<input type="hidden" name="user_id" id="user_id" value="{{ old('user_id') }}">
				<div class="search_field">
					<input type="text" name="user_document" id="user_document" value="{{ old('user_document') }}" maxlength="15" placeholder="N° Documento" required>
					<a onclick="clearDataUser()"><i class="fa fa-close fa-icon"></i></a>
				</div>
			</div>
			<div class="columna columna-5d">
				<input type="text" name="user_wholename" id="user_wholename" value="{{ old('user_wholename') }}" placeholder=" -- No hay información para mostrar -- " readonly required>
			</div>
			<div class="columna columna-5">
				<button type="button" id="btn-sch-user" class="btn-effie-inv" style="width:100%"><i class="fa fa-search"></i>&nbsp;Buscar colab.</button>
			</div>
		</div>
		<div class="fila">
			<div class="columna columna-5">
				<p>Datos de la propuesta* :</p>
			</div>
			<div class="columna columna-5">
				@inject('projectTypes','App\Services\ProjectTypes')
				<select name="project_type_id" id="project_type_id" required>
					<option selected disabled hidden value="">Tipo de proyecto*</option>
					@foreach ($projectTypes->get() as $index => $projectType)
					<option value="{{ $index }}" {{ old('project_type_id') == $index ? 'selected' : '' }}>
						{{ $projectType }}
					</option>
					@endforeach
				</select>	
			</div>
			<div class="columna columna-5d">
				<input type="text" name="name" id="name" value="{{ old('name') }}" maxlength="200" onkeypress="return checkText(event)" placeholder=" -- Nombre de la propuesta* -- " required>
			</div>
			<div class="columna columna-5">
				<input type="text" value="Versión 1" style="text-align:center" readonly>
			</div>
		</div>
		<div class="fila" id="div_not_visit" style="display:none">
			<div class="columna columna-1">
				<p id="msg_not_visit" class="lbl-msg"></p>
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
				<p>Moneda de pago*</p>
				@inject('currencies','App\Services\Currencies')
				<select name="pay_curr_id" id="pay_curr_id" required>
					<option selected disabled hidden value="">Selecciona</option>
					@foreach ($currencies->get() as $index => $currency)
					<option value="{{ $index }}" {{ old('pay_curr_id') == $index ? 'selected' : '' }}>
						{{ $currency }}
					</option>
					@endforeach
				</select>
			</div>
			<div class="columna columna-5">
				<p>Modalidad de pago*</p>
				@inject('modes','App\Services\Modes')
				<select name="pay_mode_id" id="pay_mode_id" required>
					<option selected disabled hidden value="">Selecciona</option>
					@foreach ($modes->get() as $index => $mode)
					<option value="{{ $index }}" {{ old('pay_mode_id') == $index ? 'selected' : '' }}>
						{{ $mode }}
					</option>
					@endforeach
				</select>
			</div>
			<div class="columna columna-5">
				<p>Tipo de pago*</p>
				@inject('types','App\Services\Types')
				<select name="pay_type_id" id="pay_type_id" required>
					<option selected disabled hidden value="">Selecciona</option>
					@foreach ($types->get() as $index => $type)
					<option value="{{ $index }}" {{ old('pay_type_id') == $index ? 'selected' : '' }}>
						{{ $type }}
					</option>
					@endforeach
				</select>
			</div>
			<div class="columna columna-5">
				<p>Plazo de pago* (sem)</p>
				<input type="number" name="term_weeks" id="term_weeks" value="{{ old('term_weeks',0) }}" min="0" step="1">
			</div>
			<div class="columna columna-5">
				<p>N° Orden de servicio</p>
				<input type="text" name="serv_order" id="serv_order" value="{{ old('serv_order') }}" maxlength="50">
			</div>
		</div>
		<div class="fila">
			<div class="columna columna-5">
				<p>Total horas</p>
				<input type="text" name="totalHours" id="totalHours" value="{{ old('totalHours',0) }}" readonly>
			</div>
			<div class="columna columna-5">
				<p>Costo total (PEN)</p>
				<input type="text" name="totalCost" id="totalCost" value="{{ old('totalCost','0.00') }}" readonly>
			</div>
			<div class="columna columna-5">
				<p>Ajuste (%)</p>
				<input type="text" name="perc_fit" id="perc_fit" value="{{ old('perc_fit','0.00') }}" readonly>
			</div>
			<div class="columna columna-5">
				<p>Total comisión (%)</p>
				<input type="text" name="totalCommission" id="totalCommission" value="{{ old('totalCommission','0.00') }}" readonly>
			</div>
			<div class="columna columna-5">
				<p>Total proyecto (PEN)</p>
				<input type="text" name="totalFinal" id="totalFinal" value="{{ old('totalFinal','0.00') }}" readonly>
			</div>
		</div>
	</div>
</form>
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
				@include('proposals/resources/employees')
				@include('proposals/resources/independents')
				@include('proposals/resources/providers')
				@include('proposals/resources/sellers')
			</div>
		</div>
	</div>
</div>
<div class="fila">
	<div class="space"></div>
	<div class="columna columna-1">
		<center>
		<button type="submit" class="btn-effie" onclick="document.getElementById('frm-prop').submit();"><i class="fa fa-save"></i>&nbsp;Registrar</button>
		<a href="{{ route('proposals.index') }}" class="btn-effie-inv">Cancelar</a>	
		</center>
	</div>
</div>
<div class="fila">
	<div class="space"></div>
	<div class="columna columna-1">
		<p>
			<i class="fa fa-info-circle fa-icon" aria-hidden="true"></i>&nbsp;	
			<b>Importante</b>
			<ul>
				<li>(*) Campos obligatorios.</li>
				<li>Para buscar un cliente debes ingresar el R.U.C. y luego presionar el botón "Buscar cliente"</li>
				<li>Para buscar un responsable debes ingresar el N° Documento y luego presionar el botón "Buscar colab."</li>
			</ul>
		</p>
	</div>
</div>
@endsection

@include('searches/customers')
@include('searches/employees')
@include('searches/visits')

@section('script')
<script src="{{ asset('js/gencode.js') }}"></script>
<script src="{{ asset('js/questions.js') }}"></script>
<script src="{{ asset('js/searches/visits3.js') }}"></script>
<script src="{{ asset('js/searches/partners2.js') }}"></script>
<script src="{{ asset('js/searches/employees2.js') }}"></script>
<script src="{{ asset('js/resources/employees3.js') }}"></script>
<script src="{{ asset('js/resources/independents3.js') }}"></script>
<script src="{{ asset('js/resources/providers3.js') }}"></script>
<script src="{{ asset('js/resources/sellers2.js') }}"></script>
@endsection