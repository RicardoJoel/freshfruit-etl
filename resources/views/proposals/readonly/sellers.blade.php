<div id="tabsel" class="tabcontent" style="display:none">
    <div class="fila">
        <div class="columna columna-1">
            <h6 class="title3">{{ __('Vendedores agregados') }}</h6>
        </div>
    </div>
    <div class="fila">
        <div class="columna columna-1">
            <table id="tbl-sellers" class="tablealumno">
                <thead>
                    <th width="40%">{{ __('Nombre completo') }}</th>
                    <th width="10%">{{ __('Código') }}</th>
                    <th width="40%">{{ __('Detalle') }}</th>
                    <th width="10%">{{ __('Comisión (%)') }}</th>
                </thead>
                <tbody>
                    @foreach ($sellers as $index => $sel)
                    <tr>
                        <td>{{ $sel['user'] }}</td>
                        <td>{{ $sel['code'] }}</td>
                        <td>{{ $sel['detail'] }}</td>
                        <td><center>{{ $sel['commission'] ? number_format($sel['commission'],2) : '' }}</center></td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3" style="text-align:right">{{ __('Total (%):') }}</th>
                        <th colspan="1"><center></center></th>
                    </tr>
                </tfoot>			
            </table>
        </div>
    </div>
</div>