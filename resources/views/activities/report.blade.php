@extends('layouts.app')
@section('content')
<div class="fila">
    <div class="columna columna-1">
        <div class="title2">
            <h6>{{ __('Utilitarios > Reporte de tiempos') }}</h6>
        </div>
    </div>
</div>
<div class="fila">
    <div class="columna columna-1">
        <a onclick="showForm('gen')">
            <h6 id="gen_subt" class="title3">Indicaciones</h6>
            <p id="icn-gen" class="icn-sct"><i class="fa fa-minus fa-icon"></i></p>
        </a>
    </div>
</div>
<div id="div-gen">
    <form method="GET" action="{{ route('activities.generate') }}">
        <input type="hidden" id="aux-project_id" value="{{ $project_id }}">
        <input type="hidden" id="aux-user_id" value="{{ $user_id }}">
        <input type="hidden" id="aux-status" value="{{ $status }}">
        <div class="fila">
            <div class="columna columna-1">
                <p>Al generar el reporte, se mostrará el tiempo total agrupado por cliente, proyecto y colaborador involucrado. Para conocer el detalle de las actividades realizadas por un colaborador debes hacer clic en la fila correspondiente.</p>
            </div>
        </div>
        <div class="fila">
            <div class="space"></div>
            <div class="columna columna-3">
                <p>{{ __('Cliente') }}</p>
                @inject('customers','App\Services\Customers')
                <select id="customer_id" name="customer_id">
                    <option selected value="">{{ __('Todos los clientes') }}</option>
                    @foreach ($customers->get() as $index => $customer)
                    <option value="{{ $index }}" {{ old('customer_id',$customer_id) == $index ? 'selected' : '' }}>
                        {{ $customer }}
                    </option>
                    @endforeach
                </select>					
            </div>
            <div class="columna columna-3">
                <p>{{ __('Proyecto') }}</p>
                <select id="project_id" name="project_id"></select>					
            </div>
            <div class="columna columna-3">
                <p>{{ __('Estado') }}</p>
                <select id="status" name="status"></select>
            </div>
        <div class="fila">
        </div>
            <div class="columna columna-3">
                <p>{{ __('Colaborador') }}</p>
                @if(Auth::user()->is_admin)
                <select id="user_id" name="user_id"></select>
                @else
                <input type="text" id="user_id" value="{{ Auth::user()->fullnameInv }}" disabled>
                @endif	
            </div>
            <div class="columna columna-3">
                <p>{{ __('Fecha inicial') }}</p>
                <input type="date" name="start_at" value="{{ old('start_at',Carbon\Carbon::parse($start_at)->toDateString()) }}" max="{{ Carbon\Carbon::today()->toDateString() }}" required>
            </div>
            <div class="columna columna-3">
                <p>{{ __('Fecha final') }}</p>
                <input type="date" name="end_at" value="{{ old('end_at',Carbon\Carbon::parse($end_at)->toDateString()) }}" max="{{ Carbon\Carbon::today()->toDateString() }}" required>
            </div>
        </div>
    </div>
    <div class="fila">
        <div class="space"></div>
        <div class="columna columna-1">
            <center>
            <button type="submit" class="btn-effie">{{ __('Generar') }}</button>
            <a href="{{ route('activities.report') }}" class="btn-effie-inv">{{ __('Limpiar') }}</a>
            </center>
        </div>
    </div>
