<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proposal;
use App\Project;
use App\Task;
use App\User;
use Carbon\Carbon;
use Redirect;
use DB;

class ProjectController extends Controller
{
    protected const MSG_SCS_CRTPRJ = 'Proyecto con código value registrado de manera exitosa.';
    protected const MSG_ERR_CRTPRJ = 'Lo sentimos, ocurrió un problema mientras se intentaba registrar el proyecto.';
    protected const MSG_SCS_UPDPRJ = 'Proyecto con código value actualizado de manera exitosa.';
    protected const MSG_ERR_UPDPRJ = 'Lo sentimos, ocurrió un problema mientras se intentaba actualizar el proyecto.';
    protected const MSG_SCS_DLTPRJ = 'Proyecto con código value eliminado de manera exitosa.';
    protected const MSG_ERR_DLTPRJ = 'Lo sentimos, ocurrió un problema mientras se intentaba eliminar el proyecto.';
    protected const MSG_NOT_FNDPRJ = 'El proyecto solicitado no ha sido encontrado.';

    protected const MSG_NOT_FNDPRP = 'La propuesta solicitada no ha sido encontrada.';
    protected const MSG_ERR_DIFCST = 'No puedes cambiar el cliente de la propuesta seleccionada.';
    protected const MSG_ERR_CNTPRJ = 'La propuesta seleccionada ya tiene un proyecto asociado.';
    protected const MSG_ERR_GTDATE = 'La fecha de inicio del proyecto no puede ser anterior a la fecha de propuesta.';
    protected const MSG_SCS_CLOSED = 'El estado del proyecto con código value ha sido cambiado a CERRADO.';
    protected const MSG_SCS_CANCEL = 'El estado del proyecto con código value ha sido cambiado a ANULADO.';
    protected const MSG_ERR_STATUS = 'Lo sentimos, ocurrió un problema mientras se intentaba actualizar el estado del proyecto.';
    protected const MSG_NOT_EDITAB = 'El proyecto solicitado tiene el estado value y no puede ser editado.';
    protected const MSG_NOT_DELETE = 'El proyecto solicitado tiene el estado value y no puede ser eliminado.';

    protected const MSG_SCS_CRTTSK = 'Tarea con código value registrada de manera exitosa.';
    protected const MSG_ERR_CRTTSK = 'Lo sentimos, ocurrió un problema mientras se intentaba registrar una tarea.';
    protected const MSG_SCS_UPDTSK = 'Tarea con código value actualizada de manera exitosa.';
    protected const MSG_ERR_UPDTSK = 'Lo sentimos, ocurrió un problema mientras se intentaba actualizar una tarea.';
    protected const MSG_SCS_DLTTSK = 'Tarea con código value eliminada de manera exitosa.';
    protected const MSG_ERR_DLTTSK = 'Lo sentimos, ocurrió un problema mientras se intentaba eliminar una tarea.';
    protected const MSG_NOT_FNDTSK = 'La tarea solicitada no ha sido encontrada.';

    protected const MSG_SCS_CRTRSC = 'Recurso con código value registrado de manera exitosa.';
    protected const MSG_ERR_CRTRSC = 'Lo sentimos, ocurrió un problema mientras se intentaba registrar un recurso.';
    protected const MSG_SCS_UPDRSC = 'Recurso con código value actualizado de manera exitosa.';
    protected const MSG_ERR_UPDRSC = 'Lo sentimos, ocurrió un problema mientras se intentaba actualizar un recurso.';
    protected const MSG_SCS_DLTRSC = 'Recurso con código value eliminado de manera exitosa.';
    protected const MSG_ERR_DLTRSC = 'Lo sentimos, ocurrió un problema mientras se intentaba eliminar un recurso.';
    protected const MSG_NOT_FNDRSC = 'El recurso solicitado no ha sido encontrado.';

