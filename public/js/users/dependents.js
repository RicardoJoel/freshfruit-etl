$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')     
    }
});

let tblDep = $('#tbl-dependents').DataTable({
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

var pre = $('#_method').val() ? '../' : '';

$(function() {
    $('#dependent_form').submit(function(e) {
        e.preventDefault();
        $('body').loadingModal({
            text:'Un momento, por favor...',
            animation:'wanderingCubes'
        });
        $.post($(this).attr('action'), $(this).serialize())
        .done(function(data) {
            tblDep.clear().draw();
            let dataSet = [];
            $(JSON.parse(data)).each(function(index) {
                dataSet.push([
                    this.fullname,
                    '<center>' + this.type + '</center>',
                    '<center>' + this.document_type + '</center>',
                    '<center>' + this.document + '</center>',
                    '<center>' + dateFormat(this.birthdate) + '</center>',
                    '<center>' + this.gender + '</center>',
					'<center><a name="' + index + '" onclick="editDependent(this)"><i class="fa fa-edit"></i></a></center>',
                    '<center><a name="' + index + '" onclick="removeDependent(this)"><i class="fa fa-trash"></i></a></center>'
                ]);
            });
            tblDep.rows.add(dataSet).draw();
            $('body').loadingModal('destroy');
            $('#div-lst').css('display','block');
            $('#icn-lst').html('<i class="fa fa-minus fa-icon"></i>');
            clearForm();
        })
        .fail(function(msg) {
            $('body').loadingModal('destroy');
            let message = '<b>¡Atención!</b><ul>';
            $.each(msg.responseJSON['errors'], function() {
                message += addItem(this);
            });
            message += '</ul>';
            $('#dependent_fail_msg').html(message);
            $('#dependent_fail_div').css('display','block');
        });
    });
});

function editDependent(e) {
    $('body').loadingModal({
        text:'Un momento, por favor...',
        animation:'wanderingCubes'
    });
    $.ajax({
        type: 'get',
        url: pre + '../dependents/' + e.name + '/edit',
        success: function(data) {
            let item = JSON.parse(data);
            $('#dependent_id').val(item.id);
            $('#dependent_fullname').val(item.fullname);
            $('#dependent_type_id').val(item.type_id);
            $('#dependent_birthdate').val(item.birthdate);
            $('#dependent_document_type_id').val(item.document_type_id);
            $('#dependent_document').val(item.document);
            $('#dependent_gender_id').val(item.gender_id);
            $('#dependent_method').val('PATCH');
            $('#dependent_submit').text('Actualizar');
            $('#dependent_form').attr('action',pre + '../dependents/' + e.name);
            $('#subtitle').text('Editar dependiente');
            $('#dependent_fail_msg').text('');
            $('#dependent_fail_div').css('display','none');
            $('#div-dep').css('display','block');
		    $('#icn-dep').html('<i class="fa fa-minus fa-icon"></i>');
            $('body').loadingModal('destroy');
            setDepDocFormat();
            animacion();
        },
        error: function(msg) {
            $('body').loadingModal('destroy');
            $('#dependent_fail_msg').text(JSON.stringify(msg.responseJSON['errors']));
            $('#dependent_fail_div').css('display', 'block');
        }
    });
}

function removeDependent(e) {
	if (confirm('¿Realmente desea eliminar el dependiente seleccionado?')) {
		$('body').loadingModal({
			text:'Un momento, por favor...',
			animation:'wanderingCubes'
		});
		$.ajax({
			type: 'delete',
			url: pre + '../dependents/' + e.name,
			success: function(data) {
				tblDep.clear().draw();
				let dataSet = [];			
				$(JSON.parse(data)).each(function(index) {
					dataSet.push([
                        this.fullname,
                        '<center>' + this.type + '</center>',
                        '<center>' + this.document_type + '</center>',
                        '<center>' + this.document + '</center>',
                        '<center>' + dateFormat(this.birthdate) + '</center>',
                        '<center>' + this.gender + '</center>',
						'<center><a name="' + index + '" onclick="editDependent(this)"><i class="fa fa-edit"></i></a></center>',
						'<center><a name="' + index + '" onclick="removeDependent(this)"><i class="fa fa-trash"></i></a></center>'
					]);
				});
				tblDep.rows.add(dataSet).draw();
                $('#dependent_fail_msg').text('');
                $('#dependent_fail_div').css('display','none');
				$('body').loadingModal('destroy');
                clearForm();
			},
			error: function(msg) {
                $('body').loadingModal('destroy');
                $('#dependent_fail_msg').text(JSON.stringify(msg.responseJSON['errors']));
                $('#dependent_fail_div').css('display', 'block');
			}
		});
	}
}

function clearForm() {
    $('#dependent_id').val('');
    $('#dependent_fullname').val('');
    $('#dependent_type_id').val('');
    $('#dependent_birthdate').val('');  
    $('#dependent_document_type_id').val('');
    $('#dependent_document').val('');
    $('#dependent_gender_id').val('');
    $('#dependent_method').val('');
    $('#dependent_submit').text('Agregar');
    $('#dependent_form').attr('action',pre + '../dependents');
    $('#subtitle').text('Agregar dependiente');
    $('#dependent_fail_msg').text('');
    $('#dependent_fail_div').css('display','none');
}