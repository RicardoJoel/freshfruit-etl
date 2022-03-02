@extends('layouts.app')
@section('content')
<div class="fila">
	<div class="columna columna-1">
		<div class="title2">
			<h6>{{ __('Entidades > Clientes > Nuevo') }}</h6>
		</div>
	</div>
</div>
<form method="POST" action="{{ route('customers.store') }}" role="form" id="frm-customer">
	@csrf
	<div class="fila">
		<div class="columna columna-1">
			<h6 class="title3">{{ __('Datos generales') }}</h6>
			<a id="icn-gen" onclick="showForm('gen')" class="icn-sct"><i class="fa fa-minus fa-icon"></i></a>
		</div>
	</div>
	<div id="div-gen">
		<div class="fila">
			<div class="columna columna-2">
				<p>{{ __('Razón social*') }}</p>
				<input type="text" name="name" id="name" maxlength="100" value="{{ old('name') }}" onkeypress="return checkText(event)" required>
			</div>
			<div class="columna columna-4">
				<p>{{ __('Nombre comercial*') }}</p>
				<input type="text" name="alias" id="alias" maxlength="100" value="{{ old('alias') }}" onkeypress="return checkText(event)" onkeyup="return mayusculas(this)" required>
			</div>
			<div class="columna columna-6">
				<p>{{ __('R. U. C.*') }}</p>
				<input type="text" name="ruc" id="ruc" maxlength="11" value="{{ old('ruc') }}" onkeypress="return checkNumber(event)" required>
			</div>
			<div class="columna columna-12">
				<p>{{ __('Código*') }}</p>
				<input type="text" name="code" id="code" maxlength="3" value="{{ old('code') }}" onkeypress="return checkAlpha(event)" onkeyup="return mayusculas(this)" required>
			</div>
		</div>
		<div class="fila">
			<div class="columna columna-2">
				<p>{{ __('Dirección de facturación*') }}</p>
				<input type="text" name="address" id="address" maxlength="100" value="{{ old('address') }}" onkeypress="return checkText(event)" required>
			</div>
			<div class="columna columna-4">
				<p>{{ __('Distrito de facturación*') }}</p>
				@inject('districts','App\Services\Districts')
				<select name="district_id" id="district_id" required>
					<option selected disabled hidden value="">{{ __('Selecciona un distrito') }}</option>
					@foreach ($districts->get() as $index => $district)
					<option value="{{ $index }}" {{ old('district_id') == $index ? 'selected' : '' }}>
						{{ $district }}
					</option>
					@endforeach
				</select>
			</div>
			<div class="columna columna-4">
				<p>{{ __('Rubro de negocio*') }}</p>
				@inject('bussiness','App\Services\Bussiness')
				<select name="business_id" id="business_id" required>
					<option selected disabled hidden value="">{{ __('Selecciona un rubro') }}</option>
					@foreach ($bussiness->get() as $index => $business)
					<option value="{{ $index }}" {{ old('business_id') == $index ? 'selected' : '' }}>
						{{ $business }}
					</option>
					@endforeach
				</select>
			</div>
		</div>
	</div>
</form>
@include('customers/contact')
<div class="fila">
	<div class="space"></div>
	<div class="columna columna-1">
		<center>
		<button type="submit" class="btn-effie" onclick="document.getElementById('frm-customer').submit();"><i class="fa fa-save"></i>&nbsp;{{ __('Registrar') }}</button>
		<a href="{{ route('customers.index') }}" class="btn-effie-inv"><i class="fa fa-reply"></i>&nbsp;Regresar</a>
		</center>
	</div>
</div>
<div class="fila">
	<div class="space"></div>
	<div class="columna columna-1">
		<p>
			<i class="fa fa-info-circle fa-icon" aria-hidden="true"></i>&nbsp;
			<b>{{ __('Importante') }}</b>
			<ul>
				<li>{{ __('(*) Campos obligatorios.') }}</li>
				<li>{{ __('El tamaño máximo de la razón social y la dirección de facturación es cien (100) caracteres.') }}</li>
				<li>{{ __('El tamaño máximo del nombre comercial es cincuenta (50) caracteres.') }}</li>
				<li>{{ __('El código debe estar compuesto únicamente por tres (3) letras.') }}</li>
				<li>{{ __('El R. U. C. debe estar compuesto por once (11) caracteres.') }}</li>
				<li>{{ __('El tamaño máximo del nombre completo del contacto es cincuenta (50) caracteres.') }}</li>
				<li>{{ __('El tamaño máximo del cargo y correo electrónico del contacto es cincuenta (50) caracteres.') }}</li>
				<li>{{ __('Para cancelar la edición de datos de un contacto presione el botón "Limpiar" sobre la lista de contactos regitrados.') }}</li>
				<li>{{ __('Para guardar los cambios efectuados en la lista de contactos presione el botón "Registrar" en la zona inferior del formulario.') }}</li>
			</ul>
		</p>
	</div>
</div>
@endsection

@section('script')
<script src="{{ asset('js/jquery.inputmask.bundle.js') }}"></script>
<script src="{{ asset('js/customers/contact.js') }}"></script>
<script src="{{ asset('js/customers/form.js') }}"></script>
@endsection