    protected const ROLES = [
        ['id' => 'tmp_1', 'name' => 'Resp. Proyecto'],
        ['id' => 'tmp_2', 'name' => 'Colaborador'],
        ['id' => 'tmp_3', 'name' => 'Stakeholder'],
        ['id' => 'tmp_4', 'name' => 'Cliente']
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::where('code','not like','OTR000000000%')->orderByRaw('code','name')->paginate(1000000);
        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (session()->has('errors')) {
            $tasks = session('tasks', []);
            $resources = session('resources', []);
            $assignments = session('assignments', []);
        }
        else {
            $tasks[] = [
                'id' => 0,
                'row' => 0,
                'code' => 1,
                'name' => 'Nombre del proyecto',
                'start_at' => Carbon::tomorrow()->toDateString(),
                'end_at' => Carbon::tomorrow()->toDateString(),
                'start_ms' => false,
                'end_ms' => false,
                'status' => 'STATUS_UNDEFINED',
                'progress' => 0,
                'description' => null,
                'relevance' => 0,
                'duration' => 1,
                'depends' => null,
                'level' => 0,
                'progressByWorklog' => false, 
                'type' => '', 
                'typeId' => '', 
                'canWrite' => true, 
                'collapsed' => false, 
                'assigs' => [], 
                'hasChild' => true
            ];
            $resources = $assignments = [];
            session([
                'tasks' => $tasks,
                'resources' => $resources,
                'assignments' => $assignments,
            ]);
        }
        $roles = self::ROLES;
        return view('projects.create', compact('tasks','resources','assignments','roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'proposal_id' => 'nullable|int|min:1',
            'code' => 'required|string|unique:projects,code,NULL,id,deleted_at,NULL|regex:/[A-Za-z0-9]{15}/',
            'happen_at' => 'required|date_format:Y-m-d',
            'customer_id' => 'required|int|min:1',
            'user_id' => 'required|int|min:1',
            'project_type_id' => 'required|int|min:1',
            'name' => 'required|string|max:200',
            'tasks' => 'required|array',
        ], $this->validationErrorMessages());

        if ($request->proposal_id) {
            $proposal = Proposal::find($request->proposal_id);

            if (!$proposal)
                return Redirect::back()->with('error', self::MSG_NOT_FNDPRP)->withInput();
            
            if (count($proposal->projects))
                return Redirect::back()->with('error', self::MSG_ERR_CNTPRJ)->withInput();

            if ($proposal->customer_id != $request->customer_id)
                return Redirect::back()->with('error', self::MSG_ERR_DIFCST)->withInput();
            
            if (Carbon::parse($proposal->happen_at)->gt(Carbon::parse($request->happen_at)))
                return Redirect::back()->with('error', self::MSG_ERR_GTDATE)->withInput();
        }

        $project = Project::create($request->all());

        if (!$project)
            return Redirect::back()->with('error', self::MSG_ERR_CRTPRJ);
        
        /* Registro de tareas asociadas al proyecto */
        foreach ($request->tasks as $index => $task) {
            if (!Task::create(collect($task)->all() + [
                'row' => $index, 
                'project_id' => $project->id
            ]))
                return response()->json(['success' => 'false', 'errors' => 'Que pasó?.'], 400);
                //return Redirect::back()->with('error', self::MSG_ERR_CRTTSK)->withInput();
        }
        /* Registro de recursos asociados al proyecto */
        $resources = session('resources', []);
        foreach ($resources as $rsc) {
            $user = User::find($rsc['id']);
            if (!$user)
                return Redirect::back()->with('error', self::MSG_NOT_FNDRSC);
            $project->resources()->attach($user);
        }
        session()->forget('tasks','resources');
        return Redirect::route('projects.index')->with('success', str_replace('value', $project->code, self::MSG_SCS_CRTPRJ));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::find($id);
        
        if (!$project)
            return Redirect::back()->with('error', self::MSG_NOT_FOUNDX);
        
        $tasks = $resources = $assignments = [];
        foreach ($project->tasks as $task)
            $tasks[] = [
                'id' => $task->id,
                'code' => $task->code,
                'name' => $task->name,
                'start_at' => $task->start_at,
                'end_at' => $task->end_at,
                'start_ms' => $task->start_ms,
                'end_ms' => $task->end_ms,
                'status' => $task->status,
                'progress' => $task->progress,
                'description' => $task->description,
                'relevance' => $task->relevance,
                'duration' => $task->duration,
                'depends' => $task->depends,
                'level' => $task->level,
                'progressByWorklog' => false, 
                'type' => '', 
                'typeId' => '', 
                'canWrite' => true, 
                'collapsed' => false, 
                'assigs' => [], 
                'hasChild' => true
            ];
        foreach ($project->resources as $rsc)
            $resources[] = [
                'id' => $rsc->id,
                'name' => $rsc->fullname
            ];
        $roles = self::ROLES;
        return view('projects.show', compact('project','tasks','resources','assignments','roles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::find($id);
        
        if (!$project)
            return Redirect::back()->with('error', self::MSG_NOT_FOUNDX);
        
        if ($project->status !== 'O')
            return Redirect::back()->with('error', str_replace('value', $project->status === 'F' ? 'CERRADO' : 'ANULADO', self::MSG_NOT_EDITAB));

        if (session()->has('errors')) {
            $tasks = session('tasks', []);
            $resources = session('resources', []);
            $assignments = session('assignments', []);
        }
        else {
            $tasks = $resources = $assignments = [];
            foreach ($project->tasks as $task)
                $tasks[] = [
                    'id' => $task->id,
                    'code' => $task->code,
                    'name' => $task->name,
                    'start_at' => $task->start_at,
                    'end_at' => $task->end_at,
                    'start_ms' => $task->start_ms,
                    'end_ms' => $task->end_ms,
                    'status' => $task->status,
                    'progress' => $task->progress,
                    'description' => $task->description,
                    'relevance' => $task->relevance,
                    'duration' => $task->duration,
                    'depends' => $task->depends,
                    'level' => $task->level,
                    'progressByWorklog' => false, 
                    'type' => '', 
                    'typeId' => '', 
                    'canWrite' => true, 
                    'collapsed' => false, 
                    'assigs' => [], 
                    'hasChild' => true
                ];
            foreach ($project->resources as $rsc)
                $resources[] = [
                    'id' => $rsc->id,
                    'name' => $rsc->fullname
                ];
            session([
                'tasks' => $tasks,
                'resources' => $resources,
                'assignments' => $assignments,
            ]);
        }
        $roles = self::ROLES;
        return view('projects.edit', compact('project','tasks','resources','assignments','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'proposal_id' => 'nullable|int|min:1',
            'code' => 'required|string|unique:projects,code,'.$id.',id,deleted_at,NULL|regex:/[A-Za-z0-9]{15}/',
            'happen_at' => 'required|date_format:Y-m-d',
            'customer_id' => 'required|int|min:1',
            'user_id' => 'required|int|min:1',
            'project_type_id' => 'required|int|min:1',
            'name' => 'required|string|max:200',
        ], $this->validationErrorMessages());

        $project = Project::find($id);

        if (!$project)
            return Redirect::back()->with('error', self::MSG_NOT_FNDPRJ)->withInput();
        
        if ($project->status !== 'O')
            return Redirect::back()->with('error', str_replace('value', $project->status === 'F' ? 'CERRADO' : 'ANULADO', self::MSG_NOT_EDITAB))->withInput();

        if ($request->proposal_id) {
            $proposal = Proposal::find($request->proposal_id);

            if (!$proposal)
                return Redirect::back()->with('error', self::MSG_NOT_FNDPRP)->withInput();
            
            if (count($proposal->projects->where('id','!=',$id)))
                return Redirect::back()->with('error', self::MSG_ERR_CNTPRJ)->withInput();

            if ($proposal->customer_id != $request->customer_id)
                return Redirect::back()->with('error', self::MSG_ERR_DIFCST)->withInput();
            
            if (Carbon::parse($proposal->happen_at)->gt(Carbon::parse($request->happen_at)))
                return Redirect::back()->with('error', self::MSG_ERR_GTDATE)->withInput();
        }

        if (!$project->update($request->all()))
            return Redirect::back()->with('error', self::MSG_ERR_UPDPRJ)->withInput();
        
        /* Actualización de las tareas asociadas */
        $tasks = session('tasks', []);
        foreach ($project->tasks as $task) {
            if (!self::inArray($task->id, $tasks))
                $task->delete();
        }
        foreach ($tasks as $index => $task) {
            if (substr($task['id'],0,4) !== 'tmp_') { //Dependiente actualmente registrado
                if (!Task::find($task['id'])->update([
                    'row' => $index,
                    'code' => $task['code'],
                    'name' => $task['name'],
                    'start_at' => $task['start_at'],
                    'end_at' => $task['end_at'],
                    'start_ms' => $task['start_ms'],
                    'end_ms' => $task['end_ms'],
                    'status' => $task['status'],
                    'progress' => $task['progress'],
                    'description' => $task['description'],
                    'relevance' => $task['relevance'],
                    'duration' => $task['duration'],
                    'depends' => $task['depends'],
                    'level' => $task['level'],
                    'project_id' => $project->id
                ]))
                    return Redirect::back()->with('error', self::MSG_ERR_UPDTSK)->withInput();
            }
            else { //Dependiente sin registrar
                if (!Task::create([
                    'row' => $index,
                    'code' => $task['code'],
                    'name' => $task['name'],
                    'start_at' => $task['start_at'],
                    'end_at' => $task['end_at'],
                    'start_ms' => $task['start_ms'],
                    'end_ms' => $task['end_ms'],
                    'status' => $task['status'],
                    'progress' => $task['progress'],
                    'description' => $task['description'],
                    'relevance' => $task['relevance'],
                    'duration' => $task['duration'],
                    'depends' => $task['depends'],
                    'level' => $task['level'],
                    'project_id' => $project->id
                ]))
                    return Redirect::back()->with('error', self::MSG_ERR_CRTTSK)->withInput();
            }
        }
        /* Eliminación de recursos que no figuran en memoria */
        $resources = session('resources', []);
        foreach ($project->resources as $rsc)
            if (!self::inArray($rsc->id, $resources)) {
                DB::table('project_user')
                    ->where('project_id', $project->id)
                    ->where('user_id', $rsc->id)
                    ->update(['deleted_at' => DB::raw('now()')]);
            }        
        /* Agregación de recursos que no figuran en la BD */
        foreach ($resources as $rsc)
            if (!self::inArray($rsc['id'], $project->resources)) {                
                $user = User::find($rsc['id']);
                if (!$user)
                    return Redirect::back()->with('error', self::MSG_NOT_FNDRSC);
                $project->resources()->attach($user);
            }
        session()->forget('resources','tasks');
        return Redirect::route('projects.index')->with('success', str_replace('value', $project->code, self::MSG_SCS_UPDPRJ));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {     
        $project = Project::find($id);

        if (!$project)
            return Redirect::back()->with('error', self::MSG_NOT_FNDPRJ);
        
        if ($project->status !== 'O')
            return Redirect::back()->with('error', str_replace('value', $project->status === 'F' ? 'CERRADO' : 'ANULADO', self::MSG_NOT_DELETE));
        
        foreach ($project->resources as $rsc)
            if (!DB::table('project_user')
                    ->where('project_id', $project->id)
                    ->where('user_id', $rsc->id)
                    ->update(['deleted_at' => DB::raw('now()')]))
                return Redirect::back()->with('error', self::MSG_ERR_DLTRSC);
        
        if (!$project->delete())
            return Redirect::back()->with('error', self::MSG_ERR_DLTPRJ);

        return Redirect::route('projects.index')->with('success', str_replace('value', $project->code, self::MSG_SCS_DLTPRJ));
    }

    public function close(Request $request, $id)
    {
        $this->validate($request, [
            'changed_at' => 'required|date_format:Y-m-d|before_or_equal:today',            
        ], $this->validationErrorMessages());

        $project = Project::find($id);

        if (!$project)
            return Redirect::back()->with('error', self::MSG_NOT_FNDPRJ);
            
        if ($project->status !== 'O')
            return Redirect::back()->with('error', str_replace('value', $project->status === 'F' ? 'CERRADO' : 'ANULADO', self::MSG_NOT_EDITAB));

        if (!$project->update(['status' => 'F', 'changed_at' => $request->changed_at]))
            return Redirect::back()->with('error', self::MSG_ERR_STATUS);

        return Redirect::route('projects.index')->with('success', str_replace('value', $project->code, self::MSG_SCS_CLOSED));
    }
    
    public function cancel(Request $request, $id)
    {
        $this->validate($request, [
            'changed_at' => 'required|date_format:Y-m-d|before_or_equal:today',            
        ], $this->validationErrorMessages());

        $project = Project::find($id);

        if (!$project)
            return Redirect::back()->with('error', self::MSG_NOT_FNDPRJ);

        if ($project->status !== 'O')
            return Redirect::back()->with('error', str_replace('value', $project->status === 'F' ? 'CERRADO' : 'ANULADO', self::MSG_NOT_EDITAB));

        if (!$project->update(['status' => 'C', 'changed_at' => $request->changed_at]))
            return Redirect::back()->with('error', self::MSG_ERR_STATUS);

        return Redirect::route('projects.index')->with('success', str_replace('value', $project->code, self::MSG_SCS_CANCEL));
    }

    /**
     * Get the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function get($id)
    {
        $project = Project::find($id);
        
        if (!$project) 
            return response()->json(['success' => 'false', 'message' => 'El proyecto seleccionado no ha sido encontrado.'], 400);
        
        $tasks = [];
        foreach ($project->tasks->where('level',1) as $task)
            $tasks[] = [
                'id' => $task->id,
                'name' => $task->code.' '.$task->name
            ];
        return [
            'project' => $project,
            'tasks' => $tasks
        ];
    }
    
    /**
     * Get the password reset validation error messages.
     *
     * @return array
     */
    protected function validationErrorMessages()
    {
        return [
            'proposal_id.int' => 'El ID de la propuesta seleccionada no tiene un formato válido.',
            'proposal_id.min' => 'El ID de la propuesta seleccionada es inválido.',

            'code.required' => 'Debes ingresar obligatoriamente un código de proyecto.',
            'code.unique' => 'El código de proyecto ingresado ya existe en el sistema.',
            'code.regex' => 'El código de proyecto debe estar compuesto por quince (15) caracteres alfanuméricos.',

            'happen_at.required' => 'Debes ingresar obligatoriamente una fecha de inicio.',
            'happen_at.date_format' => 'La fecha de inicio ingresada no tiene un formato válido.',

            'customer_id.required' => 'Debes seleccionar obligatoriamente un cliente.',
            'customer_id.int' => 'El ID del cliente seleccionado no tiene un formato válido.',
            'customer_id.min' => 'El ID del cliente seleccionado es inválido.',
            
            'user_id.required' => 'Debes seleccionar obligatoriamente un responsable.',
            'user_id.int' => 'El ID del responsable seleccionado no tiene un formato válido.',
            'user_id.min' => 'El ID del responsable seleccionado es inválido.',

            'project_type_id.required' => 'Debes seleccionar obligatoriamente un tipo de proyecto.',
            'project_type_id.int' => 'El ID del tipo de proyecto seleccionado no tiene un formato válido.',
            'project_type_id.min' => 'El ID del tipo de proyecto seleccionado es inválido.',
            
            'name.required' => 'Debes ingresar obligatoriamente un nombre de proyecto.',
            'name.max' => 'El nombre de la proyecto debe tener un máximo de doscientos (200) caracteres.',

            'changed_at.required' => 'Debes ingresar obligatoriamente una fecha de cambio de estado.',
            'changed_at.date_format' => 'La fecha de cambio de estado ingresada no tiene un formato válido.',
            'changed_at.before_or_equal' => 'La fecha de cambio de estado no puede ser posterior a la fecha actual.', 
        ];
    }
}