@extends('layouts.app')
@section('content')
<div class="fila">
    <div class="columna columna-1">
        <div class="title2">
            <h6>{{ __('Entidades > Clientes') }}</h6>
        </div>
    </div>
</div>
<div class="fila">
    <div class="columna columna-1">
        <table class="tablealumno index">
            <thead>
                <th width="10%">{{ __('Código') }}</th>    
                <th width="30%">{{ __('Razón social') }}</th>
                <th width="15%">{{ __('Nombre comercial') }}</th>
                <th width="15%">{{ __('R. U. C.') }}</th>
                <th width="20%">{{ __('Rubro de negocio') }}</th>
                <th width="5%">{{ __('Editar') }}</th>
                <th width="5%">{{ __('Borrar') }}</th>
            </thead>
            <tbody>
                @foreach ($customers as $customer)
                <tr>
                    <td><center>{{ $customer->code }}</center></td>    
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->alias }}</td>
                    <td><center>{{ $customer->ruc }}</center></td>
                    <td>{{ $customer->business->name ?? '' }}</td>
                    <td><center><a class="btn btn-secondary btn-xs" href="{{ action('CustomerController@edit', $customer->id) }}" ><span class="glyphicon glyphicon-pencil"></span></a></center></td>
                    <td>
                        <center>
                        <form action="{{ action('CustomerController@destroy', $customer->id) }}" method="post">
                            @csrf
                            <input name="_method" type="hidden" value="DELETE">
                            <button class="btn btn-danger btn-xs" type="submit" onclick="return confirm('¿Realmente desea eliminar el cliente seleccionado?')"><span class="glyphicon glyphicon-trash"></span></button>
                        </form>
                        </center>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="fila">
    <div class="space2"></div>
    <center>
    <div class="columna columna-1">
        <a href="{{ route('customers.create') }}" class="btn-effie"><i class="fa fa-plus"></i>&nbsp;Nuevo</a>
        <a href="{{ route('home') }}" class="btn-effie-inv"><i class="fa fa-home"></i>&nbsp;Ir al inicio</a>
    </div>
    </center>
</div>
@endsection