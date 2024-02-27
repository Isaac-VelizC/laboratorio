@extends('layouts.app')

@section('content')
<div class="col-lg-12">
    <div class="card card-outline card-dark rounded-0 shadow">
        <div class="card-header">
            <h5 class="card-title">Formulario de prueba</h5>
        </div>
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
        <div class="card-body">
            <form method="POST" action="{{ auth()->user()->type == 1 ? route('admin.guardar.admin') : route('admin.guardar.informe') }}">
                @csrf
                <div class="container-fluid" id="outprint">
                    <div class="row">
                        <div class="col-2 border bg-gradient-primary text-light">Código de Cita</div>
                        <div class="col-4 border">{{ isset($cita->code) ? $cita->code :"" }}</div>
                        <div class="col-2 border bg-gradient-primary text-light">Calendario</div>
                        <div class="col-4 border">{{ isset($cita->schedule) ? date("M d, Y h:i A", strtotime($cita->schedule)) :"" }}</div>    
                        <div class="col-2 border bg-gradient-primary text-light">Nombre Paciente</div>
                        <div class="col-6 border">{{ isset($cliente) ? $cliente->user->nombres .' '. $cliente->user->apellido_pa.' '. $cliente->user->apellido_ma :"" }}</div>
                        <div class="col-2 border bg-gradient-primary text-light">Cedula Identidad</div>
                        <div class="col-2 border">{{ isset($cliente) ? $cliente->user->ci :"" }}</div>
                        <div class="col-1 border bg-gradient-primary text-light">Sexo</div>
                        <div class="col-2 border">{{ isset($cliente) ? $cliente->gender :"" }}</div>
                        <div class="col-2 border bg-gradient-primary text-light">Fecha Nacimiento</div>
                        <div class="col-2 border">{{ isset($cliente) ? $cliente->dob :"" }}</div>
                        <div class="col-1 border bg-gradient-primary text-light">Correo</div>
                        <div class="col-4 border">{{ isset($cliente) ? $cliente->user->email :"" }}</div>
                        <div class="col-2 border bg-gradient-primary text-light">Dirección</div>
                        <div class="col-4 border">{{ isset($cliente) ? $cliente->address :"" }}</div>
                        <div class="col-2 border bg-gradient-primary text-light">Teléfono</div>
                        <div class="col-4 border">{{ isset($cliente) ? $cliente->contact :"" }}</div>
                    </div>
                </div>
                @if (auth()->user()->type == 2)
                    <input type="hidden" name="codigo" value="{{ $cita->code }}">
                @endif
                <input type="hidden" name="cita" value="{{ $cita->id }}">
                <input type="hidden" name="prueba" value="{{ $prueba->id }}">
                <br>
                <div class="row">
                    @foreach ($inputs as $item)
                        <div class="form-group col-4">
                            <label for="name" class="control-label">{{ $item->name }}</label>
                            <input class="form-control form-control-border" required 
                                type="{{ $item->type }}" 
                                name="{{ $item->name }}" 
                                id="{{ $item->name }}" 
                                placeholder="{{ $item->name }}"
                            />
                        </div>
                    @endforeach
                </div>
                <div>
                    <div id="editor">{!! $formulario !!}</div>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <button class="btn btn-sm btn-primary" type="submit">Guardar</button>
                        <a class="btn btn-sm btn-danger" type="button" href="{{ route('admin.cita.show', $cita->id) }}">cerrar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="{{ asset('build/ckeditor5/build/ckeditor.js')}}"></script>
<script>
    InlineEditor
        .create(document.querySelector('#editor'))
        .then(editor => {
            window.editor = editor;
            // Función para actualizar el contenido del editor con el valor del campo de entrada específico
            function actualizarContenidoEditor(inputId) {
    // Obtener el contenido del editor
    let contenido = editor.getData();
    // Obtener el valor del campo de entrada específico y eliminar espacios en blanco al inicio y al final
    let inputValue = document.getElementById(inputId).value.trim();
    // Crear un nuevo identificador para el valor
    let nuevoIdentificador = inputId + '-' + inputValue;

    // Construir una expresión regular que coincida con el identificador seguido de cualquier cantidad de caracteres, incluyendo puntos y números decimales
    let regex = new RegExp(inputId + '(\\.?[0-9]+)?', 'g');
    // Realizar el reemplazo en el contenido del editor
    contenido = contenido.replace(regex, nuevoIdentificador);

    // Actualizar el contenido del editor
    editor.setData(contenido);
}



            // Agregar un evento a cada campo de entrada para llamar a la función actualizarContenidoEditor cuando cambie
            document.querySelectorAll('.form-control').forEach(input => {
                input.addEventListener('input', () => {
                    console.log(input.id);
                    actualizarContenidoEditor(input.id);
                });
            });
        })
        .catch(error => {
            console.error('Error al crear el editor:', error);
        });

</script>

@endsection
