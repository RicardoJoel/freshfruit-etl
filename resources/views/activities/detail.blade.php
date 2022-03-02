<div class="modal fade" id="mdl-detail" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">x</button>
                <h3 class="modal-title">Detalle de actividades</h3>
            </div>
            <div class="modal-body">
                <div class="fila nivelado">
                    <div class="columna columna-10">
                        <i class="fa fa-briefcase fa-2x fa-icon"></i>
                    </div>
                    <div class="columna columna-10c">
                        <p><b>Cliente:</b></p><p id="txt-customer"></p>
                    </div>
                </div>
                <div class="fila nivelado">
                    <div class="columna columna-10">
                        <i class="fa fa-sitemap fa-2x fa-icon"></i>
                    </div>
                    <div class="columna columna-10c">
                        <p><b>Proyecto:</b></p><p id="txt-project"></p>
                    </div>
                </div>
                <div class="fila nivelado">
                    <div class="columna columna-10">
                        <i class="fa fa-user fa-2x fa-icon"></i>
                    </div>
                    <div class="columna columna-10c">
                        <p><b>Colaborador:</b></p><p id="txt-user"></p>
                    </div>
                </div>
                <div class="space"></div>
                <table id="tbl-detail" class="tablealumno" style="width:100%">
                    <thead>
                        <th width="10%">Inicio</th>
                        <th width="10%">Término</th>
                        <th width="20%">Tiempo</th>
                        <th width="30%">Descripción</th>
                        <th width="30%">Comentario</th>
                        <th></th>
                    </thead>
                    <tfoot>
                        <tr>
                            <th colspan="2">Total página:</th>
                            <th colspan="3" style="text-align:left"></th>
                        </tr>
                    </tfoot>
                </table>
                <div class="space3"></div>
            </div>
            <div class="modal-footer">
                <center><button class="btn-effie-inv" data-dismiss="modal">Cerrar</button></center>
            </div>
        </div>
    </div>
</div>