@extends('layouts.app')
@section('content')
<div class="fila">
	<div class="columna columna-1">
		<div class="title2">
			<h6>{{ __('Entidades > Proveedores > Nuevo') }}</h6>
		</div>
	</div>
</div>
<form method="POST" action="{{ route('suppliers.store') }}" role="form" id="frm-supplier">
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
				<p>{{ __('Nombre o razón social*') }}</p>
				<input type="text" name="name" id="name" maxlength="100" value="{{ old('name') }}" onkeypress="return checkText(event)" required>
			</div>
			<div class="columna columna-6">
				<p>{{ __('Código*') }}</p>
				<input type="text" disabled>
			</div>
			<div class="columna columna-3">
				<p>{{ __('Ocupación*') }}</p>
				@inject('profiles','App\Services\Profiles')
				<select name="profile_id" id="profile_id" required>
					<option selected disabled hidden value="">{{ __('Selecciona una ocupación') }}</option>
					@foreach ($profiles->get('P') as $index => $profile)
					<option value="{{ $index }}" {{ old('profile_id') == $index ? 'selected' : '' }}>
						{{ $profile }}
					</option>
					@endforeach
				</select>
			</div>
		</div>
		<div class="fila">
			<div class="columna columna-3">
				<p>{{ __('Tipo de documento*') }}</p>
				@inject('documentTypes','App\Services\DocumentTypes')
				<select name="document_type_id" id="document_type_id" required>
					<option selected disabled hidden value="">{{ __('Selecciona un tipo de documento') }}</option>
					@foreach ($documentTypes->get() as $index => $documentType)
					<option value="{{ $index }}" {{ old('document_type_id') == $index ? 'selected' : '' }}>
						{{ $documentType['name'] }}
					</option>
					@endforeach
				</select>
			</div>
			<div class="columna columna-6">
				<p>{{ __('N° Documento*') }}</p>
				<input type="hidden" name="doc_pattern" id="doc_pattern" value="{{ old('doc_pattern') }}" required>
				<input type="text" name="document" id="document" value="{{ old('document') }}" onkeyup="return mayusculas(this)" disabled required>
			</div>
			<div class="columna columna-2">
				<p>{{ __('Especifica otra ocupación') }}</p>
				<input type="text" name="other" id="other" maxlength="100" value="{{ old('other') }}" onkeypress="return checkText(event)" disabled>
			</div>
		</div>
	</div>
	<div class="fila">
		<div class="space"></div>
		<div class="columna columna-1">
			<h6 class="title3">{{ __('Datos de contacto') }}</h6>
			<a id="icn-ctt" onclick="showForm('ctt')" class="icn-sct"><i class="fa fa-minus fa-icon"></i></a>
		</div>
	</div>
	<div id="div-ctt">
		<div class="fila">
			<div class="columna columna-2">
				<p>{{ __('Dirección de facturación*') }}</p>
				<input type="text" name="address" id="address" maxlength="100" value="{{ old('address') }}" onkeypress="return checkText(event)" required>
			</div>
			<div class="columna columna-2">
				<p>{{ __('Departamento / Provincia / Distrito de facturación*') }}</p>
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
		</div>
		<div class="fila">
			<div class="columna columna-6">
				<p>{{ __('Código país*') }}</p>
				@inject('countries','App\Services\Countries')
				<select name="country_id" id="country_id" required>
					<option selected disabled hidden value="">{{ __('Selecciona un país') }}</option>
					@foreach ($countries->get() as $index => $country)
					<option value="{{ $index }}" {{ old('country_id',164) == $index ? 'selected' : '' }}>
						{{ $country }}
					</option>
					@endforeach
				</select>
			</div>
			<div class="columna columna-6">
				<p>{{ __('Número celular*') }}</p>
				<input type="tel" name="mobile" id="mobile" maxlength="11" value="{{ old('mobile') }}" onkeypress="return checkNumber(event)" pattern="[0-9]{3} [0-9]{3} [0-9]{3}" placeholder="999 999 999" required>
			</div>
			<div class="columna columna-6">
				<p>{{ __('Teléfono fijo') }}</p>
				<input type="tel" name="phone" id="phone" maxlength="11" value="{{ old('phone') }}" onkeypress="return checkNumber(event)" pattern="[0-9]{2} [0-9]{3} [0-9]{4}" placeholder="99 999 9999">
			</div>
			<div class="columna columna-6">
				<p>{{ __('Anexo') }}</p>
				<input type="tel" name="annex" id="annex" maxlength="6" value="{{ old('annex') }}" onkeypress="return checkNumber(event)" pattern="[0-9]{4,6}" placeholder="4 a 6 dígitos">
			</div>
			<div class="columna columna-3">
				<p>{{ __('Correo electrónico') }}</p>
				<input type="email" name="email" id="email" maxlength="50" value="{{ old('email') }}" onkeypress="return checkEmail(event)" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$">
			</div>
		</div>
	</div>
	<div class="fila">
		<div class="space"></div>
		<div class="columna columna-1">
			<h6 class="title3">{{ __('Datos de facturación') }}</h6>
			<a id="icn-pln" onclick="showForm('pln')" class="icn-sct"><i class="fa fa-minus fa-icon"></i></a>
		</div>
	</div>
	<div id="div-pln">
		<div class="fila">
			<div class="columna columna-3">
				<p>{{ __('Entidad bancaria') }}</p>
				@inject('banks','App\Services\Banks')
				<select name="bank_id" id="bank_id">
					<option selected disabled hidden value="">{{ __('Selecciona una entidad bancaria') }}</option>
					@foreach ($banks->get() as $index => $bank)
					<option value="{{ $index }}" {{ old('bank_id') == $index ? 'selected' : '' }}>
						{{ $bank }}
					</option>
					@endforeach
				</select>
			</div>
			<div class="columna columna-3">
				<p>{{ __('N° Cuenta') }}</p>
				<input type="text" name="account" id="account" maxlength="20" value="{{ old('account') }}" onkeypress="return checkNumber(event)" disabled>
			</div>
			<div class="columna columna-3">
				<p>{{ __('Código de Cuenta Interbancario (CCI)') }}</p>
				<input type="text" name="cci" id="cci" maxlength="23" value="{{ old('cci') }}" onkeypress="return checkNumber(event)" disabled>
			</div>
		</div>
	</div>
	<div class="fila">
		<div class="space"></div>
		<div class="columna columna-1">
			<center>
			<button type="submit" class="btn-effie"><i class="fa fa-save"></i>&nbsp;{{ __('Registrar') }}</button>
			<a href="{{ route('suppliers.index') }}" class="btn-effie-inv"><i class="fa fa-reply"></i>&nbsp;Regresar</a>
			</center>
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
				<li>{{ __('El tamaño máximo del nombre o razón social y la dirección de facturación es cien (100) caracteres.') }}</li>
				<li>{{ __('El código debe estar compuesto únicamente por tres (3) letras.') }}</li>
				<li>{{ __('El tamaño máximo del correo electrónico es cincuenta (50) caracteres.') }}</li>
			</ul>
		</p>
	</div>
</div>
@endsection

@section('script')
<script src="{{ asset('js/jquery.inputmask.bundle.js') }}"></script>
<script src="{{ asset('js/suppliers/form3.js') }}"></script>
@endsection