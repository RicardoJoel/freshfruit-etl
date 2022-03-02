<div id="tabsel" class="tabcontent" style="display:none">
    <div class="fila">
        <div class="columna columna-1">
            <a onclick="showForm('sel')">
                <h6 id="sel_subt" class="title3">{{ __('Nuevo vendedor') }}</h6>
                <p id="icn-sel" class="icn-sct"><i class="fa fa-plus fa-icon"></i></p>
            </a>
        </div>
    </div>
    <div id="div-sel" style="display:none">
        <form method="POST" action="{{ action('SellerController@store') }}" role="form" id="sel_form">
            @csrf
            <input type="hidden" name="_method" id="sel_method">
            <input type="hidden" name="sel_id" id="sel_id" value="{{ old('sel_id') }}">
            <div class="fila">
                <div class="columna columna-3">
                    <p>{{ __('Nombre completo*') }}</p>
                    @inject('users','App\Services\Users')
                    <select name="sel_user_id" id="sel_user_id" required>
                        <option selected disabled hidden value="">{{ __('Selecciona un vendedor') }}</option>
                        @foreach ($users->getSellers() as $index => $user)
                        <option value="{{ $index }}" {{ old('sel_user_id') == $index ? 'selected' : '' }}>
                            {{ $user }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="columna columna-8">
                    <p>{{ __('Código') }}</p>
                    <input type="text" name="sel_code" id="sel_code" value="{{ old('sel_code') }}" readonly>					
                </div>
                <div class="columna columna-3">
                    <p>{{ __('Detalle') }}</p>
                    <input type="text" name="sel_detail" id="sel_detail" value="{{ old('sel_detail') }}" maxlength="50" onkeypress="return checkText(event)">
                </div>
                <div class="columna columna-8">
                    <p>{{ __('Comisión (%)') }}</p>
                    <input type="text" name="sel_commission" id="sel_commission" value="{{ old('sel_commission') }}" readonly>					
                </div>
            </div>
            <div class="fila">
                <div class="columna columna-1">
                    <div class="span-fail" id="sel_fail_div"><span id="sel_fail_msg"></span></div>
                </div>
            </div>
            <div class="fila">
                <div class="space"></div>
                <div class="columna columna-1">
                    <center>
                    <button id="sel_submit" type="submit" class="btn-effie"><i class="fa fa-plus-circle"></i>&nbsp;{{ __('Agregar') }}</button>
                    <a onclick="clearFormSel()" class="btn-effie-inv"><i class="fa fa-paint-brush"></i>&nbsp;{{ __('Limpiar') }}</a>
                    </center>
                </div>
            </div>
        </form>
    </div>
    <div class="fila">
        <div class="space"></div>
        <div class="columna columna-1">
            <h6 class="title3">{{ __('Vendedores agregados') }}</h6>
        </div>
    </div>
    <div class="fila">
        <div class="columna columna-1">
            <table id="tbl-sellers" class="tablealumno">
                <thead>
                    <th width="40%">{{ __('Nombre completo') }}</th>
                    <th width="10%">{{ __('Código') }}</th>
                    <th width="30%">{{ __('Detalle') }}</th>
                    <th width="10%">{{ __('Comisión (%)') }}</th>
                    <th width="5%">{{ __('Editar') }}</th>
                    <th width="5%">{{ __('Borrar') }}</th>
                </thead>
                <tbody>
                    @foreach ($sellers as $index => $sel)
                    <tr>
                        <td>{{ $sel['user'] }}</td>
                        <td>{{ $sel['code'] }}</td>
                        <td>{{ $sel['detail'] }}</td>
                        <td><center>{{ $sel['commission'] ? number_format($sel['commission'],2) : '' }}</center></td>
                        <td><center><a name="{{ $index }}" onclick="editSeller(this)"><i class="fa fa-edit"></i></a></center></td>
                        <td><center><a name="{{ $index }}" onclick="removeSeller(this)"><i class="fa fa-trash"></i></a></center></td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3" style="text-align:right">{{ __('Total (%):') }}</th>
                        <th colspan="1"><center></center></th>
                        <th colspan="2"></th>
                    </tr>
                </tfoot>			
            </table>
        </div>
    </div>
</div>