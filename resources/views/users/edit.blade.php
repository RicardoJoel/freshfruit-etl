@extends('layouts.app')
@section('content')
<div class="fila">
	<div class="columna columna-1">
		<div class="title2">
			<h6>{{ __('Entidades > Colaboradores > Editar') }}</h6>
		</div>
	</div>
</div>
<form method="POST" action="{{ route('users.update',$user->id) }}" role="form" id="frm-user">
	@csrf
	<input type="hidden" name="_method" id="_method" value="PATCH">
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
				<input type="text" name="name" id="name" maxlength="50" value="{{ old('name',$user->name) }}" onkeypress="return checkName(event)" required>
			</div>
			<div class="columna columna-3">
				<p>{{ __('Apellidos*') }}</p>
				<input type="text" name="lastname" id="lastname" maxlength="50" value="{{ old('lastname',$user->lastname) }}" onkeypress="return checkName(event)" required>
			</div>
			<div class="columna columna-3">
				<p>{{ __('Correo electrónico institucional*') }}</p>
				<input type="email" name="email" id="email" maxlength="50" value="{{ old('email',$user->email) }}" onkeypress="return checkEmail(event)" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2, 4}$" required>
			</div>
		</div>
		<div class="fila">
			<div class="columna columna-3">
				<p>{{ __('Tipo de documento*') }}</p>
				@inject('documentTypes','App\Services\DocumentTypes')
				<select name="document_type_id" id="document_type_id" required>
					<option selected disabled hidden value="">{{ __('Selecciona un tipo de documento') }}</option>
					@foreach ($documentTypes->get() as $index => $documentType)
					<option value="{{ $index }}" {{ old('document_type_id',$user->document_type_id) == $index ? 'selected' : '' }}>
						{{ $documentType['name'] }}
					</option>
					@endforeach
				</select>
			</div>
			<div class="columna columna-6">
				<p>{{ __('N° Documento*') }}</p>
				<input type="hidden" name="doc_pattern" id="doc_pattern" value="{{ old('doc_pattern') }}">
				<input type="text" name="document" id="document" value="{{ old('document',$user->document) }}" onkeyup="return mayusculas(this)" disabled required>
			</div>
			<div class="columna columna-6">
				<p>{{ __('Género*') }}</p>
				@inject('genders','App\Services\Genders')
				<select name="gender_id" id="gender_id" required>
					<option selected disabled hidden value="">{{ __('Selecciona') }}</option>
					@foreach ($genders->get() as $index => $gender)
					<option value="{{ $index }}" {{ old('gender_id',$user->gender_id) == $index ? 'selected' : '' }}>
						{{ $gender }}
					</option>
					@endforeach
				</select>					
			</div>
			<div class="columna columna-3">
				<p>{{ __('Fecha de nacimiento*') }}</p>
				<input type="date" name="birthdate" id="birthdate" max="{{ Carbon\Carbon::today()->subYear(18)->toDateString() }}" value="{{ old('birthdate',$user->birthdate) }}" required>
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
				<input type="text" name="address" id="address" maxlength="100" value="{{ old('address',$user->address) }}" onkeypress="return checkText(event)" required>
			</div>
			<div class="columna columna-2">
				<p>{{ __('Departamento / Provincia / Distrito de domicilio*') }}</p>
				@inject('districts','App\Services\Districts')
				<select name="district_id" id="district_id" required>
					<option selected disabled hidden value="">{{ __('Selecciona un distrito') }}</option>
					@foreach ($districts->get() as $index => $district)
					<option value="{{ $index }}" {{ old('district_id',$user->district_id) == $index ? 'selected' : '' }}>
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
					<option value="{{ $index }}" {{ old('country_id',$user->country_id ?? 164) == $index ? 'selected' : '' }}>
						{{ $country }}
					</option>
					@endforeach
				</select>
			</div>
			<div class="columna columna-6">
				<p>{{ __('Número celular*') }}</p>
				<input type="tel" name="mobile" id="mobile" maxlength="17" value="{{ old('mobile',$user->mobile) }}" onkeypress="return checkNumber(event)" pattern="[0-9]{3} [0-9]{3} [0-9]{3}" placeholder="999 999 999" required>
			</div>
			<div class="columna columna-6">
				<p>{{ __('Teléfono fijo') }}</p>
				<input type="tel" name="phone" id="phone" maxlength="11" value="{{ old('phone',$user->phone) }}" onkeypress="return checkNumber(event)" pattern="[0-9]{2} [0-9]{3} [0-9]{4}" placeholder="99 999 9999">
			</div>
			<div class="columna columna-6">
				<p>{{ __('Anexo') }}</p>
				<input type="tel" name="annex" id="annex" maxlength="6" value="{{ old('annex',$user->annex) }}" onkeypress="return checkNumber(event)" pattern="[0-9]{4,6}" placeholder="4 a 6 dígitos">
			</div>
			<div class="columna columna-3">
				<p>{{ __('Correo electrónico personal') }}</p>
				<input type="email" name="alt_email" id="alt_email" maxlength="50" value="{{ old('alt_email',$user->alt_email) }}" onkeypress="return checkEmail(event)" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$">
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
				<p>{{ __('Área funcional*') }}</p>
				@inject('departments','App\Services\Departments')
				<select name="department_id" id="department_id" required>
					<option selected disabled hidden value="">{{ __('Selecciona un área funcional') }}</option>
					@foreach ($departments->get() as $index => $department)
					<option value="{{ $index }}" {{ old('department_id',$user->department_id) == $index ? 'selected' : '' }}>
						{{ $department }}
					</option>
					@endforeach
				</select>
			</div>
			<div class="columna columna-2">
				<p>{{ __('Cargo*') }}</p>
				@inject('profiles','App\Services\Profiles')
				<select name="profile_id" id="profile_id" required>
					<option selected disabled hidden value="">{{ __('Selecciona un cargo') }}</option>
					@foreach ($profiles->get('T') as $index => $profile)
					<option value="{{ $index }}" {{ old('profile_id',$user->profile_id) == $index ? 'selected' : '' }}>
						{{ $profile }}
					</option>
					@endforeach
				</select>
			</div>
		</div>
		<div class="fila">
			<div class="columna columna-6">
				<p>{{ __('Vínculo laboral*') }}</p>
				@inject('relationships','App\Services\Relationships')
				<select name="relationship_id" id="relationship_id" required>
					<option selected disabled hidden value="">{{ __('Selecciona') }}</option>
					@foreach ($relationships->get() as $index => $relationship)
					<option value="{{ $index }}" {{ old('relationship_id',$user->relationship_id) == $index ? 'selected' : '' }}>
						{{ $relationship }}
					</option>
					@endforeach
				</select>
			</div>
			<div class="columna columna-6">
				<p>{{ __('Sueldo actual (S/)') }}</p>
				<input type="text" value="{{ number_format($user->cur_salary) }}" disabled>
			</div>
			<div class="columna columna-6">
				<p>{{ __('Comisión (%)') }}</p>
				<input type="number" name="commission" id="commission" value="{{ old('commission',$user->commission) }}" onkeypress="return checkNumber(event)">
			</div>
			<div class="columna columna-6">
				<p>{{ __('Variación salarial') }}</p>
				@inject('frequencies','App\Services\Frequencies')
				<select name="frequency_id" id="frequency_id" required>
					<option selected value="">{{ __('No variable') }}</option>
					@foreach ($frequencies->get() as $index => $frequency)
					<option value="{{ $index }}" {{ old('frequency_id',$user->frequency_id) == $index ? 'selected' : '' }}>
						{{ $frequency }}
					</option>
					@endforeach
				</select>
			</div>
			<div class="columna columna-6">
				<p>{{ __('Fecha de inicio') }}</p>
				<input type="date" name="start_at" id="start_at" value="{{ old('start_at',$user->start_at) }}">
			</div>
			<div class="columna columna-6">
				<p>{{ __('Fecha de cese') }}</p>
				<input type="date" name="end_at" id="end_at" value="{{ old('end_at',$user->end_at) }}" max="{{ Carbon\Carbon::today()->toDateString() }}">
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
				@inject('banks','App\Services\Banks')
				<select name="bank_id" id="bank_id">
					<option selected disabled hidden value="">{{ __('Selecciona una entidad bancaria') }}</option>
					@foreach ($banks->get() as $index => $bank)
					<option value="{{ $index }}" {{ old('bank_id',$user->bank_id) == $index ? 'selected' : '' }}>
						{{ $bank }}
					</option>
					@endforeach
				</select>
			</div>
			<div class="columna columna-3">
				<p>{{ __('N° Cuenta Sueldo') }}</p>
				<input type="text" name="bank_account" id="bank_account" maxlength="20" value="{{ old('bank_account',$user->bank_account) }}" onkeypress="return checkNumber(event)" disabled>
			</div>
			<div class="columna columna-3">
				<p>{{ __('Código de Cuenta Interbancario (CCI)') }}</p>
				<input type="text" name="cci" id="cci" maxlength="23" value="{{ old('cci',$user->cci) }}" onkeypress="return checkNumber(event)" disabled>
			</div>
		</div>
		<div class="fila">
			<div class="columna columna-3">
				<p>{{ __('Adm. Fondo de pensiones (AFP) / ONP') }}</p>
				@inject('afps','App\Services\AFPs')
				<select name="afp_id" id="afp_id">
					<option selected value="">{{ __('No cuenta con AFP / ONP') }}</option>
					@foreach ($afps->get() as $index => $afp)
					<option value="{{ $index }}" {{ old('afp_id',$user->afp_id) == $index ? 'selected' : '' }}>
						{{ $afp }}
					</option>
					@endforeach
				</select>
			</div>
			<div class="columna columna-3">
				<p>{{ __('Tipo de comisión') }}</p>
				@inject('commissions','App\Services\Commissions')
				<select name="commission_id" id="commission_id" disabled>
					<option selected disabled hidden value="">{{ __('Selecciona un tipo de comisión') }}</option>
					@foreach ($commissions->get() as $index => $commission)
					<option value="{{ $index }}" {{ old('commission_id',$user->commission_id) == $index ? 'selected' : '' }}>
						{{ $commission }}
					</option>
					@endforeach
				</select>
			</div>
			<div class="columna columna-3">
				<p>{{ __('Código CUSPP') }}</p>
				<input type="text" name="cuspp" id="cuspp" maxlength="12" value="{{ old('cuspp',$user->cuspp) }}" onkeypress="return checkAlNum(event)" onkeyup="return mayusculas(this)" disabled>
			</div>
		</div>
		<div class="fila">
			<div class="columna columna-3">
				<p>{{ __('Entidad bancaria CTS') }}</p>
				@inject('banks','App\Services\Banks')
				<select name="cts_id" id="cts_id">
					<option selected value="">{{ __('No cuenta con CTS') }}</option>
					@foreach ($banks->get() as $index => $bank)
					<option value="{{ $index }}" {{ old('cts_id',$user->cts_id) == $index ? 'selected' : '' }}>
						{{ $bank }}
					</option>
					@endforeach
				</select>
			</div>
			<div class="columna columna-3">
				<p>{{ __('N° Cuenta CTS') }}</p>
				<input type="text" name="cts_account" id="cts_account" maxlength="20" value="{{ old('cts_account',$user->cts_account) }}" onkeypress="return checkNumber(event)" disabled>
			</div>
		</div>
		<div class="fila">
			<div class="columna columna-3">
				<p>{{ __('Plan EPS') }}</p>
				@inject('epss','App\Services\EPSs')
				<select name="eps_id" id="eps_id">
					<option selected value="">{{ __('No cuenta con EPS') }}</option>
					@foreach ($epss->get() as $index => $eps)
					<option value="{{ $index }}" {{ old('eps_id',$user->eps_id) == $index ? 'selected' : '' }}>
						{{ $eps }}
					</option>
					@endforeach
				</select>
			</div>
			<div class="columna columna-3">
				<p>{{ __('Código Essalud') }}</p>
				<input type="text" name="essalud" id="essalud" maxlength="15" value="{{ old('essalud',$user->essalud) }}" onkeypress="return checkAlNum(event)" onkeyup="return mayusculas(this)">
			</div>
		</div>
		<div class="fila">
			<div class="columna columna-3">
				<p>{{ __('Usuario') }}</p>
				<input type="text" name="code" id="code" value="{{ old('code',$user->code) }}" disabled>
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
				<input type="text" name="contact_fullname" id="contact_fullname" maxlength="50" value="{{ old('contact_fullname',$user->contact_fullname) }}" onkeypress="return checkName(event)">
			</div>
			<div class="columna columna-3">
				<p>{{ __('Parentesco') }}</p>
				<input type="text" name="contact_relationship" id="contact_relationship" maxlength="50" value="{{ old('contact_relationship',$user->contact_relationship) }}" onkeypress="return checkName(event)">
			</div>
			<div class="columna columna-3">
				<p>{{ __('Dirección') }}</p>
				<input type="text" name="contact_address" id="contact_address" maxlength="100" value="{{ old('contact_address',$user->contact_address) }}" onkeypress="return checkText(event)">
			</div>
		</div>
		<div class="fila">
			<div class="columna columna-3">
				<p>{{ __('Departamento / Provincia / Distrito') }}</p>
				@inject('districts','App\Services\Districts')
				<select name="contact_district_id" id="contact_district_id">
					<option selected disabled hidden value="">{{ __('Selecciona un distrito') }}</option>
					@foreach ($districts->get() as $index => $district)
					<option value="{{ $index }}" {{ old('contact_district_id',$user->contact_district_id) == $index ? 'selected' : '' }}>
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
					<option value="{{ $index }}" {{ old('contact_country_id',$user->contact_country_id ?? 164) == $index ? 'selected' : '' }}>
						{{ $country }}
					</option>
					@endforeach
				</select>
			</div>
			<div class="columna columna-6">
				<p>{{ __('Número celular') }}</p>
				<input type="tel" name="contact_mobile" id="contact_mobile" maxlength="11" value="{{ old('contact_mobile',$user->contact_mobile) }}" onkeypress="return checkNumber(event)" pattern="[0-9]{3} [0-9]{3} [0-9]{3}" placeholder="999 999 999">
			</div>
			<div class="columna columna-6">
				<p>{{ __('Teléfono fijo') }}</p>
				<input type="tel" name="contact_phone" id="contact_phone" maxlength="11" value="{{ old('contact_phone',$user->contact_phone) }}" onkeypress="return checkNumber(event)" pattern="[0-9]{2} [0-9]{3} [0-9]{4}" placeholder="99 999 9999">
			</div>
			<div class="columna columna-6">
				<p>{{ __('Anexo') }}</p>
				<input type="tel" name="contact_annex" id="contact_annex" maxlength="6" value="{{ old('contact_annex',$user->contact_annex) }}" onkeypress="return checkNumber(event)" pattern="[0-9]{4,6}" placeholder="4 a 6 dígitos">
			</div>
		</div>
	</div>
