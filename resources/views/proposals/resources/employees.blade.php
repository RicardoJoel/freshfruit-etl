<div id="tabemp" class="tabcontent" style="display:block">
    <div class="fila">
        <div class="columna columna-1">
            <a onclick="showForm('emp')">
                <h6 id="emp_subt" class="title3">{{ __('Nuevo colaborador') }}</h6>
                <p id="icn-emp" class="icn-sct"><i class="fa fa-plus fa-icon"></i></p>
            </a>
        </div>
    </div>
    <div id="div-emp" style="display:none">
        <form method="POST" action="{{ action('EmployeeController@store') }}" role="form" id="emp_form">
            @csrf
            <input type="hidden" name="_method" id="emp_method">
            <input type="hidden" name="emp_id" id="emp_id" value="{{ old('emp_id') }}">
            <div class="fila">
                <div class="columna columna-3">
                    <p>{{ __('Perfil*') }}</p>
                    @inject('profiles','App\Services\Profiles')
                    <select name="emp_profile_id" id="emp_profile_id" required>
                        <option selected disabled hidden value="">{{ __('Selecciona un perfil') }}</option>
                        @foreach ($profiles->get('C') as $index => $profile)
                        <option value="{{ $index }}" {{ old('emp_profile_id') == $index ? 'selected' : '' }}>
                            {{ $profile }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="columna columna-3">
                    <p>{{ __('Detalle') }}</p>
                    <input type="text" name="emp_detail" id="emp_detail" value="{{ old('emp_detail') }}" maxlength="50" onkeypress="return checkText(event)">
                </div>
                <div class="columna columna-9">
                    <p>{{ __('Costo x hr*') }}</p>
                    <input type="number" name="emp_hourly_rate" id="emp_hourly_rate" value="{{ old('emp_hourly_rate') }}" max="1000" step="any" required>
                </div>
                <div class="columna columna-9">
                    <p>{{ __('N° Horas*') }}</p>
                    <input type="number" name="emp_num_hours" id="emp_num_hours" value="{{ old('emp_num_hours') }}" max="1000" step="1" required>
                </div>
                <div class="columna columna-9">
                    <p>{{ __('Subt. (PEN)') }}</p>
                    <input type="text" name="emp_subtotal" id="emp_subtotal" value="{{ old('emp_subtotal') }}" readonly>					
                </div>
            </div>
            <div class="fila">
                <div class="columna columna-1">
                    <div class="span-fail" id="emp_fail_div"><span id="emp_fail_msg"></span></div>
                </div>
            </div>
            <div class="fila">
                <div class="space"></div>
                <div class="columna columna-1">
                    <center>
                    <button id="emp_submit" type="submit" class="btn-effie"><i class="fa fa-plus-circle"></i>&nbsp;{{ __('Agregar') }}</button>
                    <a onclick="clearFormEmp()" class="btn-effie-inv"><i class="fa fa-paint-brush"></i>&nbsp;{{ __('Limpiar') }}</a>
                    </center>
                </div>
            </div>
        </form>
    </div>
    <div class="fila">
        <div class="space"></div>
        <div class="columna columna-1">
            <h6 class="title3">{{ __('Colaboradores agregados') }}</h6>
        </div>
    </div>
    <div class="fila">
        <div class="columna columna-1">
            <table id="tbl-employees" class="tablealumno">
                <thead>
                    <th width="30%">{{ __('Perfil') }}</th>
                    <th width="20%">{{ __('Detalle') }}</th>
                    <th width="20%">{{ __('Costo x hr') }}</th>
                    <th width="10%">{{ __('N° Horas') }}</th>
                    <th width="10%">{{ __('Subt. (PEN)') }}</th>
                    <th width="5%">{{ __('Editar') }}</th>
                    <th width="5%">{{ __('Borrar') }}</th>
                </thead>
                <tbody>
                    @foreach ($employees as $index => $emp)
                    <tr>
                        <td>{{ $emp['profile'] }}</td>
                        <td>{{ $emp['detail'] }}</td>
                        <td><center>{{ $emp['hourly_rate'] ? number_format($emp['hourly_rate'],2) : '' }}<center></td>
                        <td><center>{{ $emp['num_hours'] }}</center></td>
                        <td><center>{{ $emp['subtotal'] ? number_format($emp['subtotal'],2) : '' }}<center></td>
                        <td><center><a name="{{ $index }}" onclick="editEmployee(this)"><i class="fa fa-edit"></i></a></center></td>
                        <td><center><a name="{{ $index }}" onclick="removeEmployee(this)"><i class="fa fa-trash"></i></a></center></td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4" style="text-align:right">{{ __('Total (PEN):') }}</th>
                        <th colspan="1"><center></center></th>
                        <th colspan="2"></th>
                    </tr>
                </tfoot>			
            </table>
        </div>
    </div>
</div>