<div class="modal fade" id="modal-estado">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Cambiar de estado</h4>
            </div>
            <form action="{{ route('admin.cita.status', $cita->id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <select id="status" name="status" class="form-control form-control-sm form-border" required>
                            <option value="0" {{ $cita->status != 0 ? 'style=display:none;' : '' }}
                                {{ isset($cita->status) && $cita->status == 0 ? 'selected' : '' }}>
                                Pendiente
                            </option>
                            <option value="1" {{ $cita->status == 2 || $cita->status == 4 ? 'style=display:none;': '' }}
                                <?= isset($cita->status) && $cita->status == 1 ? 'selected' : '' ?>>Aprobado
                            </option>
                            <option value="2" {{ $cita->status == 4 ? 'style=display:none;': '' }}
                                <?= isset($cita->status) && $cita->status == 2 ? 'selected' : '' ?>>Muestra Recogida
                            </option>
                            <option value="4" <?=isset($cita->status) && $cita->status == 4 ? 'selected' : ''
                                ?>>Finalizado</option>
                        </select>
                        <small class="mx-2">Estado</small>
                    </div>
                    <div class="form-group">
                        <small class="mx-2">Observaciones (Opcional)</small>
                        <textarea name="remarks" id="remarks" rows="3"
                            class="form-control form-control-sm rounded-0"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>