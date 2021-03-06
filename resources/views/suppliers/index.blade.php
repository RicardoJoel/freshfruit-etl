@extends('layouts.app')
@section('content')
<div class="fila">
    <div class="columna columna-1">
        <div class="title2">
            <h6>{{ __('Entidades > Proveedores') }}</h6>
        </div>
    </div>
</div>
<div class="fila">
    <div class="columna columna-1">
        <table class="tablealumno index">
            <thead>
                <th width="10%">{{ __('Código') }}</th>
                <th width="25%">{{ __('Nombre completo') }}</th>
                <th width="15%">{{ __('Ocupación') }}</th>
                <th width="15%">{{ __('Tipo de documento') }}</th>
                <th width="10%">{{ __('Documento') }}</th>   
                <th width="15%">{{ __('Celular') }}</th>
                <th width="5%">{{ __('Editar') }}</th>
                <th width="5%">{{ __('Borrar') }}</th>
            </thead>
            <tbody>
                @foreach ($suppliers as $supplier)
                <tr>
                    <td><center>{{ $supplier->code }}</center></td>    
                    <td>{{ $supplier->name }}</td>
                    <td>{{ $supplier->profile_id != 49 ? $supplier->profile->name ?? '' : $supplier->other }}</td>
                    <td>{{ $supplier->documentType->name ?? '' }}</td>
                    <td><center>{{ $supplier->document }}</center></td>
                    <td><center>{{ $supplier->codeMobile }}</center></td>
                    <td><center><a class="btn btn-secondary btn-xs" href="{{ action('SupplierController@edit', $supplier->id) }}" ><span class="glyphicon glyphicon-pencil"></span></a></center></td>
                    <td>
                        <center>
                        <form action="{{ action('SupplierController@destroy', $supplier->id) }}" method="post">
                            @csrf
                            <input name="_method" type="hidden" value="DELETE">
                            <button class="btn btn-danger btn-xs" type="submit" onclick="return confirm('¿Realmente desea eliminar el proveedor seleccionado?')"><span class="glyphicon glyphicon-trash"></span></button>
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
        <a href="{{ route('suppliers.create') }}" class="btn-effie"><i class="fa fa-plus"></i>&nbsp;Nuevo</a>
        <a href="{{ route('home') }}" class="btn-effie-inv"><i class="fa fa-home"></i>&nbsp;Ir al inicio</a>
    </div>
    </center>
</div>
@endsection