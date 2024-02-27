@extends('layouts.app')
@section('content')
<div class="card card-outline card-primary rounded-0 shadow">
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
	<div class="card-header">
		<h2 class="text-center text-bold">EDITAR PRUEBA</h2>
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
                        <input type="hidden" id="contenidoInput" name="description" value="">
                        <input type="hidden" id="valores" name="valores" value="">
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Formulario</label>
                        <div id="editor">
                            {!! $item->description !!}
                        </div>
                    </div>
                <button type="submit" class="btn btn-primary">Guardar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            </form>
		</div>
	</div>
</div>
<!--script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/classic/ckeditor.js"></script-->
<script src="{{ asset('assets/vendor/ckeditor5/build/ckeditor.js')}}"></script>

<script>
    var valoresExtraidos = []; // Variable global para almacenar los valores extraídos

    ClassicEditor
        .create(document.querySelector('#editor'))
        .then(editor => {
            window.editor = editor;

            // Actualiza la variable global cada vez que cambie el contenido del editor
            editor.model.document.on('change:data', () => {
                const contenido = editor.getData();
                // Extrae los valores con '@' del contenido del editor y los guarda en la variable global
                valoresExtraidos = contenido.match(/@[\w\d]+/g) || [];
                document.getElementById('contenidoInput').value = contenido;
            });
        })
        .catch(error => {
            console.error('Error al crear el editor:', error);
        });

    // Manejador de eventos para el botón de enviar del formulario
    document.getElementById('formulario').addEventListener('submit', function() {
        // Actualiza el valor del campo oculto con los valores extraídos
        document.getElementById('valores').value = valoresExtraidos.join(',');
    });
</script>


@endsection
