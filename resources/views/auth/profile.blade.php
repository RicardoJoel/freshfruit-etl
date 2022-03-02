@extends('layouts.app')
@section('content')
<div class="fila">
	<div class="columna columna-1">
		<div class="title2">
			<h6>{{ __('Mi cuenta > Mis datos') }}</h6>
		</div>
	</div>
</div>
<form method="POST" action="{{ route('updateAccount') }}" role="form" id="frm-profile">
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
			<div class="columna columna-3">
				<p>{{ __('Nombres*') }}</p>
				<input type="text" name="name" id="name" maxlength="50" value="{{ old('name',Auth::user()->name) }}" onkeypress="return checkName(event)" required>
			</div>
			<div class="columna columna-3">
				<p>{{ __('Apellidos*') }}</p>
				<input type="text" name="lastname" id="lastname" maxlength="50" value="{{ old('lastname',Auth::user()->lastname) }}" onkeypress="return checkName(event)" required>
			</div>
			<div class="columna columna-3">
				<p>{{ __('Correo electrónico institucional') }}</p>
				<input type="text" value="{{ Auth::user()->email }}" disabled>
			</div>
		</div>
		<div class="fila">
			<div class="columna columna-3">
				<p>{{ __('Tipo de documento') }}</p>
				<input type="text" value="{{ Auth::user()->documentType->name ?? '' }}" disabled>
			</div>
			<div class="columna columna-6">
				<p>{{ __('N° Documento') }}</p>
				<input type="text" value="{{ Auth::user()->document }}" disabled>
			</div>
			<div class="columna columna-6">
				<p>{{ __('Género*') }}</p>
				@inject('genders','App\Services\Genders')
				<select name="gender_id" id="gender_id" required>
					<option selected disabled hidden value="">{{ __('Selecciona') }}</option>
					@foreach ($genders->get() as $index => $gender)
					<option value="{{ $index }}" {{ old('gender_id',Auth::user()->gender_id) == $index ? 'selected' : '' }}>
						{{ $gender }}
					</option>
					@endforeach
				</select>
			</div>
			<div class="columna columna-3">
				<p>{{ __('Fecha de nacimiento') }}</p>
				<input type="text" value="{{ Carbon\Carbon::parse(Auth::user()->birthdate)->format('d/m/Y') }}" disabled>
			</div>
		</div>
	</div>
	<div class="fila">
		<div class="space"></div>
        <div class="columna columna-1">
			<a onclick="showForm('ctt')">
				<h6 id="ctt_subt" class="title3">Datos de contacto</h6>
				<p id="icn-ctt" class="icn-sct"><i class="fa fa-minus fa-icon"></i></p>
			</a>
		</div>
    </div>
	<div id="div-ctt">
		<div class="fila">
			<div class="columna columna-2">
				<p>{{ __('Dirección de domicilio*') }}</p>
				<input type="text" name="address" id="address" maxlength="100" value="{{ old('address',Auth::user()->address) }}" onkeypress="return checkText(event)" required>
			</div>
			<div class="columna columna-2">
				<p>{{ __('Departamento / Provincia / Distrito de domicilio*') }}</p>
				@inject('districts','App\Services\Districts')
				<select name="district_id" id="district_id" required>
					<option selected disabled hidden value="">{{ __('Selecciona un distrito') }}</option>
					@foreach ($districts->get() as $index => $district)
					<option value="{{ $index }}" {{ old('district_id',Auth::user()->district_id) == $index ? 'selected' : '' }}>
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
					<option value="{{ $index }}" {{ old('country_id',Auth::user()->country_id ?? 164) == $index ? 'selected' : '' }}>
						{{ $country }}
					</option>
					@endforeach
				</select>
			</div>
			<div class="columna columna-6">
				<p>{{ __('Número celular*') }}</p>
				<input type="tel" name="mobile" id="mobile" maxlength="17" value="{{ old('mobile',Auth::user()->mobile) }}" onkeypress="return checkNumber(event)" pattern="[0-9]{3} [0-9]{3} [0-9]{3}" placeholder="999 999 999" required>
			</div>
			<div class="columna columna-6">
				<p>{{ __('Teléfono fijo') }}</p>
				<input type="tel" name="phone" id="phone" maxlength="11" value="{{ old('phone',Auth::user()->phone) }}" onkeypress="return checkNumber(event)" pattern="[0-9]{2} [0-9]{3} [0-9]{4}" placeholder="99 999 9999">
			</div>
			<div class="columna columna-6">
				<p>{{ __('Anexo') }}</p>
				<input type="tel" name="annex" id="annex" maxlength="6" value="{{ old('annex',Auth::user()->annex) }}" onkeypress="return checkNumber(event)" pattern="[0-9]{4,6}" placeholder="4 a 6 dígitos">
			</div>
			<div class="columna columna-3">
				<p>{{ __('Correo electrónico personal') }}</p>
				<input type="email" name="alt_email" id="alt_email" maxlength="50" value="{{ old('alt_email',Auth::user()->alt_email) }}" onkeypress="return checkEmail(event)" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$">
			</div>
		</div>
	</div>
	<div class="fila">
		<div class="space"></div>
        <div class="columna columna-1">
			<a onclick="showForm('lab')">
				<h6 id="lab_subt" class="title3">Datos laborales</h6>
				<p id="icn-lab" class="icn-sct"><i class="fa fa-minus fa-icon"></i></p>
			</a>
		</div>
    </div>
	<div id="div-lab">
		<div class="fila">
			<div class="columna columna-2">
				<p>{{ __('Área funcional') }}</p>
				<input type="text" value="{{ Auth::user()->department->name ?? '' }}" disabled>
			</div>
			<div class="columna columna-2">
				<p>{{ __('Cargo') }}</p>
				<input type="text" value="{{ Auth::user()->profile->name ?? '' }}" disabled>
			</div>
		</div>
		<div class="fila">
			<div class="columna columna-6">
				<p>{{ __('Vínculo laboral') }}</p>
				<input type="text" value="{{ Auth::user()->relationship->name ?? '' }}" disabled>
			</div>
			<div class="columna columna-6">
				<p>{{ __('Sueldo actual (S/)') }}</p>
				<input type="text" value="{{ number_format(Auth::user()->cur_salary) }}" disabled>
			</div>
			<div class="columna columna-6">
				<p>{{ __('Comisión (%)') }}</p>
				<input type="text" value="{{ number_format(Auth::user()->commission) }}" disabled>
			</div>
			<div class="columna columna-6">
				<p>{{ __('Variación salarial') }}</p>
				<input type="text" value="{{ Auth::user()->frequency->name ?? '' }}" disabled>
			</div>
			<div class="columna columna-6">
				<p>{{ __('Fecha de inicio') }}</p>
				<input type="text" value="{{ Auth::user()->start_at ? Carbon\Carbon::parse(Auth::user()->start_at)->format('d/m/Y') : '' }}" disabled>
			</div>
			<div class="columna columna-6">
				<p>{{ __('Fecha de cese') }}</p>
				<input type="text" value="{{ Auth::user()->end_at ? Carbon\Carbon::parse(Auth::user()->end_at)->format('d/m/Y') : '' }}" disabled>
			</div>
		</div>
	</div>
	<div class="fila">
		<div class="space"></div>
        <div class="columna columna-1">
			<a onclick="showForm('pln')">
				<h6 id="pln_subt" class="title3">Datos de planilla</h6>
				<p id="icn-pln" class="icn-sct"><i class="fa fa-plus fa-icon"></i></p>
			</a>
		</div>
    </div>
	<div id="div-pln" style="display:none">
		<div class="fila">
			<div class="columna columna-3">
				<p>{{ __('Entidad bancaria Sueldo') }}</p>
				<input type="text" value="{{ Auth::user()->bank->name ?? '' }}" disabled>
			</div>
			<div class="columna columna-3">
				<p>{{ __('N° Cuenta Sueldo') }}</p>
				<input type="text" value="{{ Auth::user()->bank_account }}" disabled>
			</div>
			<div class="columna columna-3">
				<p>{{ __('Código de Cuenta Interbancario (CCI)') }}</p>
				<input type="text" value="{{ Auth::user()->cci }}" disabled>
			</div>
		</div>
		<div class="fila">
			<div class="columna columna-3">
				<p>{{ __('Adm. Fondo de pensiones (AFP)') }}</p>
				<input type="text" value="{{ Auth::user()->afp->name ?? '' }}" disabled>

			</div>
			<div class="columna columna-3">
				<p>{{ __('Tipo de comisión') }}</p>
				<input type="text" value="{{ Auth::user()->afpCommission->name ?? '' }}" disabled>
			</div>
			<div class="columna columna-3">
				<p>{{ __('Código CUSPP') }}</p>
				<input type="text" value="{{ Auth::user()->cuspp }}" disabled>
			</div>
		</div>
		<div class="fila">
			<div class="columna columna-3">
				<p>{{ __('Entidad bancaria CTS') }}</p>
				<input type="text" value="{{ Auth::user()->cts->name ?? '' }}" disabled>
			</div>
			<div class="columna columna-3">
				<p>{{ __('N° Cuenta CTS') }}</p>
				<input type="text" value="{{ Auth::user()->cts_account }}" disabled>
			</div>
		</div>
		<div class="fila">
			<div class="columna columna-3">
				<p>{{ __('Plan EPS') }}</p>
				<input type="text" value="{{ Auth::user()->eps->name ?? '' }}" disabled>
			</div>
			<div class="columna columna-3">
				<p>{{ __('Código Essalud') }}</p>
				<input type="text" value="{{ Auth::user()->essalud }}" disabled>
			</div>
		</div>
		<div class="fila">
			<div class="columna columna-3">
				<p>{{ __('Código autogenerado') }}</p>
				<input type="text" value="{{ Auth::user()->code }}" disabled>
			</div>
		</div>
	</div>
	<div class="fila">
		<div class="space"></div>
        <div class="columna columna-1">
			<a onclick="showForm('mrg')">
				<h6 id="mrg_subt" class="title3">Contacto en caso de emergencia</h6>
				<p id="icn-mrg" class="icn-sct"><i class="fa fa-plus fa-icon"></i></p>
			</a>
		</div>
    </div>
	<div id="div-mrg" style="display:none">
		<div class="fila">
			<div class="columna columna-3">
				<p>{{ __('Nombre completo') }}</p>
				<input type="text" name="contact_fullname" id="contact_fullname" maxlength="50" value="{{ old('contact_fullname',Auth::user()->contact_fullname) }}" onkeypress="return checkName(event)">
			</div>
			<div class="columna columna-3">
				<p>{{ __('Parentesco') }}</p>
				<input type="text" name="contact_relationship" id="contact_relationship" maxlength="50" value="{{ old('contact_relationship',Auth::user()->contact_relationship) }}" onkeypress="return checkName(event)">
			</div>
			<div class="columna columna-3">
				<p>{{ __('Dirección laboral o de domicilio') }}</p>
				<input type="text" name="contact_address" id="contact_address" maxlength="100" value="{{ old('contact_address',Auth::user()->contact_address) }}" onkeypress="return checkText(event)">
			</div>
		</div>
		<div class="fila">
			<div class="columna columna-3">
				<p>{{ __('Departamento / Provincia / Distrito') }}</p>
				@inject('districts','App\Services\Districts')
				<select name="contact_district_id" id="contact_district_id">
					<option selected disabled hidden value="">{{ __('Selecciona un distrito') }}</option>
					@foreach ($districts->get() as $index => $district)
					<option value="{{ $index }}" {{ old('contact_district_id',Auth::user()->contact_district_id) == $index ? 'selected' : '' }}>
						{{ $district }}
					</option>
					@endforeach
				</select>
			</div>
			<div class="columna columna-6">
				<p>{{ __('Código país') }}</p>
				@inject('countries','App\Services\Countries')
				<select name="contact_country_id" id="contact_country_id">
					<option selected disabled hidden value="">{{ __('Selecciona un país') }}</option>
					@foreach ($countries->get() as $index => $country)
					<option value="{{ $index }}" {{ old('contact_country_id',Auth::user()->contact_country_id ?? 164) == $index ? 'selected' : '' }}>
						{{ $country }}
					</option>
					@endforeach
				</select>
			</div>
			<div class="columna columna-6">
				<p>{{ __('Número celular') }}</p>
				<input type="tel" name="contact_mobile" id="contact_mobile" maxlength="11" value="{{ old('contact_mobile',Auth::user()->contact_mobile) }}" onkeypress="return checkNumber(event)" pattern="[0-9]{3} [0-9]{3} [0-9]{3}" placeholder="999 999 999">
			</div>
			<div class="columna columna-6">
				<p>{{ __('Teléfono fijo') }}</p>
				<input type="tel" name="contact_phone" id="contact_phone" maxlength="11" value="{{ old('contact_phone',Auth::user()->contact_phone) }}" onkeypress="return checkNumber(event)" pattern="[0-9]{2} [0-9]{3} [0-9]{4}" placeholder="99 999 9999">
			</div>
			<div class="columna columna-6">
				<p>{{ __('Anexo') }}</p>
				<input type="tel" name="contact_annex" id="contact_annex" maxlength="6" value="{{ old('contact_annex',Auth::user()->contact_annex) }}" onkeypress="return checkNumber(event)" pattern="[0-9]{4,6}" placeholder="4 a 6 dígitos">
			</div>
		</div>
	</div>
