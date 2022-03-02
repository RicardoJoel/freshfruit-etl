$(function() {
    let tblPro = $('#tbl-pro').DataTable({
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
            totCono = api
                .column( 1 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            // Total over all pages
            totDeta = api
                .column( 2 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            // Total over all pages
            totCont = api
                .column( 3 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            // Total over this page
            pgTotCono = api
                .column( 1, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            // Total over this page
            pgTotDeta = api
                .column( 2, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            // Total over this page
            pgTotCont = api
                .column( 3, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            // Update footer
            $( api.column( 1 ).footer() ).html(
                pgTotCono + ' / ' + totCono
            );
            $( api.column( 2 ).footer() ).html(
                pgTotDeta + ' / ' + totDeta
            );
            $( api.column( 3 ).footer() ).html(
                pgTotCont + ' / ' + totCont
            );
        }
    });

    $('#frm-pro').submit(function(e) {
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
                    $('#txt-chek').val('#pro_rewrite');
                    $('#txt-form').val('#frm-pro');
                    $('#mdl-confirm').modal('show');
                }
                else {
                    //alert(JSON.stringify(data[0].conocimientos));
                    tblPro.clear().draw();
                    var dataSet = [];
                    $(data).each(function() {
                        dataSet.push([
                            '<center>' + this.manifiesto + '</center>',
                            '<center>' + this.nro_conocimientos + '</center>',
                            '<center>' + this.nro_detalles + '</center>',
                            '<center>' + this.nro_contenedores + '</center>'
                        ]);
                    });
                    tblPro.rows.add(dataSet).draw();
                }
                $('#div-span-pro').css('display','none');
                $('#pro_rewrite').val(0);
            },
            error: function(msg) {
                $('body').loadingModal('destroy');
                /*var message = '<p><b>¡Atención!</b></p><ul>';
                $.each(msg.responseJSON['errors'], function() { message += addItem(this); });
                $('#msj-rqst-pro').html(message + '</ul>');*/
                $('#msj-rqst-pro').html(JSON.stringify(msg));
                $('#div-span-pro').css('display','block');
            }
        });
    });
});