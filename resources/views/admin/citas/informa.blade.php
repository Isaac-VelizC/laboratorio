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
            <form method="POST" action="{{ route('admin.guardar.informe') }}">
                @csrf
                <div class="container-fluid" id="outprint">
                    <div class="row">
                        <div class="col-2 border bg-gradient-primary text-light">Nombre Paciente</div>
                        <div class="col-10 border">{{ isset($cliente) ? $cliente->user->nombres .' '. $cliente->user->apellido_pa.' '. $cliente->user->apellido_ma :"" }}</div>
                        <div class="col-1 border bg-gradient-primary text-light">Sexo</div>
                        <div class="col-3 border">{{ isset($cliente) ? $cliente->gender :"" }}</div>
                        <div class="col-1 border bg-gradient-primary text-light">Teléfono</div>
                        <div class="col-3 border">{{ isset($cliente) ? $cliente->contact :"" }}</div>
                        <div class="col-1 border bg-gradient-primary text-light">Correo</div>
                        <div class="col-3 border">{{ isset($cliente) ? $cliente->user->email :"" }}</div>
                        <div class="col-2 border bg-gradient-primary text-light">Dirección</div>
                        <div class="col-10 border">{{ isset($cliente) ? $cliente->address :"" }}</div>
                    </div>
                </div>
                <input type="hidden" name="cita" value="{{ $cliente->id }}">
                <input type="hidden" name="prueba" value="{{ $prueba->id }}">
                <div class="form-group">
                    <label for="name" class="control-label">Formulario</label>
                    <textarea rows="3" name="description" id="descriptionInforme" class="form-control form-control-sm rounded-0">{{ $prueba->description }}</textarea>
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

@endsection