</form>
<div class="fila">
    <div class="space"></div>
    <div class="columna columna-1">
        <a onclick="showForm('lst')">
            <h6 id="lst_subt" class="title3">Dependientes registrados</h6>
            <p id="icn-lst" class="icn-sct"><i class="fa fa-plus fa-icon"></i></p>
        </a>
    </div>
</div>
<div id="div-lst" class="fila" style="display:none">
	<div class="columna columna-1">
		<table id="tbl-dependents" class="tablealumno">
			<thead>
				<th width="20%">{{ __('Nombre completo') }}</th>
				<th width="20%">{{ __('Vínculo familiar') }}</th>
				<th width="20%">{{ __('Tipo de documento') }}</th>
				<th width="15%">{{ __('N° Documento') }}</th>
				<th width="15%">{{ __('F. Nacimiento') }}</th>
				<th width="10%">{{ __('Género') }}</th>
			</thead>
			<tbody>
				@if (Auth::user()->dependents->count())
				@foreach (Auth::user()->dependents as $dependent)
				<tr>
					<td>{{ $dependent->dependent_fullname }}</td>
					<td><center>{{ $dependent->dependentType->name ?? '' }}</center></td>
					<td><center>{{ $dependent->documentType->name ?? '' }}</center></td>
					<td><center>{{ $dependent->dependent_document }}</center></td>
					<td><center>{{ Carbon\Carbon::parse($dependent->dependent_birthdate)->format('d/m/Y') }}</center></td>
					<td><center>{{ $dependent->gender->name ?? '' }}</center></td>
				</tr>
				@endforeach
				@else
				<tr>
					<td colspan="6">{{ __('Sin resultados encontrados') }}</td>
				</tr>
				@endif
			</tbody>			
		</table>
	</div>
	<div class="columna columna-1">
		<div class="space"></div>
	</div>
