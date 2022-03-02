<div id="tabpro" class="tabcontent" style="display:none">
    <div class="fila">
        <div class="columna columna-1">
            <div class="span-fail" id="div-span-pro"><span id="msj-rqst-pro"></span></div>
        </div>
    </div>
    <div class="fila">
        <div class="columna columna-1">
            <a onclick="showForm('pro')">
                <h6 id="pro_subt" class="title3">Filtros de búsqueda</h6>
                <p id="icn-pro" class="icn-sct"><i class="fa fa-minus fa-icon"></i></p>
            </a>
        </div>
    </div>
    <div id="div-pro">
        <form method="GET" action="{{ route('provincia.load') }}" id="frm-pro">
            <input type="hidden" name="pro_rewrite" id="pro_rewrite" value="0">
            <div class="fila">
                <div class="columna columna-4">
                    <label>Año de Manifiesto</label>
                </div>
                <div class="columna columna-4">
                    <!--input type="text" name="pro_anio" id="pro_anio" value="{{ old('pro_anio',Carbon\Carbon::today()->subDays(3)->format('Y')) }}" required-->
                    <select name="pro_anio" id="pro_anio" value="{{ old('pro_anio') }}" required>
                    @for ($anio=Carbon\Carbon::today()->subDays(3)->format('Y'); $anio>=2019; $anio--)
                        <option value="{{ $anio }}">{{ $anio }}</option>  
                    @endfor
                    </select>   
                </div>   
                <div class="columna columna-4">
                    <label>Número de Manifiesto</label>
                </div>
                <div class="columna columna-4">
                    <input type="text" name="pro_numManifest" id="pro_numManifest" value="{{ old('pro_numManifest') }}">
                </div>
            </div>
            <div class="fila">
                <div class="columna columna-4">
                    <label>Código de Aduana</label>
                </div>
                <div class="columna columna-4">
                    <!-- <input type="text" name="pro_codAduana" id="pro_codAduana" value="{{ old('pro_codAduana') }}">   -->
                    <select class="form-select" name="pro_codAduana" id="pro_codAduana" value="{{ old('pro_codAduana') }}" aria-label="Default select example">
                        <!--option selected>Seleccionar</option-->
                        <option value="">Todos los puertos</option>
                        <option value="046">046 - PAITA</option>
                        <option value="082">082 - SALAVERRY</option>
                        <option value="127">127 - PISCO</option>
                    </select>    
                    <!-- <select class="form-select" aria-label="Default select example">
                        <option selected>Seleccionar</option>
                        <option value="1">019 - TUMBES</option>
                        <option value="2">028 - TALARA</option>
                        <option value="3">046 - PAITA</option>
                        <option value="4">055 - CHICLAYO</option>
                        <option value="5">082 - SALAVERRY</option>
                        <option value="6">091 - CHIMBOTE</option>
                        <option value="7">127 - PISCO</option>
                        <option value="8">145 - MOLLENDO - MATARANI</option>
                        <option value="9">154 - MOLLENDO - AGENCIA</option>
                        <option value="10">163 - ILO</option>
                        <option value="11">163 - TACNA</option>
                        <option value="12">181 - PUNO</option>
                        <option value="13">190 - CUSCO</option>
                        <option value="14">0217 - PUCALLPA</option>
                        <option value="15">226 - IQUITOS</option>
                        <option value="16">244 - AEREA Y POSTAL EX-I</option>
                        <option value="17">262 - DESAGUADERO</option>
                        <option value="18">271 - TARAPOTO</option>
                        <option value="19">280 - PUERTO MALDONADO</option>
                        <option value="20">299 - LA TINA</option>
                        <option value="21">929 - COMPLEJO FRONTERIZO</option>
                        
                    </select> -->
                </div>
                <div class="columna columna-4">
                    <label>Vía de Transporte</label>
                </div>
                <div class="columna columna-4">
                    <input type="text" name="pro_via" id="pro_via" value="{{ old('pro_via') }}" placeholder="1 - MARITIMO" aria-label="Disabled input example" disabled readonly>
                </div>
            </div>
            <div class="fila">
                <div class="space"></div>
                <div class="columna columna-1">
                    <center>
                    <button type="submit" class="btn-effie"><i class="fa fa-spinner"></i>&nbsp;Procesar</button>
                    </center>
                </div>
            </div>
        </form>
    </div>
    <div class="fila">
        <div class="space"></div>
        <div class="columna columna-1">
            <h6 class="title3">Resumen de resultados</h6>
        </div>
    </div>
    <div class="fila">
        <div class="columna columna-1">
            <table id="tbl-pro" class="tablealumno">
                <thead>
                    <th style="width:25%">Manifiesto</th>
                    <th style="width:25%">N° Conocimientos</th>
                    <th style="width:25%">N° Detalles</th>
                    <th style="width:25%">N° Contenedores</th>
                </thead>
                <tfoot>
                    <th>Total página / Total general :</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tfoot>
            </table>
        </div>
    </div>
</div>