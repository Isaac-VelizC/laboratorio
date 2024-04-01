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
                <h3>CREAR PRUEBA</h3>
            </div>
        </div>
    </div>    
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Code Toolbar</h4>
                    </div>
                    <div class="card-body">
                        <form id="formulario" method="POST" action="{{ route('admin.new.prueba') }}">
                            @csrf
                                <div class="row">
                                    <div class="form-group col-4">
                                        <label for="name" class="control-label">Nombre</label>
                                        <input type="text" name="name" id="name" class="form-control form-control-border" placeholder="Ingresar nombre" value ="" required>
                                    </div>
                                    <div class="form-group col-4">
                                        <label for="cost" class="control-label">Precio</label>
                                        <input type="number" step="any" name="cost" id="cost" class="form-control form-control-border text-right" value ="" required>
                                    </div>
                                    <div class="form-group col-4">
                                        <label for="status" class="control-label">Estado</label>
                                        <select name="status" id="status" class="form-control form-control-border" placeholder="Enter test Name" required>
                                            <option value="1">Activo</option>
                                            <option value="0">Inactivo</option>
                                        </select>
                                    </div>
                                    <!--input type="hidden" id="contenidoInput" name="description" value=""-->
                                    <input type="hidden" id="valores" name="valores" value="">
                                </div>
                                <div class="form-group">
                                    <label for="name" class="control-label">Formulario</label>
                                    <textarea name="description" id="dark" cols="30" rows="10"></textarea>
                                </div>
                            <button  id="enviarFormulario" type="submit" class="btn btn-primary">Guardar</button>
                            <button type="button" class="btn btn-default">Cancelar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>  
    </section>
</div>
    <!--script src="{{ asset('assets/vendor/ckeditor5/build/ckeditor.js')}}"></script-->
<script>
    document.addEventListener('DOMContentLoaded', function() {
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
    });
</script>
        
@endsection
