<div id="pend" class="tabcontent" style="display:block">
    <table class="tablealumno index">
        <thead>
            <th width="10%">{{ __('Código') }}</th>
            <th width="10%">{{ __('Tipo') }}</th>
            <th width="20%">{{ __('Cliente') }}</th>
            <th width="20%">{{ __('Nombre') }}</th>           
            <th width="10%">{{ __('Versión') }}</th>
            <th width="20%">{{ __('Responsable') }}</th>
            <th width="5%">{{ __('Editar') }}</th>
            <th width="5%">{{ __('Borrar') }}</th>
        </thead>
        <tbody>
            @foreach ($proposals as $proposal)
            @if ($proposal->status == 'P')
            <tr>
                <td>{{ $proposal->code }}</td>
                <td>{{ $proposal->projectType->name ?? '' }}</td>
                <td>{{ $proposal->customer->name ?? '' }}</td>
                <td>{{ $proposal->name }}</td>
                <td><center>{{ 'v'.$proposal->version }}</center></td>
                <td>{{ $proposal->accountable->fullname ?? '' }}</td>
                <td><center>
                    <a class="btn btn-secondary btn-xs" href="{{ $proposal->version > 1 ? route('proposals.editVersion', $proposal->id) : action('ProposalController@edit', $proposal->id) }}">
                        <span class="glyphicon glyphicon-pencil"></span></a>
                </center></td>
                <td><center>
                    <form action="{{ action('ProposalController@destroy', $proposal->id) }}" method="post">
                        @csrf
                        <input name="_method" type="hidden" value="DELETE">
                        <button class="btn btn-danger btn-xs" type="submit" onclick="return confirm('¿Realmente desea eliminar la propuesta seleccionada?')"><span class="glyphicon glyphicon-trash"></span></button>
                    </form>
                </center></td>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
</div>