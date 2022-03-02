<div id="tabfre" class="tabcontent" style="display:none">
    <div class="fila">
        <div class="columna columna-1">
            <h6 class="title3">{{ __('Independientes agregados') }}</h6>
        </div>
    </div>
    <div class="fila">
        <div class="columna columna-1">
            <table id="tbl-independents" class="tablealumno">
                <thead>
                    <th width="35%">{{ __('Perfil') }}</th>
                    <th width="25%">{{ __('Detalle') }}</th>
                    <th width="15%">{{ __('Moneda') }}</th>
                    <th width="10%">{{ __('Costo') }}</th>
                    <th width="15%">{{ __('Subt. (PEN)') }}</th>
                </thead>
                <tbody>
                    @foreach ($independents as $index => $ind)
                    <tr>
                        <td>{{ $ind['profile'] }}</td>
                        <td>{{ $ind['detail'] }}</td>
                        <td><center>{{ $ind['currency'] }}</center></td>
                        <td><center>{{ $ind['price'] ? number_format($ind['price'],2) : '' }}</center></td>
                        <td><center>{{ $ind['subtotal'] ? number_format($ind['subtotal'],2) : '' }}</center></td>
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