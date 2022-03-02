$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')     
    }
});

let tblVar = $('#tbl-variations').DataTable({
	language: {
		'decimal': '',
		'emptyTable': 'No hay información para mostrar',
		'info': 'Mostrando _START_ a _END_ de _TOTAL_ entradas',
		'infoEmpty': 'Mostrando 0 to 0 of 0 entradas',
		'infoFiltered': '(Filtrado de _MAX_ total entradas)',
		'infoPostFix': '',
		'thousands': ',',
		'lengthMenu': 'Mostrar _MENU_ entradas',
		'loadingRecords': 'Cargando...',
		'processing': 'Procesando...',
		'search': 'Buscar ',
		'zeroRecords': 'Sin resultados encontrados',
		'paginate': {
			'first': 'Primero',
			'last': 'Último',
			'next': 'Siguiente',
			'previous': 'Anterior'
		}
    },
    ordering: false
});

$(function() {
    $('#variation_form').submit(function(e) {
        e.preventDefault();
        $('body').loadingModal({
            text:'Un momento, por favor...',
            animation:'wanderingCubes'
        });
        $.post($(this).attr('action'), $(this).serialize())
        .done(function(data) {
            tblVar.clear().draw();
            let dataSet = [];
            $(JSON.parse(data)).each(function() {
                dataSet.push([
                    '<center>' + dateFormat(this.created_at) + '</center>',
                    '<center>' + dateFormat(this.start_at) + '</center>',
                    '<center>' + this.type + '</center>',
                    '<center>' + this.before.toLocaleString('en-US') + '</center>',
                    '<center>' + this.amount.toLocaleString('en-US') + '</center>',
                    '<center>' + this.after.toLocaleString('en-US') + '</center>',
                    this.observation
                ]);
            });
            tblVar.rows.add(dataSet).draw();
            $('body').loadingModal('destroy');
            $('#div-sal').css('display','block');
            $('#icn-sal').html('<i class="fa fa-minus fa-icon"></i>');
            /* Ini: registro unico */
            $('#variation_type').prop('disabled',true);
            $('#variation_amount').prop('disabled',true);
            $('#variation_start_at').prop('disabled',true);
            $('#variation_observation').prop('disabled',true);
            $('#variation_submit').prop('disabled',true);
            /* Fin: registro unico */
            clearVarForm();
        })
        .fail(function(msg) {
            $('body').loadingModal('destroy');
            let message = '<b>¡Atención!</b><ul>';
            $.each(msg.responseJSON['errors'], function() {
                message += addItem(this);
            });
            message += '</ul>';
            $('#variation_fail_msg').html(message);
            $('#variation_fail_div').css('display','block');
        });
    });
});

function clearVarForm() {
    $('#variation_type').val('Aumento');
    $('#variation_amount').val('');
    $('#variation_start_at').val('');
    $('#variation_observation').val('');
    $('#variation_fail_msg').text('');
    $('#variation_fail_div').css('display','none');
}