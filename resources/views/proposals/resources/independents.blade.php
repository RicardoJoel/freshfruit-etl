<div id="tabfre" class="tabcontent" style="display:none">
    <div class="fila">
        <div class="columna columna-1">
            <a onclick="showForm('fre')">
                <h6 id="fre_subt" class="title3">{{ __('Nuevo independiente') }}</h6>
                <p id="icn-fre" class="icn-sct"><i class="fa fa-plus fa-icon"></i></p>
            </a>
        </div>
    </div>
    <div id="div-fre" style="display:none">
        <form method="POST" action="{{ action('IndependentController@store') }}" role="form" id="fre_form">
            @csrf
            <input type="hidden" name="_method" id="fre_method">
            <input type="hidden" name="fre_id" id="fre_id" value="{{ old('fre_id') }}">
            <input type="hidden" name="fre_rate_id" id="fre_rate_id">
            <input type="hidden" name="fre_rate_date" id="fre_rate_date">
            <input type="hidden" name="fre_rate_value" id="fre_rate_value" value="1">
            <div class="fila">
                <div class="columna columna-3">
                    <p>{{ __('Perfil*') }}</p>
                    @inject('profiles','App\Services\Profiles')
                    <select name="fre_profile_id" id="fre_profile_id" required>
                        <option selected disabled hidden value="">{{ __('Selecciona un perfil') }}</option>
                        @foreach ($profiles->get('I') as $index => $profile)
                        <option value="{{ $index }}" {{ old('fre_profile_id') == $index ? 'selected' : '' }}>
                            {{ $profile }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="columna columna-3">
                    <p>{{ __('Detalle') }}</p>
                    <input type="text" name="fre_detail" id="fre_detail" value="{{ old('fre_detail') }}" maxlength="50" onkeypress="return checkText(event)">
                </div>
                <div class="columna columna-9">
                    <p>{{ __('Moneda*') }}</p>
                    @inject('currencies','App\Services\Currencies')
                    <select name="fre_currency_id" id="fre_currency_id" required>
                        @foreach ($currencies->getCode() as $index => $currency)
                        <option value="{{ $index }}" {{ old('fre_currency_id') == $index ? 'selected' : '' }}>
                            {{ $currency }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="columna columna-9">
                    <p>{{ __('Costo*') }}</p>
                    <input type="number" name="fre_price" id="fre_price" value="{{ old('fre_price') }}" min="0" step="any">
                </div>
                <div class="columna columna-9">
                    <p>{{ __('Subt. (PEN)') }}</p>
                    <input type="text" name="fre_subtotal" id="fre_subtotal" value="{{ old('fre_subtotal') }}" readonly>					
                </div>
            </div>
            <div id="fre_rate_div" class="fila" style="display:none">
                <div class="columna columna-1">
                    <span id="fre_rate_msg" class="lbl-msg"></span>
                </div>
            </div>
            <div class="fila">
                <div class="columna columna-1">
                    <div class="span-fail" id="fre_fail_div"><span id="fre_fail_msg"></span></div>
                </div>
            </div>
            <div class="fila">
                <div class="space"></div>
                <div class="columna columna-1">
                    <center>
                    <button id="fre_submit" type="submit" class="btn-effie"><i class="fa fa-plus-circle"></i>&nbsp;{{ __('Agregar') }}</button>
                    <a onclick="clearFormFre()" class="btn-effie-inv"><i class="fa fa-paint-brush"></i>&nbsp;{{ __('Limpiar') }}</a>
                    </center>
                </div>
            </div>
        </form>
    </div>
    <div class="fila">
        <div class="space"></div>
        <div class="columna columna-1">
            <h6 class="title3">{{ __('Independientes agregados') }}</h6>
        </div>
    </div>
    <div class="fila">
        <div class="columna columna-1">
            <table id="tbl-independents" class="tablealumno">
                <thead>
                    <th width="30%">{{ __('Perfil') }}</th>
                    <th width="20%">{{ __('Detalle') }}</th>
                    <th width="20%">{{ __('Moneda') }}</th>
                    <th width="10%">{{ __('Costo') }}</th>
                    <th width="10%">{{ __('Subt. (PEN)') }}</th>
                    <th width="5%">{{ __('Editar') }}</th>
                    <th width="5%">{{ __('Borrar') }}</th>
                </thead>
                <tbody>
                    @foreach ($independents as $index => $ind)
                    <tr>
                        <td>{{ $ind['profile'] }}</td>
                        <td>{{ $ind['detail'] }}</td>
                        <td><center>{{ $ind['currency'] }}</center></td>
                        <td><center>{{ $ind['price'] ? number_format($ind['price'],2) : '' }}</center></td>
                        <td><center>{{ $ind['subtotal'] ? number_format($ind['subtotal'],2) : '' }}</center></td>
                        <td><center><a name="{{ $index }}" onclick="editIndependent(this)"><i class="fa fa-edit"></i></a></center></td>
                        <td><center><a name="{{ $index }}" onclick="removeIndependent(this)"><i class="fa fa-trash"></i></a></center></td>
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