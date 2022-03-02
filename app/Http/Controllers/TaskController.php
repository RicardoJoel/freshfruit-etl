<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\CarbonInterval;
use Carbon\Carbon;
use App\Task;

class TaskController extends Controller
{
    protected const STATUS = 'STATUS_ACTIVE,STATUS_DONE,STATUS_FAILED,STATUS_SUSPENDED,STATUS_WAITING,STATUS_UNDEFINED';
    protected const DEPRGX = '/^\d+(?:[ \t]*:[ \t]*\d+)?(?:[ \t]*,[ \t]*\d+(?:[ \t]*:[ \t]*\d+)?)*$/';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
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
            'tsk_row' => 'nullable|int|min:0',
            'tsk_name' => 'nullable|string|max:200',
            'tsk_code' => 'nullable|string|max:20',
            'tsk_level' => 'required|int|min:0',
            'tsk_start_at' => 'required|date_format:Y-m-d',
            'tsk_end_at' => 'required|date_format:Y-m-d|after_or_equal:tsk_start_at',
            'tsk_start_ms' => 'required|boolean',
            'tsk_end_ms' => 'required|boolean',
            'tsk_status' => 'required|string|in:'.self::STATUS,
            'tsk_relevance' => 'required|int|min:0',
            'tsk_duration' => 'required|int|min:1',
            'tsk_progress' => 'required|numeric|between:0,100',
            'tsk_description' => 'nullable|string|max:500',
            'tsk_depends' => 'nullable|string|max:100|regex:'.self::DEPRGX
        ], $this->validationErrorMessages());

        $tasks = session('tasks', []);
        $new = [
            'id' => $request->tsk_id,
            'code' => $request->tsk_code,
            'name' => $request->tsk_name,
            'start_at' => $request->tsk_start_at,
            'end_at' => $request->tsk_end_at,
            'start_ms' => $request->tsk_start_ms,
            'end_ms' => $request->tsk_end_ms,
            'status' => $request->tsk_status,
            'progress' => $request->tsk_progress,
            'description' => $request->tsk_description,
            'relevance' => $request->tsk_relevance,
            'duration' => $request->tsk_duration,
            'depends' => $request->tsk_depends,
            'level' => $request->tsk_level
        ];

        if (substr($request->tsk_id,0,4) === 'tmp_') {
            if ($request->tsk_row)
                array_splice($tasks, $request->tsk_row, 0, [$new]);
            else
                $tasks[] = $new;
        }

        session(['tasks' => $tasks]);
        return json_encode($tasks);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tasks = session('tasks', []);

        if ($id < 0 || count($tasks) <= $id)
            return response()->json(['success' => 'false', 'errors' => 'El índice ingresado es inválido.'], 400);
        
        $item = $tasks[$id];
        $task = [
            'id' => $item['id'],
            'code' => $item['code'],
            'name' => $item['name'],
            'start_at' => $item['start_at'],
            'end_at' => $item['end_at'],
            'start_ms' => $item['start_ms'],
            'end_ms' => $item['end_ms'],
            'status' => $item['status'],
            'progress' => $item['progress'],
            'description' => $item['description'],
            'relevance' => $item['relevance'],
            'duration' => $item['duration'],
            'depends' => $item['depends'],
            'level' => $item['level']
        ];
        return json_encode($task);
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
            'tsk_name' => 'nullable|string|max:200',
            'tsk_code' => 'nullable|string|max:20',
            'tsk_level' => 'required|int|min:0',
            'tsk_start_at' => 'required|date_format:Y-m-d',
            'tsk_end_at' => 'required|date_format:Y-m-d|after_or_equal:tsk_start_at',
            'tsk_start_ms' => 'required|boolean',
            'tsk_end_ms' => 'required|boolean',
            'tsk_status' => 'required|string|in:'.self::STATUS,
            'tsk_relevance' => 'required|int|min:0',
            'tsk_duration' => 'required|int|min:1',
            'tsk_progress' => 'required|numeric|between:0,100',
            'tsk_description' => 'nullable|string|max:500',
            'tsk_depends' => 'nullable|string|max:100|regex:'.self::DEPRGX
        ], $this->validationErrorMessages());

        $tasks = session('tasks', []);

        if ($id < 0 || count($tasks) <= $id)
            return response()->json(['success' => 'false', 'errors' => 'El índice ingresado es inválido.'], 400);

        $tasks[$id] = [
            'id' => $request->tsk_id,
            'code' => $request->tsk_code,
            'name' => $request->tsk_name,
            'start_at' => $request->tsk_start_at,
            'end_at' => $request->tsk_end_at,
            'start_ms' => $request->tsk_start_ms,
            'end_ms' => $request->tsk_end_ms,
            'status' => $request->tsk_status,
            'progress' => $request->tsk_progress,
            'description' => $request->tsk_description,
            'relevance' => $request->tsk_relevance,
            'duration' => $request->tsk_duration,
            'depends' => $request->tsk_depends,
            'level' => $request->tsk_level
        ];
        
        //$task = $tasks[$id];
        //self::setPeriod($task, $task['start_at'], $task['end_at']);

        session(['tasks' => $tasks]);
        return json_encode($tasks);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tasks = session('tasks', []);

        if ($id < 0 || count($tasks) <= $id)
            return response()->json(['success' => 'false', 'errors' => 'El índice ingresado es inválido.'], 400);
        
        unset($tasks[$id]);
        $tasks = array_values($tasks);
        session(['tasks' => $tasks]);
        return json_encode($tasks);
    }

    /**
     * Move up the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function moveUp(Request $request, $id)
    {
        $tasks = session('tasks', []);

        if ($id < 0 || count($tasks) <= $id)
            return response()->json(['success' => 'false', 'errors' => 'El índice ingresado es inválido.'], 400);
        
        if ($id == 0)
            return response()->json(['success' => 'false', 'errors' => 'No puedes mover la totalidad del proyecto.'], 400);

        if ($tasks[$id - 1]['level'] < $tasks[$id]['level'])
            return response()->json(['success' => 'false', 'errors' => 'No puedes intercambiar tareas de diferente profundidad.'], 400);

        $prv = self::prevBrother($tasks, $id);
        $fam = self::getFamily($tasks, $id);
        array_splice($tasks, $prv, 0, $fam);
        
        session(['tasks' => $tasks]);
        return json_encode($tasks);
    }

    /**
     * Move down the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function moveDown(Request $request, $id)
    {
        $tasks = session('tasks', []);

        if ($id < 0 || count($tasks) <= $id)
            return response()->json(['success' => 'false', 'errors' => 'El índice ingresado es inválido.'], 400);
        
        if ($id == 0)
            return response()->json(['success' => 'false', 'errors' => 'No puedes mover la totalidad del proyecto.'], 400);

        $nxt = self::nextBrother($tasks, $id);
    
        if (!$nxt)
            return response()->json(['success' => 'false', 'errors' => 'No puedes mover más abajo la tarea seleccionada.'], 400);
        
        $fam = self::getFamily($tasks, $id);
        array_splice($tasks, $nxt, 0, $fam);
        
        session(['tasks' => $tasks]);
        return json_encode($tasks);
    }

    protected function prevBrother($tasks, $id)
    {
        $level = $tasks[$id]['level'];
        $prv = 0;
        foreach ($tasks as $index => $task) {
            if ($index == $id)
                return $prv;
            if ($task['level'] == $level)
                $prv = $index;
        }
        return $prv;
    }

    protected function getFamily(&$tasks, $id)
    {
        $level = $tasks[$id]['level'];
        $fam = [$tasks[$id]];
        unset($tasks[$id]);
        foreach ($tasks as $index => $task) {
            if ($index > $id) {
                if ($task['level'] > $level) {
                    $fam[] = $task;
                    unset($tasks[$index]);
                }
                else return $fam;
            }
        }
        return $fam;
    }

    protected function nextBrother($tasks, $id)
    {
        $level = $tasks[$id]['level'];
        foreach ($tasks as $index => $task) {
            if ($index > $id) {
                if ($task['level'] == $level)
                    return $index;
                else if ($task['level'] < $level) 
                    return null;
            }
        }
        return null;
    }

    /**
     * Get the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getByParent($id)
    {
        $parent = Task::find($id);

        if (!$parent)
            return response()->json(['success' => 'false', 'errors' => 'La tarea solicitada no ha sido encontrada.'], 400);
        
        $tasks = [];
        foreach ($parent->project->tasks as $task)
            if ($task->row > $parent->row) {
                if ($task->level <= $parent->level)
                    break;
                if ($task->level == $parent->level + 1)
                    $tasks[] = [
                        'id' => $task->id,
                        'name' => $task->code.' '.$task->name
                    ];
            }
        return $tasks;
    }

    protected function setPeriod($task, $start, $end)
    {
        $start = Carbon::parse($start);
        $end = Carbon::parse($end);
    
        //compute legal start/end //todo mossa qui R&S 30/3/2016 perchè altrimenti il calcolo della durata, che è stato modificato sommando giorni, sbaglia
        $start = self::computeStart($start);
        $end = self::computeEnd($end);
        $duration = self::computeDuration($start, $end);

        $origPeriod = [
            'start' => $task['start_at'],
            'end' => $task['end_at'],
            'duration' => $task['duration']
        ];
        
        //if are equals do nothing and return true
        if ($start == $origPeriod['start'] && $end == $origPeriod['end'] && $duration == $origPeriod['duration'])
            return true;
    
        if ($duration == $task['duration']) // is shift
            return self::moveTo($task, $start, false, true);
    
        $wantedStartMillis = $start;
        /*$children = self::getChildren($task);

        if (this.master.shrinkParent && count($children) > 0) {
            $chPeriod = getChildrenBoudaries($task);
            $start = $chPeriod->start;
            $end = $chPeriod->end;
        }

        //cannot start after end
        if ($start->gt($end)) $start = $end;
    
        //if there are dependencies compute the start date and eventually moveTo
        $startBySuperiors = computeStartBySuperiors($task, $start);
        if ($startBySuperiors != $start)
        return moveTo($task, $startBySuperiors, false, true);
    
        $somethingChanged = false;
    
        if ($task->start != $start || $task->start != $wantedStartMillis) {
        $task->start = $start;
        $somethingChanged = true;
        }
    
        //set end
        $wantedEndMillis = $end;
    
        if ($task->end != $end || $task->end != $wantedEndMillis) {
            $task->end = $end;
            $somethingChanged = true;
        }
    
        $task->duration = computeDuration($task->start, $task->end);
    
        //profilerSetPer.stop();
    
        //nothing changed exit
        if (!$somethingChanged)
        return true;
    
        //cannot write exit
        if (!$task->canWrite) {
        this.master.setErrorOnTransaction("\"" + $task->name + "\"\n" + GanttMaster.messages["CANNOT_WRITE"], $task);
        return false;
        }
    
        //external dependencies: exit with error
        if ($task->hasExternalDep) {
        this.master.setErrorOnTransaction("\"" + $task->name + "\"\n" + GanttMaster.messages["TASK_HAS_EXTERNAL_DEPS"], $task);
        return false;
        }
    
        $todoOk = true;
    
        //I'm restricting
        $deltaPeriod = $origPeriod['duration'] - $task->duration;
        $restricting = $deltaPeriod > 0;
        $enlarging = $deltaPeriod < 0;
        $restrictingStart = $restricting && ($origPeriod['start'] < $task->start);
        $restrictingEnd = $restricting && ($origPeriod.['end'] > $task->end);
    
        if ($restricting) {
            //loops children to get boundaries
            $bs = Infinity;
            $be = 0;
            for ($i=0; $i<count($children); $i++) {
                $ch = $children.at($i);
                $be = $restrictingEnd ? Math.max($be, $ch->end) : Math.min($bs, $ch->start);
            }
        
            if ($restrictingEnd)
                $task->end = Math.max($be, $task->end);
            else
                $task->start = Math.min($bs, $task->start);

            $task->duration = computeDuration($task->start, $task->end);
            
            if (this.master.shrinkParent)
                $todoOk = updateTree($task);
        } 
        else {
            //check global boundaries
            if ($task->start < $task->master.minEditableDate || $task->end > $task->master.maxEditableDate) {
                this.master.setErrorOnTransaction("\"" + this.name + "\"\n" +GanttMaster.messages["CHANGE_OUT_OF_SCOPE"], this);
                $todoOk = false;
            }

            //console.debug("set period: somethingChanged",this);
            if ($todoOk )
                $todoOk = updateTree($task);
        }
    
        if ($todoOk)
            $todoOk = $task->propagateToInferiors($end);
        return $todoOk;*/
    }

    /*protected function propagateToInferiors($task, $end) 
    {
        foreach (self::getInferiors($task) as $inf) {
            //if (!$inf->canWrite)
            //    return response()->json(['success' => 'false', 'errors' => 'No se puede editar la actividad de nombre "'.$inf->name.'".'], 400);
            
            if (!self::moveTo($inf, $end, false, true)) //this isn't the right date but moveTo checks start
                return false;
        }
        return true;
    }*/

    protected function moveTo($task, $start, $ignoreMilestones, $propagateToInferiors) 
    { 
        $wantedStartMillis = $start;
        //set a legal start
        $start = self::computeStart($start);
        //if depends, start is set to max end + lag of superior
        $start = self::computeStartBySuperiors($task['depends'], $start);
        $end = self::computeEndByDuration($start, $task['duration']);
        //check milestones compatibility
        if (!self::checkMilestonesConstraints($task, $start, $end, $ignoreMilestones))
            return false;

        if ($task['start_at'] != $start || $task['start_at'] != $wantedStartMillis) {
            $origStart = Carbon::parse($task['start_at']);
            $task['start_at'] = $start->format('Y-m-d');
            $task['end_at'] = $end->format('Y-m-d');

            //when moving children you MUST consider WORKING days,
            $panDeltaInWM = $origStart->diffInDays($start);
            dd('Valor: '.$panDeltaInWM);
            //loops children to shift them
            /*foreach (self::getChildren($task) as $child) {
                $chStart = self::incDateByUnits($child['start_at'], $panDeltaInWM);
                
                self::moveTo($child, $chStart, false, false);
            }*/
            //dd('valores: '.self::getChildren($task));      
            if (!self::updateTree($task)) return false;
      
            if ($propagateToInferiors) {
                self::propagateToInferiors($task, $end);
                foreach (self::getDescendant($task) as $desc) {
                    if (!self::propagateToInferiors($desc, $desc->end))
                        return false;
                }
            }
        }
        return true;
    }

    protected function computeStartBySuperiors($depends, $start)
    {
        //if depends -> start is set to max end + lag of superior
        $supers = self::getSuperiors($depends);
        if (!count($supers)) return $start;

        $supEnd = Carbon::parse('2000-01-01');
        foreach ($supers as $sup)
            $supEnd = self::maxDate($supEnd, self::incDateByUnits($sup['end_at'], $sup['lag']));

        return $supEnd->addWeekDay();
    }

    protected function computeStart($date)
    {
        //$date = $start->startOfDay();
        //move to next working day
        while ($date->isWeekend()) $date->addDays(1);
        return $date->startOfDay();
    }

    protected function computeEnd($date)
    {
        //$date = $end->endOfDay();
        //move to next working day
        while ($date->isWeekend()) $date->addDays(1);
        return $date->endOfDay();
    }

    protected function computeDuration($start, $end)
    {
        $resol = CarbonInterval::day();

        return $start->diffFiltered($resol, function ($date) {
            return $date->isWeekday(); // only working in days
        }, $end);
    }

    protected function maxDate($date1, $date2)
    {
        return $date1->gt($date2) ? $date1 : $date2;
    }

    protected function computeEndByDuration($start, $days)
    {
        return Carbon::parse($start)->addWeekDays($days-1)->endOfDay();
    }

    protected function checkMilestonesConstraints($task, $start, $end, $ignoreMilestones)
    {
        //if start is milestone nnd cannot be move
        if (!$ignoreMilestones && $task['start_ms'] && $start->format('Y-m-d') != $task['start_at']) 
            return response()->json(['success' => 'false', 'errors' => 'La fecha de inicio es un hito.'], 400);
        //if end is milestone and cannot be move        
        if (!$ignoreMilestones && $task['end_ms'] && $end->format('Y-m-d') != $task['end_at'])
            return response()->json(['success' => 'false', 'errors' => 'La fecha de fin es un hito.'], 400);
        //doesn't have constraints
        return true;
    }
    
    /*protected function getChildrenBoudaries($task)
    {
        $newStart = INF;
        $newEnd = -INF;
        foreach (self::getChildren($task) as $child) {
            $newStart = min($newStart, $child->start_at);
            $newEnd = max($newEnd, $child->end_at);
        }
        return ['start' => $newStart, 'end' => $newEnd];
    }*/

    protected function getChildren($parent)
    {
        $tasks = session('tasks', []);
        $found = false;
        $ret = [];
        foreach ($tasks as $index => $task) {
            if ($found) {
                if ($task['level'] <= $parent['level'])
                    return $ret;
                if ($task['level'] == $parent['level'] + 1)
                    $ret[] = $task;
            }
            else if ($task['id'] == $parent['id'])
                $found = true;
        }
        return $ret;
    }

    protected function incDateByUnits($date, $days)
    {
        return Carbon::parse($date)->addWeekDays($days); // only working in days
    }

    protected function updateTree($task) 
    {
        //console.debug("updateTree ",task.code,task.name, new Date(task.start), new Date(task.end));
        $error;
      
        //try to enlarge parent
        $p = self::getParent($task);
      
        //no parent:exit
        if (!$p) return true;
      
        $newStart;
        $newEnd;
      
        //id shrink start and end are computed on children boundaries
        if (task.master.shrinkParent) {
            $chPeriod = self::getChildrenBoudaries($p);
            $newStart = $chPeriod['start'];
            $newEnd = $chPeriod['end'];
        } 
        else {
            $newStart = $p->start_at;
            $newEnd = $p->end_at;
            if ($p->start_at > $task->start_at)
                $newStart = $task->start_at;
            if ($p->end_at < $task->end_at)
                $newEnd = $task->end_at;
        }
      
        if ($p->start_at != $newStart) {
            if ($p->startIsMilestone) {
                task.master.setErrorOnTransaction("\"" + p.name + "\"\n" + GanttMaster.messages["START_IS_MILESTONE"], task);
                return false;
            } 
            else if ($p->depends) {
                task.master.setErrorOnTransaction("\"" + p.name + "\"\n" + GanttMaster.messages["TASK_HAS_CONSTRAINTS"], task);
                return false;
            }
        }
        if ($p->end_at != $newEnd) {
            if ($p->endIsMilestone) {
                task.master.setErrorOnTransaction("\"" + p.name + "\"\n" + GanttMaster.messages["END_IS_MILESTONE"], task);
                return false;
            }
        }
        //propagate updates if needed
        if ($newStart != $p->start_at || $newEnd != $p->end_at) {
            //can write?
            if (!$p->canWrite) {
                task.master.setErrorOnTransaction(GanttMaster.messages["CANNOT_WRITE"] + "\n" + p.name, task);
                return false;
            }
            //has external deps ?
            if ($p->hasExternalDep) {
                task.master.setErrorOnTransaction(GanttMaster.messages["TASK_HAS_EXTERNAL_DEPS"] + "\n\"" + p.name + "\"", task);
                return false;
            }
            return $p.setPeriod($newStart, $newEnd);
        }
        return true;
    }

    /*protected function getParent($self) 
    {
        $tasks = session('tasks', []);
        $parent = null;
        foreach ($tasks as $task)
            if ($task->row < $self->row && $task->level < $self->level)
                $parent = $task;
        return $parent;
    }*/
    
    protected function getSuperiors($depends)
    {
        if (!$depends) return [];

        $parts = explode(',', $depends);
        $depends = [];
        foreach ($parts as $part)
            $depends[] = array_map('trim', explode(':', $part));
        
        $tasks = session('tasks', []);
        $ret = [];
        foreach ($tasks as $index => $task) {
            $lag = self::getLag($index+1, $depends);
            if ($lag > -1)
                $ret[] = ['end_at' => $task['end_at'], 'lag' => $lag];
        }
        return $ret;
    }

    protected function getInferiors($parent)
    {
        $tasks = session('tasks', []);
        $ret = [];
        foreach ($tasks as $task)
            if ($task->row > $parent->row) {
                if ($task->level <= $parent->level)
                    return $ret;
                if ($task->level == $parent->level + 1)
                    $ret[] = $parent;
            }
        return $ret;
    }
    
    protected function getLag($idx, $depends) 
    {
        foreach ($depends as $dep)
            if ($dep[0] == $idx) return (int)($dep[1] ?? 0);
        return -1;
    }

    /**
     * Get the password reset validation error messages.
     *
     * @return array
     */
    protected function validationErrorMessages()
    {
        return [
            'tsk_row.int' => 'La fila ingresada no tiene un formato válido.',
            'tsk_row.min' => 'La fila debe ser un entero no negativo.',

            'tsk_name.required' => 'Debes ingresar obligatoriamente un nombre.',
            'tsk_name.max' => 'El nombre debe tener un máximo de doscientos (200) caracteres.',

            'tsk_code.max' => 'El código debe tener un máximo de veinte (20) caracteres.',

            'tsk_start_at.required' => 'Debes ingresar obligatoriamente una fecha inicio.',
            'tsk_start_at.date_format' => 'La fecha inicio ingresada no tiene un formato válido.',

            'tsk_end_at.required' => 'Debes ingresar obligatoriamente una fecha fin.',
            'tsk_end_at.date_format' => 'La fecha fin ingresada no tiene un formato válido.',
            'tsk_end_at.after_or_equal' => 'La fecha inicio no puede ser posterior a la fecha fin.',

            'tsk_start_ms.required' => 'Debes indicar obligatoriamente si la fecha inicio es un hito.',
            'tsk_start_ms.boolean' => 'El indicador si la fecha inicio es un hito no tiene un formato válido.',

            'tsk_end_ms.required' => 'Debes indicar obligatoriamente si la fecha fin es un hito.',
            'tsk_end_ms.boolean' => 'El indicador si la fecha fin es un hito no tiene un formato válido.',

            'tsk_status.required' => 'Debes ingresar obligatoriamente un estado.',
            'tsk_status.in' => 'El estado ingresado no es válido.',

            'tsk_progress.required' => 'Debes ingresar obligatoriamente un progreso.',
            'tsk_progress.numeric' => 'El progreso ingresado no tiene un formato válido.',
            'tsk_progress.between' => 'El progreso debe estar comprendido entre cero (0) y cien (100).',

            'tsk_description.max' => 'La descripción debe tener un máximo de quinientos (500) caracteres.',

            'tsk_relevance.required' => 'Debes ingresar obligatoriamente una prioridad.',
            'tsk_relevance.int' => 'La prioridad ingresada no tiene un formato válido.',
            'tsk_relevance.min' => 'La prioridad debe ser un entero no negativo.',

            'tsk_duration.required' => 'Debes ingresar obligatoriamente una duración.',
            'tsk_duration.int' => 'La duración ingresada no tiene un formato válido.',
            'tsk_duration.min' => 'La duración debe ser un entero positivo.',

            'tsk_level.required' => 'Debes ingresar obligatoriamente un nivel.',
            'tsk_level.int' => 'El nivel ingresado no tiene un formato válido.',
            'tsk_level.min' => 'El nivel debe ser un entero no negativo.',

            'tsk_depends.max' => 'La lista de tareas predecesoras debe tener un máximo de cien (100) caracteres.',
            'tsk_depends.regex' => 'La lista de tareas predecesoras debe estar conformada por números separados por comas.',
        ];
    }
}