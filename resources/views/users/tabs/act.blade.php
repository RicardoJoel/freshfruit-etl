<div id="act" class="tabcontent" style="display:block">
    <table class="tablealumno index">
        <thead>
            <th width="10%">{{ __('Código') }}</th>
            <th width="30%">{{ __('Nombre completo') }}</th>
            <th width="15%">{{ __('N° Documento') }}</th>
            <th width="20%">{{ __('Correo electrónico') }}</th>
            <th width="15%">{{ __('Celular') }}</th>
            <th width="5%">{{ __('Editar') }}</th>
            <th width="5%">{{ __('Borrar') }}</th>
        </thead>
        <tbody>
            @foreach ($users as $user)
            @if (!$user->end_at)
            <tr>
                <td><center>{{ $user->code }}</center></td>
                <td>{{ $user->lastname.', '.$user->name }}</td>
                <td><center>{{ $user->document }}</center></td>
                <td>{{ $user->email }}</td>
                <td><center>{{ $user->codeMobile }}</center></td>
                <td><center><a class="btn btn-secondary btn-xs" href="{{ action('UserController@edit', $user->id) }}" ><span class="glyphicon glyphicon-pencil"></span></a></center></td>
                <td><center>
                    <form action="{{ action('UserController@destroy', $user->id) }}" method="post">
                        @csrf
                        <input name="_method" type="hidden" value="DELETE">
                        <button class="btn btn-danger btn-xs" type="submit" onclick="return confirm('¿Realmente desea eliminar el colaborador seleccionado?')"><span class="glyphicon glyphicon-trash"></span></button>
                    </form>
                </center></td>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
</div>