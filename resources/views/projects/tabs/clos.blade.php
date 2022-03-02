<div id="clos" class="tabcontent" style="display:none">
    <table class="tablealumno index">
        <thead>
            <th width="10%">{{ __('Código') }}</th>
            <th width="10%">{{ __('Tipo') }}</th>
            <th width="10%">{{ __('Cliente') }}</th>
            <th width="40%">{{ __('Nombre') }}</th>  
            <th width="20%">{{ __('Responsable') }}</th>
            <th width="5%">{{ __('Revisar') }}</th>
            <th width="5%">{{ __('Borrar') }}</th>
        </thead>
        <tbody>
            @foreach ($projects as $project)
            @if ($project->status == 'F')
            <tr>
                <td>{{ $project->code }}</td>
                <td>{{ $project->projectType->name ?? '' }}</td>
                <td>{{ $project->customer->name ?? '' }}</td>
                <td>{{ $project->name }}</td>
                <td>{{ $project->accountable->fullname ?? '' }}</td>
                <td><center><a class="btn btn-secondary btn-xs" href="{{ action('ProjectController@show', $project->id) }}" ><span class="glyphicon glyphicon-eye-open"></span></a></center></td>
                <td>
                    <center>
                    <form action="{{ action('ProjectController@destroy', $project->id) }}" method="post">
                        @csrf
                        <input name="_method" type="hidden" value="DELETE">
                        <button class="btn btn-danger btn-xs" type="submit" onclick="return confirm('¿Realmente deseas eliminar el proyecto seleccionado?')"><span class="glyphicon glyphicon-trash"></span></button>
                    </form>
                    </center>
                </td>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
</div>