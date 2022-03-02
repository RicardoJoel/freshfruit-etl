<div id="tabmar" class="tabcontent" style="display:block">
    <div class="fila">
        <div class="columna columna-1">
            <div class="span-fail" id="div-span-mar"><span id="msj-rqst-mar"></span></div>
        </div>
    </div>
    <div class="fila">
        <div class="columna columna-1">
            <a onclick="showForm('mar')">
                <h6 id="mar_subt" class="title3">Filtros de búsqueda</h6>
                <p id="icn-mar" class="icn-sct"><i class="fa fa-minus fa-icon"></i></p>
            </a>
        </div>
    </div>
    <div id="div-mar">
        <form method="GET" action="{{ route('maritimo.load') }}" id="frm-mar">
            <input type="hidden" name="mar_rewrite" id="mar_rewrite" value="0">
            <div class="fila">
                <div class="columna columna-4">
                    <label>Rango de fecha</label>
                </div>
                <div class="columna columna-4">
                    <input type="date" name="mar_fecIni" id="mar_fecIni" value="{{ old('mar_fecIni', Carbon\Carbon::yesterday()->yesterday()->toDateString()) }}" required>
                </div>
                <div class="columna columna-10">
                    <label>al</label>
                </div>
                <div class="columna columna-4">
                    <input type="date" name="mar_fecFin" id="mar_fecFin" value="{{ old('mar_fecFin', Carbon\Carbon::yesterday()->yesterday()->toDateString()) }}" required>
                </div>
            </div>
            <div class="fila">
                <div class="columna columna-4">
                    <label>Descripción de la nave</label>
                </div>
                <div class="columna columna-4">
                    <input type="text" name="mar_nave" id="mar_nave" value="{{ old('mar_nave') }}">
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
            <table id="tbl-mar" class="tablealumno">
                <thead>
                    <th style="width:20%">Manifiesto</th>
                    <th style="width:10%">Fecha de zarpe</th>
                    <th style="width:20%">Empresa</th>
                    <th style="width:20%">Nave</th>
                    <th style="width:10%">Conocimientos</th>
                    <th style="width:10%">Detalles</th>
                    <th style="width:10%">Contenedores</th>
                </thead>
                <tfoot>
                    <th colspan="4">Total página / Total general :</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tfoot>
            </table>
        </div>
    </div>
</div>