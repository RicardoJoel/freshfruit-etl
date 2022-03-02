@extends('layouts.app')
@section('content')
<div class="fila">
	<div class="columna columna-1">
		<div class="span-fail" id="fail_div"><span id="fail_msg"></span></div>
	</div>
</div>
<div class="fila">
	<div class="columna columna-1">
		<div class="title2">
			<h6>Procesos > Proyectos > Editar</h6>
		</div>
	</div>
</div>
<form method="POST" action="{{ route('projects.update',$project->id) }}" role="form" id="frm-proj">
	@csrf
	<input type="hidden" name="_method" id="_method" value="PATCH">
	<input type="hidden" name="proposal_id" id="proposal_id" value="{{ old('proposal_id',$project->proposal_id) }}">
	<input type="hidden" name="aux_code" id="aux_code" value="{{ old('aux_code',$project->code) }}">
	<input type="checkbox" id="has_proposal" checked="checked" style="display:none">
	<div class="fila">
        <div class="columna columna-1">
			<a onclick="showForm('gen')">
				<h6 id="gen_subt" class="title3">Datos generales</h6>
				<p id="icn-gen" class="icn-sct"><i class="fa fa-minus fa-icon"></i></p>
			</a>
		</div>
    </div>
	<div id="div-gen">
		<div class="fila">
			<div class="columna columna-5">
				<p>Código único :</p>
			</div>
			<div class="columna columna-5">
				<input type="text" name="code" id="prop_code" value="{{ old('code',$project->code) }}" disabled>
			</div>
			<div class="columna columna-5">
				<p>Fecha de inicio* :</p>
			</div>
			<div class="columna columna-5">
				<input type="date" name="happen_at" id="happen_at" value="{{ old('happen_at',$project->happen_at) }}" required>
			</div>
			<div class="columna columna-5">
				<input type="text" value="Abierto" style="text-align:center" disabled>
			</div>
		</div>
		<div class="fila">
			<div class="columna columna-5">
				<p>Datos del cliente* :</p>
			</div>
			<div class="columna columna-5">
				<input type="hidden" name="customer_id" id="customer_id" value="{{ old('customer_id',$project->customer_id) }}">
				<div class="search_field">
					<input type="text" name="customer_ruc" id="customer_ruc" value="{{ old('customer_ruc',$project->customer->ruc) }}" maxlength="11" placeholder="R. U. C." required>
					<a onclick="clearDataCust()"><i class="fa fa-close fa-icon" title="Borrar entrada"></i></a>
				</div>
			</div>
			<div class="columna columna-5d">
				<input type="text" name="customer_name" id="customer_name" value="{{ old('customer_name',$project->customer->nameCode) }}" placeholder=" -- No hay información para mostrar -- " disabled required>
			</div>
			<div class="columna columna-5">
				<button type="button" id="btn-sch-cust" class="btn-effie-inv" style="width:100%"><i class="fa fa-search"></i>&nbsp;Buscar cliente</button>
			</div>
		</div>
		<div class="fila">
			<div class="columna columna-5">
				<p>Datos del responsable* :</p>
			</div>
			<div class="columna columna-5">
				<input type="hidden" name="user_id" id="user_id" value="{{ old('user_id',$project->user_id) }}">
				<div class="search_field">
					<input type="text" name="user_document" id="user_document" value="{{ old('user_document',$project->accountable->document) }}" maxlength="15" placeholder="N° Documento" required>
					<a onclick="clearDataUser()"><i class="fa fa-close fa-icon" title="Borrar entrada"></i></a>
				</div>
			</div>
			<div class="columna columna-5d">
				<input type="text" name="user_wholename" id="user_wholename" value="{{ old('user_wholename',$project->accountable->fullnameCode) }}" placeholder=" -- No hay información para mostrar -- " disabled required>
			</div>
			<div class="columna columna-5">
				<button type="button" id="btn-sch-user" class="btn-effie-inv" style="width:100%"><i class="fa fa-search"></i>&nbsp;Buscar colab.</button>
			</div>
		</div>
		<div class="fila">
			<div class="columna columna-5">
				<p>Datos del proyecto* :</p>
			</div>
			<div class="columna columna-5">
				@inject('projectTypes','App\Services\ProjectTypes')
				<select name="project_type_id" id="project_type_id" required>
					<option selected disabled hidden value="">{{ __('Tipo de proyecto*') }}</option>
					@foreach ($projectTypes->get() as $index => $projectType)
					<option value="{{ $index }}" {{ old('project_type_id',$project->project_type_id) == $index ? 'selected' : '' }}>
						{{ $projectType }}
					</option>
					@endforeach
				</select>	
			</div>
			<div class="columna columna-5f">
				<input type="text" name="name" id="name" value="{{ old('name',$project->name) }}" maxlength="200" onkeypress="return checkText(event)" placeholder=" -- Nombre del proyecto* -- " required>
			</div>
		</div>
		<div class="fila" id="div_not_prop" style="display:none">
			<div class="columna columna-1">
				<p id="msg_not_prop" class="lbl-msg"></p>
			</div>
		</div>
	</div>
