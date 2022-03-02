@extends('layouts.app')
@section('content')
<div class="fila">
	<div class="columna columna-1">
		<div class="title2">
			<h6>{{ __('Ajustes del sistema > Editar') }}</h6>
		</div>
	</div>
</div>
<form method="POST" action="{{ route('parameters.update',$parameter->id) }}" role="form">
	@csrf
	<input name="_method" type="hidden" value="PATCH">
	
	<div class="fila">
		<div class="columna columna-5c">
			<label>{{ $parameter->description }}</label>
		</div>
		<div class="columna columna-5">
			<input type="number" name="value" id="value" min="1" value="{{ old('value', $parameter->value) }}" onkeypress="return checkNumber(event)" required>
		</div>
	</div>
	<div class="fila">
		<div class="space"></div>
		<div class="columna columna-1">
			<center>
			<button type="submit" class="btn-effie"><i class="fa fa-save"></i>&nbsp;{{ __('Guardar') }}</button>
			<a href="{{ route('parameters.index') }}" class="btn-effie-inv"><i class="fa fa-reply"></i>&nbsp;Regresar</a>	
			</center>
		</div>
	</div>
</form>
@endsection