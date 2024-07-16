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
                            <label for="horarios" class="control-label">De 7:30 AM a 8:00 PM</label>
                            <select name="time" class="form-select" id="horarios" required>
                                <option value="" selected disabled>Seleccionar hora</option>
                            </select>
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

<script>
    document.getElementById('date').addEventListener('change', function() {
  // Obtener el valor de la fecha seleccionada
  let fechaSeleccionada = this.value;

  // Enviar una solicitud POST al servidor utilizando Axios
  axios.post('/search/horarios/disponibles', {
    fecha: fechaSeleccionada
  })
  .then(function (response) {
    // Limpiar el campo de selección de horarios
    document.getElementById('horarios').innerHTML = '';
    // Obtener los horarios disponibles de la respuesta
    let horariosDisponibles = response.data.horariosDisponibles;

    // Verificar si hay horarios disponibles
    if (horariosDisponibles.length === 0) {
      // Mostrar un mensaje de error
      let selectTag = document.getElementById('horarios');
      let option = document.createElement('option');
      option.value = '';
      option.textContent = 'No hay horarios disponibles, seleccione otra fecha';
      option.disabled = true;
      option.selected = true;
      selectTag.appendChild(option);
    } else {
      // Actualizar dinámicamente el campo de selección de horarios
      let selectTag = document.getElementById('horarios');
      let optgroup = document.createElement('optgroup');
      optgroup.label = 'Horarios disponibles';
      horariosDisponibles.forEach(function(horario) {
        let option = document.createElement('option');
        option.value = horario.id;
        option.textContent = horario.hora;
        optgroup.appendChild(option);
      });
      selectTag.appendChild(optgroup);
    }
  })
  .catch(function (error) {
    console.error('Error al obtener los horarios disponibles:', error);
  });
});

</script>