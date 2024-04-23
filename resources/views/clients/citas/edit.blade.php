@extends('layouts.app')
@section('content')

<div class="page-heading">
    @if(session('message'))
        <div class="alert alert-success alert-dismissible show fade">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible show fade">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Editar</h3>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('cliente.citas.edit', $cita->id) }}">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="date" class="control-label">Fecha</label>
                                <input type="date" name="date" id="date" class="form-control" value="{{ $cita->fecha }}" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="horarios" class="control-label">De 7:30 AM a 8:00 PM</label>
                                <select name="time" class="form-select" id="horarios">
                                    <option value="{{ $cita->hora_id }}" selected disabled>{{ $cita->hora_id ? $cita->HorarioId->hora : 'Seleccionar fecha'}}</option>
                                </select>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="select2bs4" class="control-label">Prueba seleccioda</label>
                                <select class="choices form-select multiple-remove" id="select2bs4" name="test_ids[]" multiple="multiple">
                                    <optgroup label="Figures">
                                        @foreach ($pruebas as $test)
                                            <option value="{{ $test->id }}" {{ in_array($test->id, $cita->pruebas->pluck('id')->toArray()) ? 'selected' : '' }}>
                                                {{ $test->name }}
                                            </option>
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
                        <a type="button" class="btn btn-default" href="{{ route('cliente.citas') }}">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>

@include('clients.citas.modal_new')
<div class="modal fade" id="modal-confirmacion">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Confirmación</h4>
            </div>
            <form id="deleteForm" method="post" action="{{ route('admin.citas.delete') }}">
                @csrf
                @method('DELETE')
                <input type="hidden" name="id" value="">
                <div class="modal-body">
                    <p>¿Estás seguro de eliminar este usuario de forma permanente?</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Continuar</button>
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function confirmDelete(userId) {
        // Actualizar el valor del campo 'id' en el formulario antes de mostrar el modal
        $('#modal-confirmacion').find('input[name="id"]').val(userId);
    }
</script>

<script>
    // Obtenemos la fecha actual en formato yyyy-mm-dd
    var fechaActual = new Date().toISOString().split('T')[0];
    // Asignamos la fecha actual al atributo min del elemento input
    document.getElementById('date').setAttribute('min', fechaActual);
</script>

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
    })
    .catch(function (error) {
        console.error('Error al obtener los horarios disponibles:', error);
    });
    });

</script>
@endsection