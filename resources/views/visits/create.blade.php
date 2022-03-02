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
			<h6>{{ __('Procesos > Visitas > Nueva') }}</h6>
		</div>
	</div>
</div>
<form method="POST" action="{{ route('visits.store') }}" role="form" id="frm-visit">
	@csrf
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
				<p>{{ __('Código único :') }}</p>
			</div>
			<div class="columna columna-5">
				<input type="text" readonly>
			</div>
			<div class="columna columna-5e">
				<p>{{ __('Fecha y hora visita* :') }}</p>
			</div>
			<div class="columna columna-5b">
				<input type="datetime-local" name="happen_at" id="happen_at" value="{{ old('happen_at') }}" required>
			</div>
			<div class="columna columna-5">
				@inject('projectTypes','App\Services\ProjectTypes')
				<select name="project_type_id" id="project_type_id" required>
					<option selected readonly hidden value="">{{ __('Tipo de proyecto*') }}</option>
					@foreach ($projectTypes->get() as $index => $projectType)
					<option value="{{ $index }}" {{ old('project_type_id') == $index ? 'selected' : '' }}>
						{{ $projectType }}
					</option>
					@endforeach
				</select>	
			</div>
		</div>
		<div class="fila">
			<div class="columna columna-5">
				<p>{{ __('Datos del cliente* :') }}</p>
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
				<button type="button" id="btn-sch-cust" class="btn-effie-inv" style="width:100%"><i class="fa fa-search"></i>&nbsp;{{ __('Buscar cliente') }}</button>
			</div>
		</div>
		<div class="fila">
			<div class="columna columna-5">
				<p>{{ __('Datos del responsable* :') }}</p>
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
				<button type="button" id="btn-sch-user" class="btn-effie-inv" style="width:100%"><i class="fa fa-search"></i>&nbsp;{{ __('Buscar colab.') }}</button>
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
				<label><input type="checkbox" name="is_done" id="is_done" value="1" {{ old('is_done') ? 'checked="checked"' : '' }}>&nbsp;{{ __('Visita concretada') }}</label>
			</div>
			<div class="columna columna-5">
				<label><input type="checkbox" name="by_reference" id="by_reference" value="1" {{ old('by_reference') ? 'checked="checked"' : '' }}>&nbsp;{{ __('Por referencia') }}</label>
			</div>
			<div class="columna columna-5">
				<label><input type="checkbox" name="has_proposal" id="has_proposal" value="1" {{ old('has_proposal') ? 'checked="checked"' : '' }}>&nbsp;{{ __('Agregar propuesta') }}</label>
			</div>
			<div class="columna columna-5">
				<p style="text-align:right">{{ __('Código de propuesta :') }}</p>
			</div>
			<div class="columna columna-5">
				<input type="text" name="prop_code" id="prop_code" value="{{ old('prop_code') }}" readonly>
			</div>
		</div>
		<div class="fila">
			<div class="columna columna-1">
				<p>{{ __('Observaciones (máx. 500 caracteres)') }}</p>
				<textarea name="observation" id="observation" maxlength="500" rows="4">{{ old('observation') }}</textarea>
			</div>
		</div>
		<div class="fila">
			<div class="space"></div>
			<div class="columna columna-1">
				<center>
				<button type="submit" class="btn-effie"><i class="fa fa-save"></i>&nbsp;{{ __('Registrar') }}</button>
				<a href="{{ route('visits.index') }}" class="btn-effie-inv"><i class="fa fa-reply"></i>&nbsp;Regresar</a>	
				</center>
			</div>
		</div>
	</div>
</form>
<div class="fila">
	<div class="space"></div>
	<div class="columna columna-1">
		<p>
			<i class="fa fa-info-circle fa-icon" aria-hidden="true"></i>&nbsp;	
			<b>{{ __('Importante') }}</b>
			<ul>
				<li>{{ __('(*) Campos obligatorios.') }}</li>
				<li>{{ __('Para buscar un cliente debes ingresar el R.U.C. y luego presionar el botón "Buscar cliente"') }}</li>
				<li>{{ __('Para buscar un responsable debes ingresar el N° Documento y luego presionar el botón "Buscar colab."') }}</li>
			</ul>
		</p>
	</div>
</div>
@endsection

@include('searches/customers')
@include('searches/employees')

@section('script')
<script src="{{ asset('js/gencode.js') }}"></script>
<script src="{{ asset('js/searches/customers2.js') }}"></script>
<script src="{{ asset('js/searches/employees2.js') }}"></script>
@endsection