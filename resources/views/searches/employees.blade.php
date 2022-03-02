<div class="modal fade" id="mdl-sch-user" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">x</button>
                <h3 class="modal-title">{{ __('Búsqueda de colaboradores') }}</h3>
            </div>
            <div class="modal-body">
                <form method="GET" action="{{ route('users.searchByFilter') }}" id="frm-sch-user">
                    <div class="fila">
                        <div class="columna columna-3">
                            <p>{{ __('Código') }}</p>
                            <input type="text" name="user_code" id="user_code" maxlength="8" onkeypress="return checkAlNum(event)">
                        </div>
                        <div class="columna columna-3c">
                            <p>{{ __('Nombre completo') }}</p>
                            <input type="text" name="user_name" id="user_name" maxlength="100" onkeypress="return checkName(event)">
                        </div>
                    </div>
                    <div class="fila">
                        <div class="columna columna-3">
                            <p>{{ __('Tipo de documento') }}</p>
                            @inject('documentTypes','App\Services\DocumentTypes')
                            <select name="user_doc_type_id" id="user_doc_type_id">
                                <option value="">{{ __('Todos los tipos') }}</option>
                                @foreach ($documentTypes->get() as $index => $documentType)
                                <option value="{{ $index }}">{{ $documentType['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="columna columna-3">
                            <p>{{ __('N° Documento') }}</p>
                            <input type="text" name="user_doc" id="user_doc" maxlength="15" onkeypress="return checkAlNum(event)">
                        </div>
                        <div class="columna columna-3">
                            <p>{{ __('Correo Preciso') }}</p>
                            <input type="text" name="user_email" id="user_email" maxlength="50" onkeypress="return checkEmail(event)">
                        </div>
                    </div>
                    <div class="fila">
                        <div class="columna columna-1">
                            <div class="span-fail" id="fail-div-user"><span id="fail-msg-user"></span></div>
                        </div>
                    </div>
                    <div class="fila">
                        <div class="space"></div>
                        <center>
                        <button type="submit" class="btn-effie"><i class="fa fa-search"></i>&nbsp;{{ __('Buscar') }}</button>
                        <a onclick="clearFormUser()" class="btn-effie-inv"><i class="fa fa-paint-brush"></i>&nbsp;{{ __('Limpiar') }}</a>
                        </center>
                    </div>
                </form>
                <div class="fila">
                    <div class="space"></div>
                    <h6 class="title3">{{ __('Resultado de la búsqueda') }}</h6>
                </div>
                <div class="fila">
                    <table id="tbl-users" class="tablealumno" style="width:100%">
                        <thead>
                            <th width="20%">{{ __('Código') }}</th>    
                            <th width="20%">{{ __('Nombre completo') }}</th>
                            <th width="20%">{{ __('Tipo') }}</th>
                            <th width="20%">{{ __('N° Documento') }}</th>   
                            <th width="20%">{{ __('Correo Preciso') }}</th>
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