</form>
<div class="fila">
	<div class="space"></div>
	<div class="columna columna-1">
		<a onclick="showForm('cmp')">
			<h6 id="cmp_subt" class="title3">Cronograma de actividades</h6>
			<p id="icn-cmp" class="icn-sct"><i class="fa fa-minus fa-icon"></i></p>
		</a>
	</div>
</div>
<div id="div-cmp">
	<div class="fila">
		<div class="columna columna-1">
			<p>Para agregar una tarea, debes hacer doble clic sobre una celda vacía de la columna 'Nombre de la tarea' dentro del cronograma. Si haces doble clic sobre una tarea previamente ingresada, podrás visualizar su detalle y modificarla.</p>
		</div>
	</div>
	<div class="fila">
		<div class="space"></div>
		<div class="columna columna-1 gantt">
			@include('projects/gantt')
		</div>
	</div>
</div>
<div class="fila">
	<div class="space2"></div>
	<div class="columna columna-1">
		<center>
		<button type="submit" class="btn-effie" onclick="document.getElementById('frm-proj').submit();"><i class="fa fa-save"></i>&nbsp;{{ __('Guardar') }}</button>
		<button class="btn-effie-inv" onclick="$('#mdl-proj-clo').modal('show');"><i class="fa fa-flag"></i>&nbsp;Finalizar</button>
		<button class="btn-effie-inv" onclick="$('#mdl-proj-can').modal('show');"><i class="fa fa-archive"></i>&nbsp;Anular</button>
		<a href="{{ route('projects.index') }}" class="btn-effie-inv"><i class="fa fa-reply"></i>&nbsp;Regresar</a>	
		</center>
	</div>
</div>
<div class="fila">
	<div class="space"></div>
	<div class="columna columna-1">
		<p>
			<i class="fa fa-info-circle fa-icon" aria-hidden="true"></i>&nbsp;	
			<b>{{ __('Importante') }}</b>
			<ul>
				<li>{{ __('(*) Campos obligatorios.') }}</li>
				<li>{{ __('Para buscar un cliente debes ingresar el R.U.C. y luego presionar el botón "Buscar cliente"') }}</li>
				<li>{{ __('Para buscar un responsable debes ingresar el N° Documento y luego presionar el botón "Buscar colab."') }}</li>
			</ul>
		</p>
	</div>
</div>
@endsection

@include('projects/senders/close')
@include('projects/senders/cancel')
@include('searches/customers')
@include('searches/employees')
@include('searches/proposals')
@include('projects/notes/clear')

@section('script')
<script src="{{ asset('js/gencode.js') }}"></script>
<script src="{{ asset('js/searches/clients.js') }}"></script>
<script src="{{ asset('js/searches/proposals2.js') }}"></script>
<script src="{{ asset('js/searches/employees2.js') }}"></script>

<link rel="stylesheet" href="{{ asset('jQueryGantt-master/platform8.css') }}" type="text/css">
<link rel="stylesheet" href="{{ asset('jQueryGantt-master/libs/jquery/dateField/jquery.dateField.css') }}" type="text/css">

