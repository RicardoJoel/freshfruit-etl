<div class="fila">
    <div class="space"></div>
    <div class="columna columna-1">
        <a onclick="showForm('var')">
            <h6 id="var_subt" class="title3">Agregar variación salarial</h6>
            <p id="icn-var" class="icn-sct"><i class="fa fa-plus fa-icon"></i></p>
        </a>
    </div>
</div>
<div id="div-var" style="display:none">
	<form method="POST" action="{{ action('VariationController@store') }}" role="form" id="variation_form">
		@csrf
		<input type="hidden" name="cur_salary" value="{{ $user->cur_salary }}">
		<div class="fila">
			<div class="columna columna-6">
				<label>{{ __('Tipo de variación*') }}</label>
				<select name="variation_type" id="variation_type" required>
					<option value="Aumento" {{ old('variation_type') == 'Aumento' ? 'selected' : '' }}>{{ __('Aumento') }}</option>
					<option value="Disminución" {{ old('variation_type') == 'Disminución' ? 'selected' : '' }}>{{ __('Disminución') }}</option>
				</select>
			</div>
			<div class="columna columna-6">
				<label>{{ __('Monto (S/)*') }}</label>
				<input type="number" name="variation_amount" id="variation_amount" value="{{ old('variation_amount') }}" onkeypress="return checkNumber(event)" required>
			</div>
			<div class="columna columna-6">
				<label>{{ __('Fecha efectiva*') }}</label>
				<input type="date" name="variation_start_at" id="variation_start_at" value="{{ old('variation_start_at') }}" required>
			</div>
			<div class="columna columna-2">
				<label>{{ __('Observación') }}</label>
				<input type="text" name="variation_observation" id="variation_observation" value="{{ old('variation_observation') }}" maxlength="100" onkeypress="return checkText(event)">
			</div>
		</div>
		<div class="fila">
			<div class="columna columna-1">
				<div class="span-fail" id="variation_fail_div"><span id="variation_fail_msg"></span></div>
			</div>
		</div>
		<div class="fila">
			<div class="space"></div>
			<div class="columna columna-1">
				<center>
				<button id="variation_submit" type="submit" class="btn-effie"><i class="fa fa-plus-circle"></i>&nbsp;{{ __('Agregar') }}</button>
				<a onclick="clearVarForm()" class="btn-effie-inv"><i class="fa fa-paint-brush"></i>&nbsp;{{ __('Limpiar') }}</a>
				</center>
			</div>
		</div>
	</form>
</div>
<div class="fila">
    <div class="space"></div>
    <div class="columna columna-1">
        <a onclick="showForm('sal')">
            <h6 id="sal_subt" class="title3">Variaciones salariales registradas</h6>
            <p id="icn-sal" class="icn-sct"><i class="fa fa-plus fa-icon"></i></p>
        </a>
    </div>
</div>
<div id="div-sal" class="fila" style="display:none">
	<div class="columna columna-1">
		<table id="tbl-variations" class="tablealumno">
			<thead>
				<th width="10%">{{ __('F. Registro') }}</th>
				<th width="10%">{{ __('F. Efectiva') }}</th>
				<th width="10%">{{ __('Tipo de variación') }}</th>
				<th width="20%">{{ __('Sueldo inicial (S/)') }}</th>
				<th width="20%">{{ __('Monto (S/)') }}</th>
				<th width="20%">{{ __('Sueldo final (S/)') }}</th>
				<th width="10%">{{ __('Observación') }}</th>
			</thead>
			<tbody>
				@foreach ($variations as $variation)
				<tr>
					<td><center>{{ Carbon\Carbon::parse($variation['created_at'])->format('d/m/Y') }}</center></td>
					<td><center>{{ Carbon\Carbon::parse($variation['start_at'])->format('d/m/Y') }}</center></td>
					<td><center>{{ $variation['type'] }}</center></td>
					<td><center>{{ number_format($variation['before']) }}</center></td>
					<td><center>{{ number_format($variation['amount']) }}</center></td>
					<td><center>{{ number_format($variation['after']) }}</center></td>
					<td>{{ $variation['observation'] }}</td>
				</tr>
				@endforeach
			</tbody>			
		</table>
	</div>
</div>