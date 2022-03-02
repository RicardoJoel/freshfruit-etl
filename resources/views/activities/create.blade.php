<div class="modal fade" id="mdl-create" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">x</button>
                <h3 class="modal-title">Nueva actividad</h3>
            </div>
            <div class="modal-body">
                <div class="fila">
                    <div class="columna columna-1">
                        <div id="div-span-act" class="alert alert-danger">
                            <strong>¡Atención!</strong> Revisa los campos obligatorios.<br><br>
                            <ul id="msg-span-act"></ul>
                        </div>
                    </div>
                </div>
                <form method="POST" action="{{ route('activities.store') }}" role="form" id="frm-create">
                    @csrf
                    <input type="hidden" id="aux-cod">
                    <input type="hidden" id="aux-ini">
                    <input type="hidden" id="aux-fin">
                    
                    <div class="fila nivelado">
                        <div class="columna columna-10">
                            <i class="fa fa-clock-o fa-2x fa-icon"></i>
                        </div>
                        <div class="columna columna-2">
                            <p id="date"></p>
                        </div>
                        <div class="columna columna-4">
                            <input type="time" id="start_at" name="start_at" value="{{ old('start_at') }}" required>
                        </div>
                        <p id="guion">-</p>
                        <div class="columna columna-4">
                            <input type="time" id="end_at" name="end_at" value="{{ old('end_at') }}" required>
                        </div>
                    </div>
                    <div class="fila">
                        <div class="columna columna-10">
                            <i class="fa fa-sitemap fa-2x fa-icon"></i>
                        </div>
                        <div class="columna columna-10c">
                            @inject('projects','App\Services\Projects')
                            <select id="project_id" name="project_id" required>
                                <option selected disabled hidden value="">Selecciona un proyecto</option>
                                @foreach ($projects->getOpen() as $index => $project)
                                <option value="{{ $index }}" {{ old('project_id') == $index ? 'selected' : '' }}>
                                    {{ $project }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="fila">
                        <div class="columna columna-10">
                            <i class="fa fa-reorder fa-2x fa-icon"></i>
                        </div>
                        <div class="columna columna-10c">
                            <textarea id="description" name="description" rows="4" maxlength="500" value="{{ old('description') }}" placeholder="Descripción de la actividad" required></textarea>
                        </div>
                    </div>
                    <div class="fila">
                        <div class="columna columna-10">
                            <i class="fa fa-commenting fa-2x fa-icon"></i>
                        </div>
                        <div class="columna columna-10c">
                            <textarea id="comment" name="comment" rows="4" maxlength="500" value="{{ old('comment') }}" placeholder="Comentario (opcional)"></textarea>
                        </div>
                    </div>
                    <div class="fila nivelado">
                        <div class="columna columna-10">
                            <i class="fa fa-tint fa-2x fa-icon"></i>
                        </div>
                        <div class="columna columna-4">
                            <input type="color" id="color" name="color" value="{{ old('color','#3788d8') }}">
                        </div>
                        <div class="columna columna-2">
                            <p>Color de fondo (opcional)</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <center>
                        <button type="submit" class="btn-effie">Agregar</button>
                        <a class="btn-effie-inv" data-dismiss="modal">Cancelar</a>	
                        </center>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>