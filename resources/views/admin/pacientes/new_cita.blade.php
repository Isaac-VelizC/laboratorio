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
                            <label for="schedule" class="control-label">Fecha y hora</label>
                            <input type="datetime-local" name="schedule" id="schedule" class="form-control form-control-border" placeholder="Ingresa el horario de la cita" value ="" required>
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

<script src="{{ asset('plugins/jquery-3.6.0.min.js')}}"></script>
<script>
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