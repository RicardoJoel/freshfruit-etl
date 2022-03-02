<div id="conc" class="tabcontent" style="display:none">
    <table class="tablealumno index">
        <thead>
            <th width="10%">{{ __('Código') }}</th>
            <th width="10%">{{ __('Tipo') }}</th>
            <th width="20%">{{ __('Cliente') }}</th>
            <th width="10%">{{ __('Fecha y hora') }}</th>
            <th width="20%">{{ __('Responsable') }}</th>
            <th width="20%">{{ __('Propuesta') }}</th>
            <th width="5%">{{ __('Editar') }}</th>
            <th width="5%">{{ __('Borrar') }}</th>
        </thead>
        <tbody>
            @foreach ($visits as $visit)
            @if ($visit->is_done)
            <tr>
                <td>{{ $visit->code }}</td>
                <td>{{ $visit->projectType->name ?? '' }}</td>
                <td>{{ $visit->customer->name ?? '' }}</td>
                <td><center>{{ Carbon\Carbon::parse($visit->happen_at)->format('d/m/Y H:i') }}</center></td>
                <td>{{ $visit->accountable->fullname ?? '' }}</td>
                <td><center>{{ $visit->prop_code }}</center></td>
                <td><center><a class="btn btn-secondary btn-xs" href="{{ action('VisitController@edit', $visit->id) }}" ><span class="glyphicon glyphicon-pencil"></span></a></center></td>
                <td><center>
                    <form action="{{ action('VisitController@destroy', $visit->id) }}" method="post">
                        @csrf
                        <input name="_method" type="hidden" value="DELETE">
                        <button class="btn btn-danger btn-xs" type="submit" onclick="return confirm('¿Realmente desea eliminar la visita seleccionada?')"><span class="glyphicon glyphicon-trash"></span></button>
                    </form>
                </center></td>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
</div>