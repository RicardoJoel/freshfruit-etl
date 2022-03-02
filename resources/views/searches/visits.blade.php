<div class="modal fade" id="mdl-sch-visit" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">x</button>
                <h3 class="modal-title">{{ __('Visitas sin propuesta asignada') }}</h3>
            </div>
            <div class="modal-body">
                <form method="GET" action="{{ route('visits.searchByFilter') }}" id="frm-sch-visit">
                    <input type="hidden" name="visit_cust_id" id="visit_cust_id">
                    <input type="hidden" id="visit_cust_code">
                    <input type="hidden" id="visit_cust_ruc">
                    <div class="fila">
                        <div class="columna columna-2">
                            <p>{{ __('Cliente') }}</p>
							<input type="text" id="visit_cust_name" readonly>
						</div>
                        <div class="columna columna-4">
                            <p>{{ __('Cod. Visita') }}</p>
                            <input type="text" name="visit_code" id="visit_code" maxlength="8" onkeypress="return checkAlNum(event)" onkeyup="return mayusculas(this)">
                        </div>
                        <div class="columna columna-4">
                            <p>{{ __('Cod. Propuesta') }}</p>
                            <input type="text" name="visit_prop_code" id="visit_prop_code" maxlength="15" onkeypress="return checkAlNum(event)" onkeyup="return mayusculas(this)">
                        </div>
                    </div>
                    <div class="fila">
                        <div class="columna columna-4">
                            <p>{{ __('Tipo de proyecto') }}</p>
							@inject('projectTypes','App\Services\ProjectTypes')
							<select name="visit_proj_type_id" id="visit_proj_type_id">
								<option value="">{{ __('Todos los tipos') }}</option>
								@foreach ($projectTypes->get() as $index => $projectType)
								<option value="{{ $index }}">
									{{ $projectType }}
								</option>
								@endforeach
							</select>
						</div>
                        <div class="columna columna-4">
                            <p>{{ __('Fecha de visita') }}</p>
							<input type="date" name="visit_happen_at" id="visit_happen_at">
                        </div>
                        <div class="columna columna-2">
                            <p>{{ __('Responsable') }}</p>
                            <input type="text" name="visit_user_name" id="visit_user_name" maxlength="100" onkeypress="return checkName(event)">
						</div>
                    </div>
                    <div class="fila">
                        <div class="columna columna-1">
                            <div class="span-fail" id="fail-div-visit"><span id="fail-msg-visit"></span></div>
                        </div>
                    </div>
                    <div class="fila">
                        <div class="space"></div>
                        <center>
                        <button type="submit" class="btn-effie"><i class="fa fa-search"></i>&nbsp;{{ __('Buscar') }}</button>
                        <a onclick="clearFormVisit()" class="btn-effie-inv"><i class="fa fa-paint-brush"></i>&nbsp;{{ __('Limpiar') }}</a>
                        </center>
                    </div>
                </form>
                <div class="fila">
                    <div class="space"></div>
                    <h6 class="title3">{{ __('Resultado de la búsqueda') }}</h6>
                </div>
                <div class="fila">
                    <table id="tbl-visits" class="tablealumno" style="width:100%">
                        <thead>
                            <th width="16%">{{ __('Código') }}</th>
                            <th width="16%">{{ __('Tipo') }}</th>
                            <th width="16%">{{ __('Responsable') }}</th>
                            <th width="16%">{{ __('Fecha') }}</th>
                            <th width="16%">{{ __('Cod. Propuesta') }}</th>
                            <th width="16%">{{ __('Observación') }}</th>
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
                <button class="btn-effie" data-dismiss="modal" onclick="sendOnlyCust()"><i class="fa fa-exclamation"></i>&nbsp;{{ __('Sin visita') }}</button>
                <button class="btn-effie-inv" data-dismiss="modal" onclick="$('#mdl-sch-cust').modal('show');"><i class="fa fa-reply"></i>&nbsp;{{ __('Atrás') }}</button>
                <button class="btn-effie-inv" data-dismiss="modal">{{ __('Cerrar') }}</button>
                </center>
            </div>
        </div>
    </div>
</div>