<link rel="stylesheet" href="{{ asset('jQueryGantt-master/gantt6.css') }}" type="text/css">
<link rel="stylesheet" href="{{ asset('jQueryGantt-master/ganttPrint.css') }}" type="text/css" media="print">
<link rel="stylesheet" href="{{ asset('jQueryGantt-master/libs/jquery/valueSlider/mb.slider.css') }}" type="text/css" media="print">

<script src="{{ asset('jQueryGantt-master/libs/jquery/jquery.livequery.1.1.1.min.js') }}"></script>
<script src="{{ asset('jQueryGantt-master/libs/jquery/jquery.timers.js') }}"></script>

<script src="{{ asset('jQueryGantt-master/libs/utilities.js') }}"></script>
<script src="{{ asset('jQueryGantt-master/libs/forms.js') }}"></script>
<script src="{{ asset('jQueryGantt-master/libs/date2.js') }}"></script>
<script src="{{ asset('jQueryGantt-master/libs/dialogs.js') }}"></script>
<script src="{{ asset('jQueryGantt-master/libs/layout.js') }}"></script>
<script src="{{ asset('jQueryGantt-master/libs/i18nJs2.js') }}"></script>
<script src="{{ asset('jQueryGantt-master/libs/jquery/dateField/jquery.dateField.js') }}"></script>
<script src="{{ asset('jQueryGantt-master/libs/jquery/JST/jquery.JST.js') }}"></script>
<script src="{{ asset('jQueryGantt-master/libs/jquery/valueSlider/jquery.mb.slider.js') }}"></script>

<script src="{{ asset('jQueryGantt-master/libs/jquery/svg/jquery.svg.min.js') }}"></script>
<script src="{{ asset('jQueryGantt-master/libs/jquery/svg/jquery.svgdom.1.8.js') }}"></script>

<script src="{{ asset('jQueryGantt-master/ganttUtilities2.js') }}"></script>
<script src="{{ asset('jQueryGantt-master/ganttTask2.js') }}"></script>
<script src="{{ asset('jQueryGantt-master/ganttDrawerSVG.js') }}"></script>
<script src="{{ asset('jQueryGantt-master/ganttZoom.js') }}"></script>
<script src="{{ asset('jQueryGantt-master/ganttGridEditor14.js') }}"></script>
<script src="{{ asset('jQueryGantt-master/ganttMaster5.js') }}"></script>

<script src="{{ asset('js/projects/gantt22.js') }}"></script>
<script src="{{ asset('js/projects/other.js') }}"></script>
<script>
function getDemoProject(){
	var tasks = [];
    $(@json($tasks)).each(function(index) {
		tasks.push({
			'id': this.id, 
			'code': this.code, 
			'name': this.name, 
			'start': moment(this.start_at),
			'end': moment(this.end_at), 
			'startIsMilestone': this.start_ms,
			'endIsMilestone': this.end_ms, 
			'status': this.status, 
			'progress': this.progress, 
			'description': this.description, 
			'relevance': this.relevance,
			'duration': this.duration,
			'level': this.level,
			'progressByWorklog': this.progressByWorklog, 
			'type': this.type,
			'typeId': this.typeId,
			'depends': this.depends,
			'canWrite': this.canWrite,
			'collapsed': this.collapsed,
			'assigs': this.assigs,
			'hasChild': this.hasChild
		});
	});
	var resources = [];
    $(@json($resources)).each(function(index) {
		resources.push({
			'id': 'tmp_' + (index + 1), 
			'code': this.id,
			'name': this.name
		});
	});
	var roles = [];
    $(@json($roles)).each(function() {
		roles.push({
			'id': this.id,
			'name': this.name
		});
	});
    return {
		"tasks": tasks, "resources": resources, "roles": roles, 
		"selectedRow": 0, "deletedTaskIds": [], "canWrite": true, 
		"canDelete": true, "canWriteOnParent": true, "canAdd": true
	};
}
</script>
@endsection