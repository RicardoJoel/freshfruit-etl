<div class="modal fade" id="mdl-confirm" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">x</button>
                <h3 class="modal-title">Aviso</h3>
            </div>
            <div class="modal-body">
                <input type="hidden" id="txt-form">
                <input type="hidden" id="txt-chek">
                <p id="txt-confirm"></p>
            </div>
            <div class="modal-footer">
                <center>
                <button class="btn-effie" data-dismiss="modal" onclick="
                    var form = $('#txt-form').val();
                    var chek = $('#txt-chek').val();
                    $(chek).val(1);
                    $(form).submit();">Sí
                </button>
                <button class="btn-effie-inv" data-dismiss="modal">No</button>
                </center>
            </div>
        </div>
    </div>
</div>