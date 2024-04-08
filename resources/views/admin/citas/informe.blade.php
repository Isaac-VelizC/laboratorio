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
                            <div class="col-2 border bg-primary text-light">Código de Cita</div>
                            <div class="col-4 border">{{ isset($cita->code) ? $cita->code :"" }}</div>
                            <div class="col-2 border bg-primary text-light">Calendario</div>
                            <div class="col-4 border">{{ isset($cita->fecha) ? $cita->fecha.' '.$cita->horario :"" }}</div>    
                            <div class="col-2 border bg-primary text-light">Nombre Paciente</div>
                            <div class="col-6 border">{{ isset($cliente) ? $cliente->user->nombres .' '. $cliente->user->apellido_pa.' '. $cliente->user->apellido_ma :"" }}</div>
                            <div class="col-2 border bg-primary text-light">Cedula Identidad</div>
                            <div class="col-2 border">{{ isset($cliente) ? $cliente->user->ci :"" }}</div>
                            <div class="col-1 border bg-primary text-light">Sexo</div>
                            <div class="col-2 border">{{ isset($cliente) ? $cliente->gender :"" }}</div>
                            <div class="col-2 border bg-primary text-light">Fecha Nacimiento</div>
                            <div class="col-2 border">{{ isset($cliente) ? $cliente->dob :"" }}</div>
                            <div class="col-1 border bg-primary text-light">Correo</div>
                            <div class="col-4 border">{{ isset($cliente) ? $cliente->user->email :"" }}</div>
                            <div class="col-2 border bg-primary text-light">Dirección</div>
                            <div class="col-4 border">{{ isset($cliente) ? $cliente->address :"" }}</div>
                            <div class="col-2 border bg-primary text-light">Teléfono</div>
                            <div class="col-4 border">{{ isset($cliente) ? $cliente->contact :"" }}</div>
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
<button onclick="generarPDF()">Generar PDF</button>

    <script>
        // Crear el editor de texto
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error('Error al crear el editor:', error);
            });

        // Función para generar el PDF
        function generarPDF() {
            // Capturar el contenido del editor
            var contenido = document.querySelector('.ck-editor__editable').innerHTML;

            // Crear un nuevo documento PDF
            var doc = new jsPDF();

            // Insertar el contenido en el PDF
            doc.html(contenido, {
                callback: function(doc) {
                    // Descargar el PDF
                    doc.save('documento.pdf');
                }
            });
        }
    </script>

@endsection
