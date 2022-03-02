$(function() {
    let tblCon = $('#tbl-con').DataTable({
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
        ordering: false,
        footerCallback: function () {
            var api = this.api();
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,<center></center>]/g, '')*1 :
                    typeof i === 'number' ? i : 0;
            };
 
            // Total over all pages
            totCnmt = api
                .column( 5 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pgTotCnmt = api
                .column( 5, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 5 ).footer() ).html(
                pgTotCnmt + ' / ' + totCnmt
            );

            // Total over all pages
            totDet = api
                .column( 6 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pgTotDet = api
                .column( 6, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 6 ).footer() ).html(
                pgTotDet + ' / ' + totDet
            );
        }
    });

    $('#frm-con').submit(function(e) {
        e.preventDefault();
        $('body').loadingModal({
            text:'Un momento, por favor...',
            animation:'wanderingCubes'
        });
        $.ajax({
            type: 'get',
            url: $(this).attr('action'), 
            data: $(this).serialize(),
            success: function(data) {
                $('body').loadingModal('destroy');
                if (data.count) {
                    $('#txt-confirm').text(data.message);
                    $('#txt-chek').val('#con_rewrite');
                    $('#txt-form').val('#frm-con');
                    $('#mdl-confirm').modal('show');
                }
                else {
                    var dataSet = [];
                    $(JSON.parse(data)).each(function() {
                        dataSet.push([
                            '<center>' + this.tipo_man + '</center>',
                            '<center>' + this.manifiesto + '</center>',
                            '<center>' + moment(this.fecha_salida).format('L') + '</center>',
                            this.empresa,
                            '<center>' + this.nave + '</center>',
                            '<center>' + this.nro_conocimientos + '</center>',
                            '<center>' + this.nro_detalles + '</center>',
                        ]);
                    });
                    tblCon.rows.add(dataSet).draw();
                }
                $('#div-span-con').css('display','none');
                $('#con_rewrite').val(0);
            },
            error: function(msg) {
                $('body').loadingModal('destroy');
                /*var message = '<p><b>¡Atención!</b></p><ul>';
                $.each(msg.responseJSON['errors'], function() { message += addItem(this); });
                $('#msj-rqst-con').html(message + '</ul>');*/
                $('#msj-rqst-con').html(JSON.stringify(msg));
                $('#div-span-con').css('display','block');
            }
        });
    });
});