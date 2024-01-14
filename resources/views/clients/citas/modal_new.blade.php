<style>
	img#cimg{
		height: 17vh;
		width: 25vw;
		object-fit: scale-down;
	}
</style>
<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Agregar nueva cita</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
            <form action="">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="schedule" class="control-label">Fecha y hora</label>
                            <input type="datetime-local" name="schedule" id="schedule" class="form-control form-control-border" placeholder="Ingresa el horario de la cita" value ="" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="test_ids" class="control-label">Pruebas</label>
                            <select name="test_ids[]" id="test_ids" class="form-control form-control-border select2" placeholder="Ingresa el nombre de la cita" multiple required>
                                @foreach ($pruebas as $test)
                                    <option value="{{ $test }}">{{ $test->name }}</option>
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