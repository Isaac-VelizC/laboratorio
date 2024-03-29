<div class="modal fade" id="modal-edit{{ $item->id }}">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Modicifar cita</h4>
        </div>
            <form method="POST" action="{{ route('cliente.citas.edit', $item->id) }}">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="schedule" class="control-label">Fecha y hora</label>
                            <input type="datetime-local" name="schedule" id="schedule" class="form-control form-control-border" placeholder="Ingresa el horario de la cita" value="{{ $item->schedule }}" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="test_ids" class="control-label">Pruebas</label>
                            <select name="test_ids[]" id="select2bs4" class="form-control form-control-border" placeholder="Ingresa el nombre de la cita" multiple>
                                @foreach ($pruebas as $test)
                                    <option value="{{ $test->id }}" {{ in_array($test->id, $item->pruebas->pluck('id')->toArray()) ? 'selected' : '' }}>
                                        {{ $test->name }}
                                    </option>
                                @endforeach
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
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </div>
            </form>
      </div>
    </div>
</div>