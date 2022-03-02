<div class="modal fade" id="mdl-sch-prop" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">x</button>
                <h3 class="modal-title">{{ __('Propuestas aprobadas sin proyecto asignado') }}</h3>
            </div>
            <div class="modal-body">
                <form method="GET" action="{{ route('proposals.searchByFilter') }}" id="frm-sch-prop">
                    <input type="hidden" name="prop_cust_id" id="prop_cust_id">
                    <input type="hidden" id="prop_cust_code">
                    <input type="hidden" id="prop_cust_ruc">
                    <div class="fila">
                        <div class="columna columna-2">
                            <p>{{ __('Cliente') }}</p>
							<input type="text" id="prop_cust_name" readonly>
						</div>
                        <div class="columna columna-4">
                            <p>{{ __('Tipo de proyecto') }}</p>
							@inject('projectTypes','App\Services\ProjectTypes')
							<select name="prop_proj_type_id" id="prop_proj_type_id">
								<option value="">{{ __('Todos los tipos') }}</option>
								@foreach ($projectTypes->get() as $index => $projectType)
								<option value="{{ $index }}">
									{{ $projectType }}
								</option>
								@endforeach
							</select>
						</div>
                        <div class="columna columna-4">
                            <p>{{ __('Código') }}</p>
                            <input type="text" name="prop_cod" id="prop_cod" maxlength="8" onkeypress="return checkAlNum(event)" onkeyup="return mayusculas(this)">
                        </div>
                    </div>
                    <div class="fila">
                        <div class="columna columna-2">
                            <p>{{ __('Nombre') }}</p>
                            <input type="text" name="prop_name" id="prop_name" maxlength="100" onkeypress="return checkText(event)">
						</div>
                        <div class="columna columna-4">
                            <p>{{ __('Fecha de inicio') }}</p>
                            <input type="date" name="prop_happen_at" id="prop_happen_at">
						</div>
                        <div class="columna columna-4">
                            <p>{{ __('Responsable') }}</p>
                            <input type="text" name="prop_user_name" id="prop_user_name" maxlength="100" onkeypress="return checkName(event)">
						</div>
                    </div>
                    <div class="fila">
                        <div class="columna columna-1">
                            <div class="span-fail" id="fail-div-prop"><span id="fail-msg-prop"></span></div>
                        </div>
                    </div>
                    <div class="fila">
                        <div class="space"></div>
                        <center>
                        <button type="submit" class="btn-effie"><i class="fa fa-search"></i>&nbsp;{{ __('Buscar') }}</button>
                        <a onclick="clearFormProp()" class="btn-effie-inv"><i class="fa fa-paint-brush"></i>&nbsp;{{ __('Limpiar') }}</a>
                        </center>
                    </div>
                </form>
                <div class="fila">
                    <div class="space"></div>
                    <h6 class="title3">{{ __('Resultado de la búsqueda') }}</h6>
                </div>
                <div class="fila">
                    <table id="tbl-proposals" class="tablealumno" style="width:100%">
                        <thead>
                            <th width="16%">{{ __('Código') }}</th>
                            <th width="16%">{{ __('Tipo') }}</th>
                            <th width="16%">{{ __('Nombre y versión') }}</th>
                            <th width="16%"></th>
                            <th width="16%">{{ __('Responsable') }}</th>
                            <th width="16%">{{ __('F. Inicio') }}</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <center>
                <button class="btn-effie" data-dismiss="modal" onclick="sendOnlyCust()"><i class="fa fa-exclamation"></i>&nbsp;{{ __('Sin prop.') }}</button>
                <button class="btn-effie-inv" data-dismiss="modal" onclick="$('#mdl-sch-cust').modal('show');"><i class="fa fa-reply"></i>&nbsp;{{ __('Atrás') }}</button>
                <button class="btn-effie-inv" data-dismiss="modal">{{ __('Cerrar') }}</button>
                </center>
            </div>
        </div>
    </div>
</div>