</div>
<div class="fila">
    <div class="space"></div>
    <div class="columna columna-1">
        <a onclick="showForm('sal')">
            <h6 id="sal_subt" class="title3">Variaciones salariales registradas</h6>
            <p id="icn-sal" class="icn-sct"><i class="fa fa-plus fa-icon"></i></p>
        </a>
    </div>
</div>
<div id="div-sal" class="fila" style="display:none">
	<div class="columna columna-1">
		<table id="tbl-variations" class="tablealumno">
			<thead>
				<th width="20%">{{ __('F. Efectiva') }}</th>
				<th width="20%">{{ __('Tipo de variación') }}</th>
				<th width="20%">{{ __('Sueldo inicial (S/)') }}</th>
				<th width="20%">{{ __('Monto (S/)') }}</th>
				<th width="20%">{{ __('Sueldo final (S/)') }}</th>
			</thead>
			<tbody>
				@if (Auth::user()->variations->count())
				@foreach (Auth::user()->variations as $variation)
				<tr>
					<td><center>{{ Carbon\Carbon::parse($variation->variation_start_at)->format('d/m/Y') }}</center></td>
					<td><center>{{ $variation->variation_type }}</center></td>
					<td><center>{{ number_format($variation->variation_before) }}</center></td>
					<td><center>{{ number_format($variation->variation_amount) }}</center></td>
					<td><center>{{ number_format($variation->variation_after) }}</center></td>
				</tr>
				@endforeach
				@else
				<tr>
					<td colspan="5">{{ __('Sin resultados encontrados') }}</td>
				</tr>
				@endif
			</tbody>			
		</table>
	</div>
</div>
<div class="fila">
	<div class="space"></div>
	<div class="columna columna-1">
		<center>
		<button type="submit" class="btn-effie" onclick="document.getElementById('frm-profile').submit()"><i class="fa fa-save"></i>&nbsp;{{ __('Guardar') }}</button>
		<a href="{{ route('home') }}" class="btn-effie-inv"><i class="fa fa-home"></i>&nbsp;Ir al inicio</a>
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
					<li>{{ __('El tamaño máximo del nombre y apellidos es cincuenta (50) caracteres.') }}</li>
					<li>{{ __('El tamaño máximo de la dirección de domicilio es cien (100) caracteres.') }}</li>
					<li>{{ __('El tamaño máximo del nombre completo y parentesco del contacto de emergencia es cincuenta (50) caracteres.') }}</li>
					<li>{{ __('El tamaño máximo de la dirección del contacto de emergencia es cien (100) caracteres.') }}</li>
				</ul>
			</p>
		</div>
	</div>
</div>
@endsection

@section('script')
<script src="{{ asset('js/jquery.inputmask.bundle.js') }}"></script>
<script src="{{ asset('js/account.js') }}"></script>
@endsection