<div class="modal fade" id="mdl-sch-cust" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">x</button>
                <h3 class="modal-title">{{ __('Búsqueda de clientes') }}</h3>
            </div>
            <div class="modal-body">
                <form method="GET" action="{{ route('customers.searchByFilter') }}" id="frm-sch-cust">
                    <div class="fila">
                        <div class="columna columna-3">
                            <p>{{ __('Código') }}</p>
                            <input type="text" name="cust_code" id="cust_code" maxlength="3" onkeypress="return checkAlpha(event)" onkeyup="return mayusculas(this)">
                        </div>
                        <div class="columna columna-3c">
                            <p>{{ __('Razón social') }}</p>
                            <input type="text" name="cust_name" id="cust_name" maxlength="100" onkeypress="return checkText(event)">
                        </div>
                    </div>
                    <div class="fila">
                        <div class="columna columna-3">
                            <p>{{ __('Nombre comercial') }}</p>
                            <input type="text" name="cust_alias" id="cust_alias" maxlength="100" onkeypress="return checkText(event)" onkeyup="return mayusculas(this)">
                        </div>
                        <div class="columna columna-3">
                            <p>{{ __('R. U. C.') }}</p>
                            <input type="text" name="cust_ruc" id="cust_ruc" maxlength="11" onkeypress="return checkNumber(event)">
                        </div>
                        <div class="columna columna-3">
                            <p>{{ __('Rubro de negocio') }}</p>
                            @inject('bussiness','App\Services\Bussiness')
                            <select name="cust_business_id" id="cust_business_id">
                                <option value="">{{ __('Todos los rubros') }}</option>
                                @foreach ($bussiness->get() as $index => $business)
                                <option value="{{ $index }}">{{ $business }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="fila">
                        <div class="columna columna-1">
                            <div class="span-fail" id="fail-div-cust"><span id="fail-msg-cust"></span></div>
                        </div>
                    </div>
                    <div class="fila">
                        <div class="space"></div>
                        <center>
                        <button type="submit" class="btn-effie"><i class="fa fa-search"></i>&nbsp;{{ __('Buscar') }}</button>
                        <a onclick="clearFormCust()" class="btn-effie-inv"><i class="fa fa-paint-brush"></i>&nbsp;{{ __('Limpiar') }}</a>
                        </center>
                    </div>
                </form>
                <div class="fila">
                    <div class="space"></div>
                    <h6 class="title3">{{ __('Resultado de la búsqueda') }}</h6>
                </div>
                <div class="fila">
                    <table id="tbl-customers" class="tablealumno" style="width:100%">
                        <thead>
                            <th width="20%">{{ __('Código') }}</th>    
                            <th width="20%">{{ __('Razón social') }}</th>
                            <th width="20%">{{ __('Nombre comercial') }}</th>    
                            <th width="20%">{{ __('R.U.C.') }}</th>
                            <th width="20%">{{ __('Rubro de negocio') }}</th>
                            <th></th>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <center><button class="btn-effie-inv" data-dismiss="modal">{{ __('Cerrar') }}</button></center>
            </div>
        </div>
    </div>
</div>