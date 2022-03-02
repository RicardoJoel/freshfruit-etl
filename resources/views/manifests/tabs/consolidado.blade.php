<div id="tabcon" class="tabcontent" style="{{ Auth::user()->is_admin ? 'display:none' : 'display:block' }}">
    <div class="fila">
        <div class="columna columna-1">
            <div class="span-fail" id="div-span-con"><span id="msj-rqst-con"></span></div>
        </div>
    </div>    
    <div class="fila">
        <div class="columna columna-1">
            <a onclick="showForm('con')">
                <h6 id="con_subt" class="title3">Filtros de búsqueda</h6>
                <p id="icn-con" class="icn-sct"><i class="fa fa-minus fa-icon"></i></p>
            </a>
        </div>
    </div>
    <div id="div-con">
        <form method="GET" action="{{ route('consolidado.load') }}" id="frm-con">
            <input type="hidden" name="con_rewrite" id="con_rewrite" value="0">
            <div class="fila">
                <div class="columna columna-4">
                    <label>Rango de fecha</label>
                </div>
                <div class="columna columna-4">
                    <input type="date" name="con_fecIni" id="con_fecIni" value="{{ old('con_fecIni', Carbon\Carbon::yesterday()->yesterday()->toDateString()) }}" required>
                </div>
                <div class="columna columna-10">
                    <label>al</label>
                </div>
                <div class="columna columna-4">
                    <input type="date" name="con_fecFin" id="con_fecFin" value="{{ old('con_fecFin', Carbon\Carbon::yesterday()->yesterday()->toDateString()) }}" required>
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
            <table id="tbl-con" class="tablealumno">
                <thead>
                    <th style="width:10%">Tipo</th>
                    <th style="width:10%">Manifiesto</th>
                    <th style="width:20%">Fecha de Salida</th>
                    <th style="width:20%">Empresa</th>
                    <th style="width:20%">Nave</th>
                    <th style="width:10%">Conocimientos</th>
                    <th style="width:10%">Detalles</th>
                </thead>
                <tfoot>
                    <th colspan="5">Total página / Total general :</th>
                    <th></th>
                    <th></th>
                </tfoot>
            </table>
        </div>
    </div>
</div>