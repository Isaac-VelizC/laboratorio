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
                <input type="hidden" name="cita" value="{{ $cita->id }}" required>
                <input type="hidden" name="prueba" value="{{ $prueba->id }}" required>
                <br>
                <div class="row">
                    @foreach ($inputs as $item)
                        @php
                            $cleanedName = str_replace('@', '', $item->name);
                        @endphp
                        <div class="form-group col-3">
                            <label for="{{ $cleanedName }}" class="control-label">{{ $cleanedName }}</label>
                            <input class="form-control form-control-border" required 
                                type="{{ $item->type }}"
                                name="{{ $item->name }}"
                                id="{{ $item->name }}"
                                placeholder="{{ $cleanedName }}"
                                onchange="guardarValores()"
                            />
                        </div>
                    @endforeach
                </div>
                <input type="hidden" name="valoresInputs" id="valoresInputs" required>
                <input type="hidden" name="description" value="{{ $formulario }}" required>
                <div class="col-md-12">
                    <div class="row">
                        <button class="btn btn-sm btn-primary" type="submit">Guardar</button>
                        <a class="btn btn-sm btn-danger" type="button" href="{{ route('admin.cita.show', $cita->id) }}">cerrar</a>
                    </div>
                </div>
                <div class="d-flex justify-content-center align-items-center">
                    <div id="editor" style="width: 21cm; height: 29.7cm; border: 1px solid black;">{!! $formulario !!}</div>
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
        })
        .catch(error => {
            console.error('Error al crear el editor:', error);
        });
    function guardarValores() {
        var valores = {};

        // Obtener todos los inputs dentro del bucle foreach
        var inputs = document.querySelectorAll('.form-group.col-3 input');

        inputs.forEach(function(input) {
            valores[input.name] = input.value;
        });

        // Establecer los valores en el campo oculto
        document.getElementById('valoresInputs').value = JSON.stringify(valores);
    }

</script>


@endsection
