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
    <!-- Basic Vertical form layout section start -->
    <section id="basic-vertical-layouts">
        <div class="row match-height">
            <div class="col-md-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Registra Cita para Peciente</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-vertical" method="POST" action="{{ route('cliente.citas.new') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <div class="row">
                                        <input type="hidden" name="idPaciente" value="{{ $cliente->user->id }}">
                                        <div class="form-group col-md-4">
                                            <label for="date" class="control-label">Fecha</label>
                                            <input type="date" name="date" id="date" class="form-control" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="horarios" class="control-label">Horarios diponibles ( de 7:30 AM a 8:00 PM)</label>
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
                                            <input type="file" name="prescription" accept="application/msword, .doc, .docx, .txt, application/pdf, image/*" id="prescription" class="form-control form-control-border">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                    <a type="button" class="btn btn-default" href="{{ route('admin.list.paciente') }}">Cancelar</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.0/angular.min.js"></script>
<script src="{{ asset('plugins/jquery-3.6.0.min.js')}}"></script>

<script>
    // Obtenemos la fecha actual en formato yyyy-mm-dd
    var fechaActual = new Date().toISOString().split('T')[0];
    // Asignamos la fecha actual al atributo min del elemento input
    document.getElementById('date').setAttribute('min', fechaActual);
</script>

<script>
    function TDate() {
        var UserDate = new Date(document.getElementById("time").value);
        // Obtener año, mes y día
        var year = UserDate.getFullYear();
        var month = String(UserDate.getMonth() + 1).padStart(2, '0'); // Añadir ceros iniciales si es necesario
        var day = String(UserDate.getDate()).padStart(2, '0'); // Añadir ceros iniciales si es necesario

        // Formatear la fecha en formato "YYYY-MM-DD"
        var fecha = year + "-" + month + "-" + day;

        // Establecer las horas mínimas y máximas permitidas
        var minTime = "07:30";
        var maxTime = "20:00";

        // Concatenar la fecha actual con las horas mínimas y máximas
        var minDateTimeString = fecha + "T" + minTime;
        var maxDateTimeString = fecha + "T" + maxTime;

        // Verificar si la hora seleccionada está dentro del rango permitido
        if (UserDate < new Date(minDateTimeString) || UserDate > new Date(maxDateTimeString)) {
            alert("La hora debe estar entre las 07:30 y las 20:00.");
            return false;
        }
        
        return true;
    }
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