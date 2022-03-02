<div class="modal fade" id="mdl-note-apv" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">x</button>
                <h3 class="modal-title">Propuesta no editable</h3>
            </div>
            <div class="modal-body">
                <input type="hidden" id="aux-id">
                <div class="space"></div>
                <center><i class="fa fa-exclamation-triangle fa-4x fa-icon"></i></center>
                <div class="space"></div>
                <div class="fila">
                    <div class="columna columna-1">
                        <p>La propuesta seleccionada tiene el estado <b>APROBADO</b> y no puede ser editada. Puedes ver el detalle de la propuesta haciendo click en el botón de abajo.</p>
                    </div>
                </div>
                <div class="space"></div>
                <div class="fila">
                    <div class="columna columna-1">
                        <center><button onclick="location.href='proposals/'+$('#aux-id').val()" class="btn-effie" style="width:100%">Ver detalle de la propuesta</button></center>
                    </div>
                </div>
                <div class="space3"></div>
            </div>
        </div>
    </div>
</div>