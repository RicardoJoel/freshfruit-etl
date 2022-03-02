@extends('layouts.app')
@section('content')
<div class="fila">
	<div class="columna columna-1">
		<div class="title2">
			<h6>Procesos > Proyectos > Revisar</h6>
		</div>
	</div>
</div>

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
			<input type="text" value="{{ $project->code }}" disabled>
		</div>
		<div class="columna columna-5">
			<p>Fecha de inicio :</p>
		</div>
		<div class="columna columna-5">
			<input type="text" value="{{ Carbon\Carbon::parse($project->happen_at)->format('d/m/Y') }}" disabled>
		</div>
		<div class="columna columna-5">
		<input type="text" value="{{ $project->status === 'O' ? 'Abierto' : ($project->status === 'F' ? 'Cerrado' : 'Anulado') }}" style="text-align:center" disabled>
		</div>
	</div>
	<div class="fila">
		<div class="columna columna-5">
			<p>Datos del cliente :</p>
		</div>
		<div class="columna columna-5">
			<input type="text" value="{{ $project->customer->ruc ?? ''}}" disabled>
		</div>
		<div class="columna columna-5d">
			<input type="text" value="{{ $project->customer->nameCode ?? '' }}" disabled>
		</div>
		<div class="columna columna-5">
			<button type="button" class="btn-effie-inv" style="width:100%" disabled><i class="fa fa-search"></i>&nbsp;Buscar cliente</button>
		</div>
	</div>
	<div class="fila">
		<div class="columna columna-5">
			<p>Datos del responsable :</p>
		</div>
		<div class="columna columna-5">
			<input type="text" value="{{ $project->accountable->document ?? '' }}" disabled>
		</div>
		<div class="columna columna-5d">
			<input type="text" value="{{ $project->accountable->fullnameCode ?? '' }}" disabled>
		</div>
		<div class="columna columna-5">
			<button type="button" class="btn-effie-inv" style="width:100%" disabled><i class="fa fa-search"></i>&nbsp;Buscar colab.</button>
		</div>
	</div>
	<div class="fila">
		<div class="columna columna-5">
			<p>Datos del proyecto :</p>
		</div>
		<div class="columna columna-5">
			<input type="text" value="{{ ($project->projectType->name ?? '').' ('.($project->projectType->code ?? '').')' }}" disabled>
		</div>
		<div class="columna columna-5f">
			<input type="text" value="{{ $project->name }}" disabled>
		</div>
	</div>
	<div class="fila">
		<div class="columna columna-1">
			<label class="lbl-msg"><b>{{ $project->visit_id ? '' : 'Nota: Proyecto sin propuesta previa'}}</b><label>
		</div>
	</div>
</div>
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
			<p>Desde esta página solo puedes acceder a los datos ingresados para el proyecto, mas no podrás modificarlos. Si deseas visualizar el detalle de una tarea, haz doble clic sobre ella.</p>
		</div>
	</div>
	<div class="fila">
		<div class="space"></div>
		<div class="columna columna-1 gantt">
			@include('projects/ganttR')
		</div>
	</div>
</div>
<div class="fila">
	<div class="space2"></div>
	<div class="columna columna-1">
		<center>
		<a href="{{ route('projects.index') }}" class="btn-effie-inv"><i class="fa fa-reply"></i>&nbsp;Regresar</a>	
		</center>
	</div>
</div>
@endsection

@section('script')
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
		"selectedRow": 0, "deletedTaskIds": [], "canWrite": false, 
		"canDelete": false, "canWriteOnParent": false, "canAdd": false
	};
}
</script>
@endsection