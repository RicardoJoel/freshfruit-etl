$(function() {
    $('#tbl-report').DataTable({
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

            // Total over all pages
            totDtll = api
                .column( 6 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            // Total over this page
            pgTotDtll = api
                .column( 6, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

             // Total over all pages
             totCont = api
                .column( 7 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            // Total over this page
            pgTotCont = api
                .column( 7, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            // Update footer
            $( api.column( 5 ).footer() ).html(
                pgTotCnmt + ' / ' + totCnmt
            );
            $( api.column( 6 ).footer() ).html(
                pgTotDtll + ' / ' + totDtll
            );
            $( api.column( 7 ).footer() ).html(
                pgTotCont + ' / ' + totCont
            );
        }
    });
});