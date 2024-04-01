@extends('layouts.app')
@section('content')
<div class="card card-outline card-primary rounded-0 shadow">
    @if(session('success'))
        <div id="myAlert" class="alert alert-left alert-success alert-dismissible fade show mb-3 alert-fade" role="alert">
        <span>{{ session('success') }}</span>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(session('error'))
        <div id="myAlert" class="alert alert-left alert-danger alert-dismissible fade show mb-3 alert-fade" role="alert">
            <span>{{ session('error') }}</span>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
	<div class="card-header">
		<h2 class="text-center text-bold">Editar Prueba {{ $item->name }}</h2>
	</div>
	<div class="card-body">
		<div class="container-fluid">
            <form id="formulario" method="POST" action="{{ route('admin.edit.prueba', $item->id) }}">
                @csrf
                    <div class="row">
                        <div class="form-group col-4">
                            <label for="name" class="control-label">Nombre</label>
                            <input type="text" name="name" id="name" class="form-control form-control-border" placeholder="Ingresar nombre" value ="{{ $item->name }}" required>
                        </div>
                        <div class="form-group col-4">
                            <label for="cost" class="control-label">Precio</label>
                            <input type="number" step="any" name="cost" id="cost" class="form-control form-control-border text-right" value ="{{ $item->cost }}" required>
                        </div>
                        <div class="form-group col-4">
                            <label for="status" class="control-label">Estado</label>
                            <select name="status" id="status" class="form-control form-control-border" placeholder="Enter test Name" required>
                                <option value="1" {{ $item->status == 1 ? 'selected' : '' }}>Activo</option>
                                <option value="0" {{ $item->status == 0 ? 'selected' : '' }}>Inactivo</option>
                            </select>
                        </div>
                        <input type="hidden" id="valores" name="valores" value="">
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Formulario</label>
                        <textarea name="description" id="dark" cols="30" rows="10">{{ $item->description }}</textarea>
                    </div>
                <button  id="enviarFormulario" type="submit" class="btn btn-primary">Guardar</button>
                <a type="button" class="btn btn-default" href="{{ route('admin.list.prueba') }}">Cancelar</a>
            </form>
		</div>
	</div>
</div>

<script>
    var valoresExtraidos = [];
    // Manejador de eventos para el botón de enviar del formulario
    document.getElementById('enviarFormulario').addEventListener('click', function(event) {
        event.preventDefault(); // Prevenir el envío del formulario por defecto
        // Extraer valores del textarea justo antes de enviar el formulario
        var contenido = document.querySelector('#dark').value;
        valoresExtraidos = contenido.match(/@[\w\d]+/g) || [];
        console.log(valoresExtraidos);
        // Asignar los valores extraídos al campo oculto
        document.getElementById('valores').value = valoresExtraidos.join(',');

        // Enviar el formulario manualmente
        document.getElementById('formulario').submit();
    });
</script>

@endsection
