<div id="tabaer" class="tabcontent" style="display:none">
    <div class="fila">
        <div class="columna columna-1">
            <div class="span-fail" id="div-span-aer"><span id="msj-rqst-aer"></span></div>
        </div>
    </div>
    <div class="fila">
        <div class="columna columna-1">
            <a onclick="showForm('aer')">
                <h6 id="aer_subt" class="title3">Filtros de búsqueda</h6>
                <p id="icn-aer" class="icn-sct"><i class="fa fa-minus fa-icon"></i></p>
            </a>
        </div>
    </div>
    <div id="div-aer">
        <form method="GET" action="{{ route('aereo.load') }}" id="frm-aer">
            <input type="hidden" name="aer_rewrite" id="aer_rewrite" value="0">
            <div class="fila">
                <div class="columna columna-4">
                    <label>Fecha de salida:</label>
                </div>
                <div class="columna columna-4">
                    <input type="date" name="aer_fecIni" id="aer_fecIni" value="{{ old('aer_fecIni', Carbon\Carbon::yesterday()->yesterday()->toDateString()) }}" required>
                </div>
                <div class="columna columna-10">
                    <label>al</label>
                </div>
                <div class="columna columna-4">
                    <input type="date" name="aer_fecFin" id="aer_fecFin" value="{{ old('aer_fecFin', Carbon\Carbon::yesterday()->yesterday()->toDateString()) }}" required>
                </div>
            </div>   
            <div class="fila">
                <div class="columna columna-4">
                    <label>Código de Terminal</label>
                </div>
                <div class="columna columna-4">
                    <input type="text" name="aer_codTerminal" id="aer_codTerminal" value="{{ old('aer_codTerminal') }}" placeholder="0000 - TODOS">  
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
            <table id="tbl-aer" class="tablealumno">
                <thead>
                    <th style="width:20%">Manifiesto</th>
                    <th style="width:20%">Fecha de salida</th>
                    <th style="width:20%">Aerolínea</th>
                    <th style="width:20%">N° Vuelo</th>
                    <th style="width:10%">Conocimientos</th>
                    <th style="width:10%">Detalles</th>
                </thead>
                <tfoot>
                    <th colspan="4">Total página / Total general :</th>
                    <th></th>
                    <th></th>
                </tfoot>
            </table>
        </div>
    </div>
</div>