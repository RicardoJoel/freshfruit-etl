<div class="fila">
    <div class="space"></div>
    <div class="columna columna-1">
        <h6 id="subtitle" class="title3">{{ __('Agregar contacto') }}</h6>
        <a id="icn-dep" onclick="showForm('dep')" class="icn-sct"><i class="fa fa-minus fa-icon"></i></a>
    </div>
</div>
<div id="div-dep">
    <form method="POST" action="{{ action('ContactController@store') }}" role="form" id="contact_form">
        @csrf
        <input type="hidden" name="_method" id="contact_method">
        <input type="hidden" name="contact_id" id="contact_id" value="{{ old('contact_id') }}">
        <div class="fila">
            <div class="columna columna-6">
                <p>{{ __('Tipo de contacto*') }}</p>
                @inject('contactTypes','App\Services\ContactTypes')
                <select name="contact_type_id" id="contact_type_id" required>
                    <option selected disabled hidden value="">{{ __('Selecciona') }}</option>
                    @foreach ($contactTypes->get() as $index => $contactType)
                    <option value="{{ $index }}" {{ old('contact_type_id') == $index ? 'selected' : '' }}>
                        {{ $contactType }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="columna columna-3">
                <p>{{ __('Nombre completo*') }}</p>
                <input type="text" name="contact_fullname" id="contact_fullname" maxlength="50" value="{{ old('contact_fullname') }}" onkeypress="return checkName(event)" required>
            </div>
            <div class="columna columna-6">
                <p>{{ __('Fecha nacimiento') }}</p>
                <input type="date" name="contact_birthdate" id="contact_birthdate" max="{{ Carbon\Carbon::today()->subYear(18)->toDateString() }}" value="{{ old('contact_birthdate') }}">
            </div>
            <div class="columna columna-3">
                <p>{{ __('Cargo*') }}</p>
                <input type="text" name="contact_position" id="contact_position" maxlength="50" value="{{ old('contact_position') }}" onkeypress="return checkText(event)" required>
            </div>
        </div>
        <div class="fila">
			<div class="columna columna-6">
				<p>{{ __('Código de país*') }}</p>
				@inject('countries','App\Services\Countries')
				<select name="contact_country_id" id="contact_country_id" required>
					<option selected disabled hidden value="">{{ __('Selecciona un país') }}</option>
					@foreach ($countries->get() as $index => $country)
					<option value="{{ $index }}" {{ old('contact_country_id',164) == $index ? 'selected' : '' }}>
						{{ $country }}
					</option>
					@endforeach
				</select>
			</div>
			<div class="columna columna-6">
				<p>{{ __('Número celular*') }}</p>
				<input type="tel" name="contact_mobile" id="contact_mobile" maxlength="11" value="{{ old('contact_mobile') }}" onkeypress="return checkNumber(event)" placeholder="999 999 999" required>
			</div>
			<div class="columna columna-6">
				<p>{{ __('Teléfono fijo') }}</p>
				<input type="tel" name="contact_phone" id="contact_phone" maxlength="11" value="{{ old('contact_phone') }}" onkeypress="return checkNumber(event)" placeholder="99 999 9999">
			</div>
			<div class="columna columna-6">
				<p>{{ __('Anexo') }}</p>
				<input type="tel" name="contact_annex" id="contact_annex" maxlength="6" value="{{ old('contact_annex') }}" onkeypress="return checkNumber(event)" placeholder="4 a 6 dígitos">
			</div>
			<div class="columna columna-3">
				<p>{{ __('Correo electrónico*') }}</p>
                <input type="email" name="contact_email" id="contact_email" maxlength="50" value="{{ old('contact_email') }}" onkeypress="return checkEmail(event)" required>
            </div>
		</div>
        <div class="fila">
            <div class="columna columna-1">
                <div class="span-fail" id="contact_fail_div"><span id="contact_fail_msg"></span></div>
            </div>
        </div>
        <div class="fila">
            <div class="space"></div>
            <div class="columna columna-1">
                <center>
                <button id="contact_submit" type="submit" class="btn-effie"><i class="fa fa-plus-circle"></i>&nbsp;{{ __('Agregar') }}</button>
                <a onclick="clearForm()" class="btn-effie-inv"><i class="fa fa-paint-brush"></i>&nbsp;{{ __('Limpiar') }}</a>	
                </center>
            </div>
        </div>
    </form>
</div>
<div class="fila">
    <div class="space"></div>
    <div class="columna columna-1">
        <h6 class="title3">{{ __('Contactos registrados') }}</h6>
        <a id="icn-lst" onclick="showForm('lst')" class="icn-sct"><i class="fa fa-minus fa-icon"></i></a>
    </div>
</div>
<div id="div-lst" class="fila">
    <div class="columna columna-1">
        <table id="tbl-contacts" class="tablealumno">
            <thead>
                <th width="10%">{{ __('Tipo') }}</th>
                <th width="20%">{{ __('Nombre completo') }}</th>
                <th width="10%">{{ __('F. Nacimiento') }}</th>
                <th width="10%">{{ __('Cargo') }}</th>
                <th width="20%">{{ __('Correo electrónico') }}</th>
                <th width="10%">{{ __('Celular') }}</th>
                <th width="10%">{{ __('Teléfono') }}</th>
                <th width="5%">{{ __('Editar') }}</th>
                <th width="5%">{{ __('Borrar') }}</th>
            </thead>
            <tbody>
                @foreach ($contacts as $index => $contact)
                <tr>
                    <td><center>{{ $contact['type'] }}</center></td>
                    <td><center>{{ $contact['fullname'] }}</center></td>
                    <td><center>{{ $contact['birthdate'] ? Carbon\Carbon::parse($contact['birthdate'])->format('d/m/Y') : '' }}</center></td>
                    <td><center>{{ $contact['position'] }}</center></td>
                    <td><center>{{ $contact['email'] }}</center></td>
                    <td><center>{{ $contact['mobile'] }}</center></td>
                    <td><center>{{ $contact['phone'].($contact['annex'] ? ' #'.$contact['annex'] : '') }}</center></td>
                    <td><center><a name="{{ $index }}" onclick="editContact(this)"><i class="fa fa-edit"></i></a></center></td>
                    <td><center><a name="{{ $index }}" onclick="removeContact(this)"><i class="fa fa-trash"></i></a></center></td>
                </tr>
                @endforeach
            </tbody>			
        </table>
    </div>
</div>