</form>
<div class="space2"></div>
<div class="fila">
    <div class="columna columna-1">
        <h6 class="title3">{{ $title }}</h6>
        <table id="tbl-report" class="tablereporte">
            <thead>
                <th></th>
                <th></th>
                <th width="80%">{{ __('Cliente > Proyecto > Colaboradores') }}</th>
                <th>{{ __('Tiempo total') }}</th>
                <th></th>
                <th></th>
            </thead>
            <tbody>
                @foreach ($items as $item)
                <tr>
                    <td>{{ $item->customer }}</td>
                    <td>{{ $item->project }}</td>
                    <td>{{ $item->user }}</td>
                    <td>{{ (!floor($item->minutes/60) ? '' : floor($item->minutes/60).(floor($item->minutes/60) > 1 ? ' horas ' : ' hora ')).(!floor($item->minutes%60) ? '' : floor($item->minutes%60).(floor($item->minutes%60) > 1 ? ' minutos ' : ' minuto ')) }}</td>
                    <td>{{ $item->project_id }}</td>
                    <td>{{ $item->user_id }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="fila">
    <div class="space2"></div>
    <div class="columna columna-1">
        <form method="GET" action="{{ route('activities.download') }}">
            <input type="hidden" name="customer_id" value="{{ $customer_id }}">
            <input type="hidden" name="project_id" value="{{ $project_id }}">
            <input type="hidden" name="user_id" value="{{ $user_id }}">
            <input type="hidden" name="status" value="{{ $status }}">
            <input type="hidden" name="start_at" value="{{ $start_at }}">
            <input type="hidden" name="end_at" value="{{ $end_at }}">
            <center>
            <button type="submit" class="btn-effie" id="btn-download" disabled><i class="fa fa-download"></i>&nbsp;{{ __('Descargar') }}</button>            
            <a href="{{ route('home') }}" class="btn-effie-inv"><i class="fa fa-reply"></i>&nbsp;{{ __('Regresar') }}</a>
            </center>
        </form>
    </div>
</div>
@endsection

@include('activities/detail')

@section('script')
<link rel="stylesheet" href="https://cdn.datatables.net/rowgroup/1.1.2/css/rowGroup.dataTables.min.css">
<script src="https://cdn.datatables.net/rowgroup/1.1.2/js/dataTables.rowGroup.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
<script src="{{ asset('js/filters.js') }}"></script>
<script src="{{ asset('js/times.js') }}"></script>
<script>
$(function() {
    $('#btn-download').attr('disabled',!@json(count($items)));
    var collapsedGroups = {};
    var detail = $('#tbl-detail').DataTable({
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
        footerCallback: function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            total = api
                .column( 5 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column( 5, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 2 ).footer() ).html(
                timeToStr(pageTotal) + ' / ' + timeToStr(total)
            );
        },
        columnDefs: [{
            targets: 5,
            visible: false
        }]
    });
    var table = $('#tbl-report').DataTable({
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
        order: [[0, 'asc'], [1, 'asc']],
        rowGroup: {
            // Uses the 'row group' plugin
            dataSrc: [0, 1],
            startRender: function (rows, group, column) {
                var collapsed = !!collapsedGroups[group];

                rows.nodes().each(function (r) {
                    r.style.display = collapsed ? 'none' : '';
                });    
                var totalHours = rows
                    .data()
                    .pluck(3)
                    .reduce( function ( a, b ) {
                        return addTimes(convert(a), convert(b));
                    }, 0);
                // Add category name to the <tr>. NOTE: Hardcoded colspan
                if (column)
                    return $('<tr/>')
                        .append('<td>' + group + ': ' + rows.count() + ' colaborador' + (rows.count() > 1 ? 'es' : '') + '</td>')
                        .append('<td><strong>' + forHumans(totalHours) + '</strong></td>')
                        .css({'color':'#5AB248','font-size':'18px'})
                        .attr('data-name', group)
                        .toggleClass('collapsed', collapsed);
                else
                    return $('<tr/>')
                        .append('<td colspan=2>' + group)
                        .attr('data-name', group)
                        .toggleClass('collapsed', collapsed);
            }
        },
        columnDefs: [{
            targets: [0, 1, 4, 5],
            visible: false
        }]
    });

    $('#tbl-report tbody tr.group-start').each(function() {
        var name = $(this).data('name');
        collapsedGroups[name] = !collapsedGroups[name];
    });
    table.draw(false);

    $('#tbl-report tbody').on('click', 'tr.group-start', function () {
        var name = $(this).data('name');
        collapsedGroups[name] = !collapsedGroups[name];
        table.draw(false);
    });

    $('#tbl-report tbody').on('click', 'tr', function() {
        var data = table.row(this).data();
        var start_at = @json($start_at);
        var end_at = @json($end_at);
        detail.search('').clear().draw();

        $.ajax({
            type: 'get',
            url: 'activities.getByProjUser',
            data: {'project_id':data[4],'user_id':data[5],'start_at':start_at,'end_at':end_at},
            success: (json) => {
                $('#txt-customer').text(data[0]);
                $('#txt-project').text(data[1]);
                $('#txt-user').text(data[2]);
                var dataSet = [];
                $($.parseJSON(json)).each(function() {
                    dataSet.push([
                        dateFormat(this.start_at),
                        dateFormat(this.end_at),
                        timeToStr(this.minutes),
                        this.description,
                        this.comment,
                        this.minutes
                    ]);
                });
                detail.rows.add(dataSet).draw();
                $('#mdl-detail').modal('show');
            },
            error: function(msg) {
                alert(msg.responseJSON['message']);
            }
        });
    });
});

function timeToStr(time) {
  var hor = Math.floor(time/60);
  var min = Math.floor(time%60);
  return (!hor ? '' : (hor + (hor > 1 ? ' horas ' : ' hora '))) + (!min ? '' : (min + (min > 1 ? ' minutos ' : ' minuto ')));
}

function dateFormat(str) {
    var ano = str.substr(0,4);
    var mes = str.substr(5,2);
    var dia = str.substr(8,2);
    var hor = str.substr(11,5);
    return dia + '/' + mes + '/' + ano + ' ' + hor;
}
</script>
@endsection