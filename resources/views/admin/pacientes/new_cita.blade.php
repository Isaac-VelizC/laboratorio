@extends('layouts.app')
@section('content')
<style>
    .img-thumb-path{
        width:100px;
        height:80px;
        object-fit:scale-down;
        object-position:center center;
    }
</style>

@if(session('message'))
    <div id="myAlert" class="alert alert-left alert-success alert-dismissible fade show mb-3 alert-fade" role="alert">
       <span>{{ session('message') }}</span>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if(session('error'))
    <div id="myAlert" class="alert alert-left alert-danger alert-dismissible fade show mb-3 alert-fade" role="alert">
        <span>{{ session('error') }}</span>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
<div class="card card-outline card-primary rounded-0 shadow">
	<div class="card-header">
		<h3 class="card-title">Registra Cita para Peciente</h3>
	</div>
	<div class="card-body">
		<div class="container-fluid">
            <form method="POST" action="{{ route('cliente.citas.new') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" name="idPaciente" value="{{ $cliente->user->id }}">
                        <div class="form-group col-md-6">
                            <label for="schedule" class="control-label">Fecha y hora (entre las 7:30 AM y las 8:00 PM)</label>
                            <input type="datetime-local" name="schedule" id="schedule" class="form-control form-control-border" 
                            min="2024-01-01T07:30" max="2030-12-30T20:00" onchange="TDate()" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="test_ids" class="control-label">Pruebas</label>
                            <select class="form-control" id="tags" name="test_ids[]" multiple="multiple"></select>
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
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.0/angular.min.js"></script>
<script src="{{ asset('plugins/jquery-3.6.0.min.js')}}"></script>

<script>
    function TDate() {
        var UserDate = new Date(document.getElementById("schedule").value);
        var CurrentDateTime = new Date();
        // Verificar si la fecha seleccionada es menor que la fecha actual
        if (UserDate < CurrentDateTime) {
            alert("La fecha y hora debe ser posterior a la fecha y hora actual.");
            return false;
        }
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


    $(document).ready(function() {
        $("#tags").select2({
            placeholder:'Buscar Prueba',
            allowClear:true,
            theme: "classic",
            ajax:{
                url:"{{ route('search.pruebas') }}",
                type: "post",
                $delay:250,
                dataType:'json',
                data: function(params) {
                    return{
                        name:params.term,
                        "_token":"{{ csrf_token() }}",
                    };
                },
                processResults:function(data){
                    return {
                        results: $.map(data, function(item) {
                            return {
                                id: item.id,
                                text:item.name
                            }
                        })
                    };
                },
            },
        });
    });
</script>
@endsection