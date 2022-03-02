<div id="rech" class="tabcontent" style="display:none">
    <table class="tablealumno index">
        <thead>
            <th width="10%">{{ __('Código') }}</th>
            <th width="10%">{{ __('Tipo') }}</th>
            <th width="20%">{{ __('Cliente') }}</th>
            <th width="20%">{{ __('Nombre') }}</th>           
            <th width="10%">{{ __('Versión') }}</th>
            <th width="20%">{{ __('Responsable') }}</th>
            <th width="5%">{{ __('Reabrir') }}</th>
            <th width="5%">{{ __('Borrar') }}</th>
        </thead>
        <tbody>
            @foreach ($proposals as $proposal)
            @if ($proposal->status == 'R')
            <tr>
                <td>{{ $proposal->code }}</td>
                <td>{{ $proposal->projectType->name ?? '' }}</td>
                <td>{{ $proposal->customer->name ?? '' }}</td>
                <td>{{ $proposal->name }}</td>
                <td><center>{{ 'v'.$proposal->version }}</center></td>
                <td>{{ $proposal->accountable->fullname ?? '' }}</td>
                <td><center>
                    <a class="btn btn-secondary btn-xs" onclick="$('#aux-id').val({{ $proposal->id }});
                        $('#mdl-note-rjt').modal('show');"><span class="glyphicon glyphicon-folder-open"></span></a>
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

@include('proposals/notes/reject')