</form>
@include('users/dependent')
@include('users/variation')
<div class="fila">
	<div class="space"></div>
	<div class="columna columna-1">
		<center>
		<button type="submit" class="btn-effie" onclick="document.getElementById('frm-user').submit()"><i class="fa fa-save"></i>&nbsp;{{ __('Guardar') }}</button>
		<a href="{{ route('users.index') }}" class="btn-effie-inv"><i class="fa fa-reply"></i>&nbsp;Regresar</a>
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
				<li>{{ __('El correo electrónico institucional es único y tiene un tamaño máximo de cincuenta (50) caracteres.') }}</li>
				<li>{{ __('El tamaño máximo del nombre y apellidos del colaborador es cincuenta (50) caracteres.') }}</li>
				<li>{{ __('El tamaño máximo de la dirección de domicilio del colaborador es cien (100) caracteres.') }}</li>
				<li>{{ __('El tamaño máximo del nombre completo y parentesco del contacto en caso de emergencia es cincuenta (50) caracteres.') }}</li>
				<li>{{ __('El tamaño máximo de la dirección del contacto en caso de emergencia es cien (100) caracteres.') }}</li>
				<li>{{ __('El tamaño máximo del nombre completo del dependiente es cincuenta (50) caracteres.') }}</li>
				<li>{{ __('Para cancelar la inserción o edición de datos de un dependiente presiona el botón "Limpiar".') }}</li>
				<li>{{ __('Para guardar los cambios efectuados en el colaborador y/o lista de dependientes presiona el botón "Guardar".') }}</li>
			</ul>
		</p>
	</div>
</div>
@endsection

@section('script')
<script src="{{ asset('js/jquery.inputmask.bundle.js') }}"></script>
<script src="{{ asset('js/users/dependents.js') }}"></script>
<script src="{{ asset('js/users/variation.js') }}"></script>
<script src="{{ asset('js/users/form3.js') }}"></script>
@endsection