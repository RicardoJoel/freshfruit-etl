<div id="workSpace"></div>
<form id="gimmeBack" style="display:none" action="../gimmeBack.jsp" method="post" target="_blank">
    <input type="hidden" name="prj" id="gimBaPrj">
</form>
<div id="gantEditorTemplates" style="display:none">
    <div class="__template__" type="GANTBUTTONS"><!--
        <div class="ganttButtonBar noprint">
            <div class="buttons">
                <button onclick="$('#mdl-clear').modal('show');" class='button textual icon requireCanWrite requireCanAdd' title="Nuevo cronograma"><i class="fa fa-file-o fa-2x fa-cron"></i></button>
                <button onclick="saveGanttOnServer();" class="button textual icon requireCanWrite requireCanAdd" title="Guardar cronograma"><i class="fa fa-save fa-2x fa-cron"></i></button>
                <label for="load-file" style="margin-bottom:-20px" class='button textual icon requireCanWrite requireCanAdd' title="Abrir cronograma"><i class="fa fa-folder-open-o fa-2x fa-cron"></i></label>
                <button class="button login" title="login/enroll" onclick="loginEnroll($(this));" style="display:none;">login/enroll</button>
                <button class="button opt collab" title="Start with Twproject" onclick="collaborate($(this));" style="display:none;"><em>collaborate</em></button>
                <span class="ganttButtonSeparator requireCanWrite requireCanAdd"></span>
                <button onclick="$('#workSpace').trigger('undo.gantt');return false;" class="button textual icon requireCanWrite" title="Deshacer acción"><span class="teamworkIcon">&#39;</span></button>
                <button onclick="$('#workSpace').trigger('redo.gantt');return false;" class="button textual icon requireCanWrite" title="Rehacer acción"><span class="teamworkIcon">&middot;</span></button>
                <span class="ganttButtonSeparator requireCanWrite requireCanAdd"></span>
                <button onclick="$('#workSpace').trigger('addAboveCurrentTask.gantt');return false;" class="button textual icon requireCanWrite requireCanAdd" title="Insertar tarea encima"><span class="teamworkIcon">l</span></button>
                <button onclick="$('#workSpace').trigger('addBelowCurrentTask.gantt');return false;" class="button textual icon requireCanWrite requireCanAdd" title="Insertar tarea debajo"><span class="teamworkIcon">X</span></button>
                <span class="ganttButtonSeparator requireCanWrite requireCanInOutdent"></span>
                <button onclick="$('#workSpace').trigger('outdentCurrentTask.gantt');return false;" class="button textual icon requireCanWrite requireCanInOutdent" title="Desindentar tarea"><span class="teamworkIcon">.</span></button>
                <button onclick="$('#workSpace').trigger('indentCurrentTask.gantt');return false;" class="button textual icon requireCanWrite requireCanInOutdent" title="Indentar tarea"><span class="teamworkIcon">:</span></button>
                <span class="ganttButtonSeparator requireCanWrite requireCanMoveUpDown"></span>
                <button onclick="$('#workSpace').trigger('moveUpCurrentTask.gantt');return false;" class="button textual icon requireCanWrite requireCanMoveUpDown" title="Mover tarea arriba"><span class="teamworkIcon">k</span></button>
                <button onclick="$('#workSpace').trigger('moveDownCurrentTask.gantt');return false;" class="button textual icon requireCanWrite requireCanMoveUpDown" title="Mover tarea abajo"><span class="teamworkIcon">j</span></button>
                <span class="ganttButtonSeparator requireCanWrite requireCanDelete"></span>
                <button onclick="$('#workSpace').trigger('deleteFocused.gantt');return false;" class="button textual icon delete requireCanWrite" title="Eliminar tarea"><span class="teamworkIcon">&cent;</span></button>
                <span class="ganttButtonSeparator"></span>
                <button onclick="$('#workSpace').trigger('collapseAll.gantt'); return false;" class="button textual icon " title="Contraer tarea"><span class="teamworkIcon">5</span></button>
                <button onclick="$('#workSpace').trigger('expandAll.gantt');return false;" class="button textual icon " title="Expandir tarea"><span class="teamworkIcon">6</span></button>
                <span class="ganttButtonSeparator"></span>
                <button onclick="$('#workSpace').trigger('zoomMinus.gantt'); return false;" class="button textual icon " title="Alejar"><span class="teamworkIcon">)</span></button>
                <button onclick="$('#workSpace').trigger('zoomPlus.gantt');return false;" class="button textual icon " title="Acercar"><span class="teamworkIcon">(</span></button>
                <span class="ganttButtonSeparator"></span>
                <button onclick="ge.gantt.showCriticalPath=!ge.gantt.showCriticalPath; ge.redraw();return false;" class="button textual icon requireCanSeeCriticalPath" title="Mostrar ruta crítica"><span class="teamworkIcon">&pound;</span></button>
                <span class="ganttButtonSeparator requireCanSeeCriticalPath"></span>
                <button onclick="ge.splitter.resize(.1);return false;" class="button textual icon"><span class="teamworkIcon" title="Ocultar panel izquierdo">F</span></button>
                <button onclick="ge.splitter.resize(50);return false;" class="button textual icon"><span class="teamworkIcon" title="Mostrar ambos paneles">O</span></button>
                <button onclick="ge.splitter.resize(100);return false;" class="button textual icon"><span class="teamworkIcon" title="Ocultar panel derecho">R</span></button>
                <span class="ganttButtonSeparator"></span>
                <button onclick="$('#workSpace').trigger('fullScreen.gantt');return false;" class="button textual icon" title="Pantalla completa" id="fullscrbtn"><span class="teamworkIcon">@</span></button>
                <button onclick="ge.element.toggleClass('colorByStatus');return false;" class="button textual icon" title="Colorear tareas"><span class="teamworkIcon">&sect;</span></button>
                <button onclick="editResources();" class="button textual requireWrite" title="Editar recursos"><span class="teamworkIcon">M</span></button>
                &nbsp; &nbsp; &nbsp; &nbsp;
                <input type="file" name="load-file" id="load-file" style="display:none">
            </div>
        </div>
    --></div>

    <div class="__template__" type="TASKSEDITHEAD"><!--
        <table class="gdfTable" cellspacing="0" cellpadding="0">
            <thead>
                <tr style="height:40px">
                    <th class="gdfColHeader" style="width:35px; border-right:none"></th>
                    <th class="gdfColHeader" style="width:25px;"></th>
                    <th class="gdfColHeader gdfResizable" style="width:50px;">Código</th>
                    <th class="gdfColHeader gdfResizable" style="width:300px;">Nombre de la tarea</th>
                    <th class="gdfColHeader" align="center" style="width:17px;" title="El comienzo es un hito"><span class="teamworkIcon" style="font-size:8px;">^</span></th>
                    <th class="gdfColHeader gdfResizable" style="width:80px;">Inicio</th>
                    <th class="gdfColHeader" align="center" style="width:17px;" title="El fin es un hito"><span class="teamworkIcon" style="font-size:8px;">^</span></th>
                    <th class="gdfColHeader gdfResizable" style="width:80px;">Fin</th>
                    <th class="gdfColHeader gdfResizable" style="width:100px;">Duración</th>
                    <th class="gdfColHeader gdfResizable" style="width:20px;">Progreso (%)</th>
                    <th class="gdfColHeader gdfResizable requireCanSeeDep" style="width:50px;">Predecesoras</th>
                    <th class="gdfColHeader gdfResizable" style="width:1000px; text-align:left; padding-left:10px !important;">Recursos asignados</th>
                </tr>
            </thead>
        </table>
    --></div>

    <div class="__template__" type="TASKROW"><!--
        <tr id="tid_(#=obj.id#)" taskId="(#=obj.id#)" class="taskEditRow (#=obj.isParent()?'isParent':''#) (#=obj.collapsed?'collapsed':''#)" level="(#=level#)">
            <th class="gdfCell edit" align="right" style="cursor:pointer;"><span class="taskRowIndex">(#=obj.getRow()+1#)</span> <span class="teamworkIcon" style="font-size:12px;" >e</span></th>
            <td class="gdfCell noClip" align="center"><div class="taskStatus cvcColorSquare" status="(#=obj.status#)"></div></td>
            <td class="gdfCell"><input type="text" name="code" value="(#=obj.code?obj.code:''#)" maxlength="20"></td>
            <td class="gdfCell indentCell" style="padding-left:(#=obj.level*10+18#)px;">
                <div class="exp-controller" align="center"></div>
                <input type="text" name="name" value="(#=obj.name#)" maxlength="200">
            </td>
            <td class="gdfCell" align="center"><input type="checkbox" name="startIsMilestone"></td>
            <td class="gdfCell"><input type="text" name="start" value="" class="date"></td>
            <td class="gdfCell" align="center"><input type="checkbox" name="endIsMilestone"></td>
            <td class="gdfCell"><input type="text" name="end" value="" class="date"></td>
            <td class="gdfCell"><input type="text" name="duration" autocomplete="off" value="(#=obj.duration#)"></td>
            <td class="gdfCell"><input type="text" name="progress" class="validated" entrytype="PERCENTILE" autocomplete="off" value="(#=obj.progress?obj.progress:''#)" (#=obj.progressByWorklog?"readOnly":""#)></td>
            <td class="gdfCell requireCanSeeDep"><input type="text" name="depends" autocomplete="off" value="(#=obj.depends#)" (#=obj.hasExternalDep?"disabled":""#) maxlength="100"></td>
            <td class="gdfCell taskAssigs">(#=obj.getAssigsString()#)</td>
        </tr>
    --></div>

    <div class="__template__" type="TASKEMPTYROW"><!--
        <tr class="taskEditRow emptyRow" >
            <th class="gdfCell" align="right"></th>
            <td class="gdfCell noClip" align="center"></td>
            <td class="gdfCell"></td>
            <td class="gdfCell"></td>
            <td class="gdfCell"></td>
            <td class="gdfCell"></td>
            <td class="gdfCell"></td>
            <td class="gdfCell"></td>
            <td class="gdfCell"></td>
            <td class="gdfCell"></td>
            <td class="gdfCell requireCanSeeDep"></td>
            <td class="gdfCell"></td>
        </tr>
    --></div>

    <div class="__template__" type="TASKBAR"><!--
        <div class="taskBox taskBoxDiv" taskId="(#=obj.id#)">
            <div class="layout (#=obj.hasExternalDep?'extDep':''#)">
                <div class="taskStatus" status="(#=obj.status#)"></div>
                <div class="taskProgress" style="width:(#=obj.progress>100?100:obj.progress#)%; background-color:(#=obj.progress>100?'red':'rgb(153,255,51);'#);"></div>
                <div class="milestone (#=obj.startIsMilestone?'active':''#)" ></div>

                <div class="taskLabel"></div>
                <div class="milestone end (#=obj.endIsMilestone?'active':''#)" ></div>
            </div>
        </div>
    --></div>

    <div class="__template__" type="CHANGE_STATUS"><!--
        <div class="taskStatusBox">
            <div class="taskStatus cvcColorSquare" status="STATUS_ACTIVE" title="En progreso"></div>
            <div class="taskStatus cvcColorSquare" status="STATUS_DONE" title="Completado"></div>
            <div class="taskStatus cvcColorSquare" status="STATUS_FAILED" title="Fallido"></div>
            <div class="taskStatus cvcColorSquare" status="STATUS_SUSPENDED" title="Suspendido"></div>
            <div class="taskStatus cvcColorSquare" status="STATUS_WAITING" title="En espera"></div>
            <div class="taskStatus cvcColorSquare" status="STATUS_UNDEFINED" title="Sin definir"></div>
        </div>
    --></div>

    <div class="__template__" type="TASK_EDITOR"><!--
        <div class="ganttTaskEditor">
            <h6 class="taskData title3">Editor de tareas</h6>
            <div class="span-fail" id="tsk_fail_div" style="margin-bottom:20px;width:99%"><span id="tsk_fail_msg"></span></div>
            <input type="hidden" id="id"><input type="hidden" id="level">
            <table cellspacing="1" cellpadding="5" width="99%" class="taskData">
                <tr>
                    <td colspan="2" valign="top">
                        <p for="name" class="required">Nombre*</p>
                        <input type="text" name="name" id="name"class="formElements" autocomplete='off' maxlength="200" style='width:95%' value="" required="true" oldvalue="1">
                    </td>
                    <td style="height:80px" valign="top">
                        <p for="code">Código</p>
                        <input type="text" name="code" id="code" value="" size=15 class="formElements" autocomplete='off' maxlength="20" oldvalue="1">
                    </td>
                </tr>
                <tr class="dateRow">
                    <td nowrap="">
                        <div style="position:relative">
                            <p for="start">Fecha inicio*</p>
                            <input type="text" name="start" id="start" size="8" class="formElements dateField validated date" autocomplete="off" maxlength="10" value="" oldvalue="1" entrytype="DATE" style="width:140px">
                            <span title="Calendario" id="starts_inputDate" class="teamworkIcon openCalendar" onclick="$(this).dateField({inputField:$(this).prevAll(':input:first'),isSearchField:false});">m</span>
                            <input type="checkbox" id="startIsMilestone" name="startIsMilestone" value="yes">&nbsp;<label for="startIsMilestone">Es un hito</label>&nbsp;<br>
                        </div>
                    </td>
                    <td nowrap="">
                        <p for="end">Fecha fin*</p>
                        <input type="text" name="end" id="end" size="8" class="formElements dateField validated date" autocomplete="off" maxlength="10" value="" oldvalue="1" entrytype="DATE" style="width:140px">
                        <span title="Calendario" id="ends_inputDate" class="teamworkIcon openCalendar" onclick="$(this).dateField({inputField:$(this).prevAll(':input:first'),isSearchField:false});">m</span>
                        <input type="checkbox" id="endIsMilestone" name="endIsMilestone" value="yes">&nbsp;<label for="endIsMilestone">Es un hito</label>&nbsp;<br>
                    </td>
                    <td nowrap="">
                        <p for="duration" class=" ">Duración* (días)</p>
                        <input type="number" name="duration" id="duration" size="4" class="formElements validated durationdays" autocomplete="off" value="" oldvalue="1" entrytype="DURATIONDAYS">&nbsp;
                    </td>
                </tr>
                <tr>
                    <td>
                        <p for="status" class=" ">Estado*</p>
                        <select id="status" name="status" class="taskStatus" status="(#=obj.status#)" onchange="$(this).attr('STATUS',$(this).val());" style="width:140px">
                            <option value="STATUS_ACTIVE" class="taskStatus" status="STATUS_ACTIVE">En progreso</option>
                            <option value="STATUS_DONE" class="taskStatus" status="STATUS_DONE">Completado</option>
                            <option value="STATUS_FAILED" class="taskStatus" status="STATUS_FAILED">Fallido</option>
                            <option value="STATUS_SUSPENDED" class="taskStatus" status="STATUS_SUSPENDED">Suspendido</option>
                            <option value="STATUS_WAITING" class="taskStatus" status="STATUS_WAITING">En espera</option>
                            <option value="STATUS_UNDEFINED" class="taskStatus" status="STATUS_UNDEFINED">Sin definir</option>
                        </select>
                    </td>
                    <td valign="top" nowrap>
                        <p>Prioridad*</p>
                        <input type="number" name="relevance" id="relevance" size="7" class="formElements validateddurationdays" autocomplete="off" value="" oldvalue="1" entrytype="DURATIONDAYS" style="width:140px">
                    </td>
                    <td valign="top" nowrap>
                        <p>Progreso* (%)</p>
                        <input type="number" name="progress" id="progress" size="7" class="formElements validated percentile" autocomplete="off" maxlength="10" value="" oldvalue="1" entrytype="PERCENTILE">
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <p for="description">Descripción</p>
                        <textarea rows="3" cols="30" id="description" name="description" maxlength="500" class="formElements" style="width:100%"></textarea>
                    </td>
                </tr>
            </table>
            <p style="margin-bottom:20px">(*) Campos obligatorios</p>
            <h6 class="title3">Recursos asignados</h6>
            <table cellspacing="1" cellpadding="0" width="100%" id="assigsTable">
                <tr>
                    <th style="width:50%;text-align:center">Nombre</th>
                    <th style="width:23%;text-align:center">Rol</th>
                    <th style="width:20%;text-align:center">Esfuerzo est.</th>
                    <th style="width:7%;text-align:center" id="addAssig"><span class="teamworkIcon" style="cursor:pointer" title="Agregar recurso">r</span></th>
                </tr>
            </table>
            <div style="padding-top:20px">
                <center>
                <span id="saveButton" class="btn-effie" onclick="$(this).trigger('saveFullEditor.gantt');">Guardar</span>
                <button class="btn-effie-inv" onclick="closeBlackPopup();">Cancelar</button>
                </center>
            </div>
        </div>
    --></div>

    <div class="__template__" type="ASSIGNMENT_ROW"><!--
        <tr taskId="(#=obj.task.id#)" assId="(#=obj.assig.id#)" class="assigEditRow" >
            <td ><select name="resourceId" class="formElements" (#=obj.assig.id.indexOf("tmp_")==0?"":"disabled"#) ></select></td>
            <td ><select type="select" name="roleId" class="formElements"></select></td>
            <td ><input type="text" name="effort" value="(#=getMillisInHoursMinutes(obj.assig.effort)#)" size="5" class="formElements"></td>
            <td align="center"><span class="teamworkIcon delAssig del" style="cursor: pointer" title="Eliminar recurso asignado">d</span></td>
        </tr>
    --></div>

    <div class="__template__" type="RESOURCE_EDITOR"><!--
        <div class="resourceEditor" style="padding:5px">
            <h6 class="title3">Editor de recursos</h6>
            <div class="span-fail" id="rsc_fail_div" style="margin-bottom:20px"><span id="rsc_fail_msg"></span></div>
            <table cellspacing="1" cellpadding="0" width="100%" id="resourcesTable">
                <tr>
                    <th style="width:10%;text-align:center"></th>
                    <th style="width:80%;text-align:center">Nombre</th>
                    <th style="width:10%;text-align:center" id="addResource"><span class="teamworkIcon" style="cursor:pointer" title="Agregar recurso">r</span></th>
                </tr>
            </table>
            <div style="padding-top:20px">
                <center>
                <button id="resSaveButton" class="btn-effie">Guardar</button>
                <button class="btn-effie-inv" onclick="closeBlackPopup();">Cancelar</button>
                </center>
            </div>
        </div>
    --></div>

    <div class="__template__" type="RESOURCE_ROW"><!--
        <tr resId="(#=obj.id#)" class="resRow">
            <input type="hidden" name="code" value="(#=obj.code#)">
            <td>
                @inject('users','App\Services\Users')
                <select id="rsc_id" class="formElements selRes">
                    <option selected disabled hidden value=""></option>
                    @foreach ($users->get() as $index => $user)
                    <option value="{{ $index }}">
                        {{ $user }}
                    </option>
                    @endforeach
                </select>
            </td>
            <td><input type="input" name="name" value="(#=obj.name#)" style="width:100%" class="formElements" disabled></td>
            <td align="center"><span class="teamworkIcon delRes del" style="cursor:pointer" title="Eliminar recurso">d</span></td>
        </tr>
    --></div>
</div>