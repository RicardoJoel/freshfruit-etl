<div class="fila">
    <div class="space"></div>
    <div class="columna columna-1">
        <a onclick="showForm('dep')">
            <h6 id="dep_subt" class="title3">Agregar dependiente</h6>
            <p id="icn-dep" class="icn-sct"><i class="fa fa-plus fa-icon"></i></p>
        </a>
    </div>
</div>
<div id="div-dep" style="display:none">
    <form method="POST" action="{{ action('DependentController@store') }}" role="form" id="dependent_form">
        @csrf
        <input type="hidden" name="_method" id="dependent_method">
        <input type="hidden" name="dependent_id" id="dependent_id" value="{{ old('dependent_id') }}">
        <div class="fila">
            <div class="columna columna-3">
                <label>{{ __('Nombre completo*') }}</label>
                <input type="text" name="dependent_fullname" id="dependent_fullname" maxlength="50" value="{{ old('dependent_fullname') }}" onkeypress="return checkName(event)" required>
            </div>
            <div class="columna columna-3">
                <label>{{ __('Vínculo familiar*') }}</label>
                @inject('dependentTypes','App\Services\DependentTypes')
                <select name="dependent_type_id" id="dependent_type_id" required>
                    <option selected disabled hidden value="">{{ __('Selecciona un vínculo familiar') }}</option>
                    @foreach ($dependentTypes->get() as $index => $dependentType)
                    <option value="{{ $index }}" {{ old('dependent_type_id') == $index ? 'selected' : '' }}>
                        {{ $dependentType }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="columna columna-3">
                <label>{{ __('Fecha de nacimiento*') }}</label>
                <input type="date" name="dependent_birthdate" id="dependent_birthdate" max="{{ Carbon\Carbon::today()->toDateString() }}" value="{{ old('dependent_birthdate') }}" required>
            </div>
        </div>
        <div class="fila">
            <div class="columna columna-3">
                <label>{{ __('Tipo de documento*') }}</label>
                @inject('documentTypes','App\Services\DocumentTypes')
                <select name="dependent_document_type_id" id="dependent_document_type_id" required>
                    <option selected disabled hidden value="">{{ __('Selecciona un tipo de documento') }}</option>
                    @foreach ($documentTypes->get() as $index => $documentType)
                    @if ($documentType['code'] !== '06')
                    <option value="{{ $index }}" {{ old('dependent_document_type_id') == $index ? 'selected' : '' }}>
                        {{ $documentType['name'] }}
                    </option>
                    @endif
                    @endforeach
                </select>
            </div>
            <div class="columna columna-6">
                <label>{{ __('N° Documento*') }}</label>
                <input type="hidden" name="dependent_doc_pattern" id="dependent_doc_pattern" value="{{ old('dependent_doc_pattern') }}">
                <input type="text" name="dependent_document" id="dependent_document" value="{{ old('dependent_document') }}" onkeyup="return mayusculas(this)" disabled required>
            </div>
            <div class="columna columna-6">
                <label>{{ __('Género*') }}</label>
                @inject('genders','App\Services\Genders')
                <select name="dependent_gender_id" id="dependent_gender_id" required>
                    <option selected disabled hidden value="">{{ __('Selecciona') }}</option>
                    @foreach ($genders->get() as $index => $gender)
                    <option value="{{ $index }}" {{ old('dependent_gender_id') == $index ? 'selected' : '' }}>
                        {{ $gender }}
                    </option>
                    @endforeach
                </select>					
            </div>
        </div>
        <div class="fila">
            <div class="columna columna-1">
                <div class="span-fail" id="dependent_fail_div"><span id="dependent_fail_msg"></span></div>
            </div>
        </div>
        <div class="fila">
            <div class="space"></div>
            <div class="columna columna-1">
                <center>
                <button id="dependent_submit" type="submit" class="btn-effie"><i class="fa fa-plus-circle"></i>&nbsp;{{ __('Agregar') }}</button>
                <a onclick="clearForm()" class="btn-effie-inv"><i class="fa fa-paint-brush"></i>&nbsp;{{ __('Limpiar') }}</a>
                </center>
            </div>
        </div>
    </form>
</div>
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
                <th width="15%">{{ __('Vínculo familiar') }}</th>
                <th width="15%">{{ __('Tipo de documento') }}</th>
                <th width="15%">{{ __('N° Documento') }}</th>
                <th width="15%">{{ __('F. Nacimiento') }}</th>
                <th width="10%">{{ __('Género') }}</th>
                <th width="5%">{{ __('Editar') }}</th>
                <th width="5%">{{ __('Borrar') }}</th>
            </thead>
            <tbody>
                @foreach ($dependents as $index => $dependent)
                <tr>
                    <td>{{ $dependent['fullname'] }}</td>
                    <td><center>{{ $dependent['type'] }}</center></td>
                    <td><center>{{ $dependent['document_type'] }}</center></td>
                    <td><center>{{ $dependent['document'] }}</center></td>
                    <td><center>{{ Carbon\Carbon::parse($dependent['birthdate'])->format('d/m/Y') }}</center></td>
                    <td><center>{{ $dependent['gender'] }}</center></td>
                    <td><center><a name="{{ $index }}" onclick="editDependent(this)"><i class="fa fa-edit"></i></a></center></td>
                    <td><center><a name="{{ $index }}" onclick="removeDependent(this)"><i class="fa fa-trash"></i></a></center></td>
                </tr>
                @endforeach
            </tbody>			
        </table>
    </div>
    <div class="columna columna-1">
		<div class="space"></div>
	</div>
</div>