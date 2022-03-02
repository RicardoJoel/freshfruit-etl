<div class="modal fade" id="mdl-note-rjt" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">x</button>
                <h3 class="modal-title">Confirmación previa</h3>
            </div>
            <div class="modal-body">
                <input type="hidden" id="aux-id">
                <div class="space"></div>
                <center><i class="fa fa-exclamation-triangle fa-4x fa-icon"></i></center>
                <div class="space"></div>
                <div class="fila">
                    <div class="columna columna-1">
                        <p>La propuesta seleccionada tiene el estado <b>RECHAZADO</b>. Puedes ver el detalle de la propuesta o crear una nueva versión de ella.</p>
                    </div>
                </div>
                <div class="space"></div>
                <div class="fila">
                    <div class="columna columna-1">
                        <center><button onclick="location.href='proposals/'+$('#aux-id').val()" class="btn-effie" style="width:100%">Ver detalle de la propuesta</button></center>
                    </div>
                </div>
                <div class="space"></div>
                <div class="fila">
                    <div class="columna columna-1">
                        <center><a onclick="location.href='proposals/'+$('#aux-id').val()+'/createVersion'" data-dismiss="modal">Crear nueva versión</a></center>
                    </div>
                </div>
                <div class="space3"></div>
            </div>
        </div>
    </div>
</div>