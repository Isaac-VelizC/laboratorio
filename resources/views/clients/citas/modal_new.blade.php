<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Agregar nueva cita</h4>
        </div>
            <form method="POST" action="{{ route('cliente.citas.new') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="date" class="control-label">Fecha</label>
                            <input type="date" name="date" id="date" class="form-control" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="time" class="control-label">Hora (entre 7:30 AM a 8:00 PM)</label>
                            <input type="time" name="time" id="time" class="form-control" min="07:30" max="20:00" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="test_ids" class="control-label">Pruebas</label>
                            <select class="choices form-select multiple-remove" id="tags" name="test_ids[]" multiple="multiple">
                                <optgroup label="Figures">
                                    @foreach ($pruebas as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </optgroup>
                            </select>
                        </div>
                    </div>  
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="prescription" class="control-label">Prescripción <small><em>(Si hay alguna)</em></small></label>
                            <input type="file" name="prescription" accept="application/msword, .doc, .docx, .txt, application/pdf" id="prescription" class="form-control form-control-border" >
                        </div>
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