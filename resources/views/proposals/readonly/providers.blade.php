<div id="tabpro" class="tabcontent" style="display:none">
    <div class="fila">
        <div class="columna columna-1">
            <h6 class="title3">{{ __('Proveedores agregados') }}</h6>
        </div>
    </div>
    <div class="fila">
        <div class="columna columna-1">
            <table id="tbl-providers" class="tablealumno">
                <thead>
                    <th width="35%">{{ __('Perfil') }}</th>
                    <th width="25%">{{ __('Detalle') }}</th>
                    <th width="15%">{{ __('Moneda') }}</th>
                    <th width="10%">{{ __('Costo') }}</th>
                    <th width="15%">{{ __('Subt. (PEN)') }}</th>
                </thead>
                <tbody>
                    @foreach ($providers as $index => $pro)
                    <tr>
                        <td>{{ $pro['profile'] }}</td>
                        <td>{{ $pro['detail'] }}</td>
                        <td><center>{{ $pro['currency'] }}</center></td>
                        <td><center>{{ $pro['price'] ? number_format($pro['price'],2) : '' }}</center></td>
                        <td><center>{{ $pro['subtotal'] ? number_format($pro['subtotal'],2) : '' }}</center></td>
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