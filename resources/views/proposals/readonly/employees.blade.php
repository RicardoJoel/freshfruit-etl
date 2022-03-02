<div id="tabemp" class="tabcontent" style="display:block">
    <div class="fila">
        <div class="columna columna-1">
            <h6 class="title3">{{ __('Colaboradores agregados') }}</h6>
        </div>
    </div>
    <div class="fila">
        <div class="columna columna-1">
            <table id="tbl-employees" class="tablealumno">
                <thead>
                    <th width="35%">{{ __('Perfil') }}</th>
                    <th width="25%">{{ __('Detalle') }}</th>
                    <th width="15%">{{ __('Costo x hr') }}</th>
                    <th width="10%">{{ __('N° Horas') }}</th>
                    <th width="15%">{{ __('Subtotal (PEN)') }}</th>
                </thead>
                <tbody>
                    @foreach ($employees as $index => $emp)
                    <tr>
                        <td>{{ $emp['profile'] }}</td>
                        <td>{{ $emp['detail'] }}</td>
                        <td><center>{{ $emp['hourly_rate'] ? number_format($emp['hourly_rate'],2) : '' }}<center></td>
                        <td><center>{{ $emp['num_hours'] }}</center></td>
                        <td><center>{{ $emp['subtotal'] ? number_format($emp['subtotal'],2) : '' }}<center></td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4" style="text-align:right">{{ __('Total (PEN):') }}</th>
                        <th colspan="1"><center></center></th>
                    </tr>
                </tfoot>			
            </table>
        </div>
    </div>
</div>