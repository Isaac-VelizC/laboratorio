
<div class="modal fade" id="modal-estado">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Agregar nueva prueba</h4>
        </div>
        <form action="{{ route('admin.cita.status', $cita->id) }}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <select id="status" name="status" class="form-control form-control-sm form-border" required>
                        <option value="0" <?= isset($status) && $status == 0 ? 'selected' : '' ?>>Pendiente</option>
                        <option value="1" <?= isset($status) && $status == 1 ? 'selected' : '' ?>>Aprobado</option>>
                        <option value="4" <?= isset($status) && $status == 4 ? 'selected' : '' ?>>Finalizado</option>
                        <option value="5" <?= isset($status) && $status == 5 ? 'selected' : '' ?>>Cancelado</option>
                    </select>
                    <small class="mx-2">Estado</small>
                </div>
                <div class="form-group">
                    <small class="mx-2">Observaciones</small>
                    <textarea name="remarks" id="remarks" rows="3" class="form-control form-control-sm rounded-0" required></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            </div>
        </form>
      </div>
    </div>
</div>
