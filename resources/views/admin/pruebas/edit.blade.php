
<div class="modal fade" id="modal-pruebas-edit{{$item->id}}">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Editar prueba</h4>
        </div>
        <form method="POST" action="{{ route('admin.edit.prueba', $item->id) }}">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="name" class="control-label">Nombre</label>
                    <input type="text" name="name" id="name" class="form-control form-control-border" placeholder="Ingresar nombre" value ="{{ $item->name }}" required>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="cost" class="control-label">Precio</label>
                        <input type="number" step="any" name="cost" id="cost" class="form-control form-control-border text-right" value ="{{ $item->cost }}" required>
                    </div>
                    <div class="form-group col-6">
                        <label for="status" class="control-label">Estado</label>
                        <select name="status" id="status" class="form-control form-control-border" placeholder="Enter test Name" required>
                            <option value="1" {{ $item->status == 1 ? 'selected' : '' }}>Activo</option>
                            <option value="0" {{ $item->status == 0 ? 'selected' : '' }}>Inactivo</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="control-label">Formulario</label>
                    <textarea rows="3" name="description" id="editordescripcionEdit" class="form-control form-control-sm rounded-0">{{ $item->description }}</textarea>
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
