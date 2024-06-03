@extends('layouts.app')
@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>

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
    @include('admin.citas.pagos')
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Formulario de prueba</h3>
            </div>  
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-body">
                <div class="container-fluid" id="outprint">
                    <form method="POST" action="{{ auth()->user()->type == 1 ? route('admin.guardar.admin') : route('admin.guardar.informe') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-2 border bg-primary text-light">Código de Cita</div>
                            <div class="col-md-4 border">{{ isset($cita->code) ? $cita->code :"" }}</div>
                            <div class="col-md-2 border bg-primary text-light">Calendario</div>
                            <div class="col-md-4 border">{{ isset($cita->fecha) ? $cita->fecha.' '.$cita->horario :"" }}</div>    
                            <div class="col-md-2 border bg-primary text-light">Nombre Paciente</div>
                            <div class="col-md-6 border">{{ isset($cliente) ? $cliente->user->nombres .' '. $cliente->user->apellido_pa.' '. $cliente->user->apellido_ma :"" }}</div>
                            <div class="col-md-2 border bg-primary text-light">Cedula Identidad</div>
                            <div class="col-md-2 border">{{ isset($cliente) ? $cliente->user->ci :"" }}</div>
                            <div class="col-md-1 border bg-primary text-light">Sexo</div>
                            <div class="col-md-2 border">{{ isset($cliente) ? $cliente->gender :"" }}</div>
                            <div class="col-md-2 border bg-primary text-light">Fecha Nacimiento</div>
                            <div class="col-md-2 border">{{ isset($cliente) ? $cliente->dob :"" }}</div>
                            <div class="col-md-1 border bg-primary text-light">Correo</div>
                            <div class="col-md-4 border">{{ isset($cliente) ? $cliente->user->email :"" }}</div>
                            <div class="col-md-2 border bg-primary text-light">Dirección</div>
                            <div class="col-md-4 border">{{ isset($cliente) ? $cliente->address :"" }}</div>
                            <div class="col-md-2 border bg-primary text-light">Teléfono</div>
                            <div class="col-md-4 border">{{ isset($cliente) ? $cliente->contact :"" }}</div>
                        </div>
                        @if (auth()->user()->type == 2)
                            <input type="hidden" name="codigo" value="{{ $cita->code }}">
                        @endif
                        <input type="hidden" name="cita" value="{{ $cita->id }}" required>
                        <input type="hidden" name="prueba" value="{{ $prueba->id }}" required>
                        <br>
                        <div for="name" class="control-label" style="color: #168a82">
                            <p>Nota: Para llenar el formulario (Los campos para llenar que terminen en <strong>S</strong> para texto, <strong>N</strong> para números)</p>
                            <div class="text-center"> <!-- Div para centrar el contenido -->
                                <div class="w-md-50 mx-auto"> <!-- Div con el contenido -->
                                    <table class="table" style="border-collapse: collapse; width: 100%;">
                                        <thead style="background-color: #168a82; color: white;">
                                            <tr>
                                                <th style="padding: 8px;">Tipo</th>
                                                <th style="padding: 8px;">Ejemplo</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td style="padding: 8px; background-color: #f4f4f4;">Texto, String</td>
                                                <td style="padding: 8px; background-color: #e6f7f6;">@valorS</td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 8px; background-color: #f4f4f4;">Numérico, Decimal</td>
                                                <td style="padding: 8px; background-color: #e6f7f6;">@valorN</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @foreach ($inputs as $item)
                                @php
                                    $cleanedName = str_replace('@', '', $item->name);
                                @endphp
                                <div class="form-group col-md-3">
                                    <label for="{{ $cleanedName }}" class="control-label">{{ $cleanedName }}</label>
                                    <input class="form-control form-control-border" required 
                                        type="{{ $item->type }}"
                                        name="{{ $item->name }}"
                                        id="{{ $item->name }}"
                                        placeholder="{{ $cleanedName }}"
                                        onchange="guardarValores()"
                                        @if ($item->type == 'number') step="any" @endif
                                    />
                                </div>
                            @endforeach
                        </div>
                        <input type="hidden" name="valoresInputs" id="valoresInputs" required>
                        <input type="hidden" name="description" value="{{ $formulario }}" required>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="text-center">
                                    <button class="btn btn-sm btn-primary" type="submit">Guardar</button>
                                    <a class="btn btn-sm btn-danger" type="button" href="{{ route('admin.cita.show', $cita->id) }}">cerrar</a>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="d-flex justify-content-center align-items-center">
                            <div id="editor" style="width: 21cm; height: 29.7cm; border: 1px solid black;">{!! $formulario !!}</div>
                        </div>                
                    </form>
                    <hr>
                </div>
            </div>
        </div>
    </section>
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
        var inputs = document.querySelectorAll('.form-group.col-md-3 input');

        inputs.forEach(function(input) {
            valores[input.name] = input.value;
        });

        // Establecer los valores en el campo oculto
        document.getElementById('valoresInputs').value = JSON.stringify(valores);
    }

</script>

@endsection
