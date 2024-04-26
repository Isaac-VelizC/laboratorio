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
                <h3>Paciente {{ isset($cliente->user->nombres) ? $cliente->user->nombres . ' '. $cliente->user->apellido_pa. ' '. $cliente->user->apellido_ma : 'N/A'}}</h3>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-body">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-auto">
                            <img src="{{ $cliente->user->avatar ? asset('storage/'.$cliente->user->avatar) : asset('imgs/'. ($cliente->gender === 'Masculino' ? 2 : 1) .'.jpg') }}" alt="Imagen de Cliente" class="img-circle border bg-gradient-dark" height="200" width="200">
                        </div>
                    </div>
                    <hr>                
                    <div class="row">
                        <div class="col-md-6">
                            <dl>
                                <dt class="text-muted">Nombre</dt>
                                <dd class='pl-4 fw-bold'>{{ isset($cliente->user->nombres) ? $cliente->user->nombres . ' '. $cliente->user->apellido_pa. ' '. $cliente->user->apellido_ma : 'N/A'}}</dd>
                                <dt class="text-muted">Sexo</dt>
                                <dd class='pl-4 fw-bold'>{{ isset($cliente->gender) ? $cliente->gender : 'N/A'}}</dd>
                                <dt class="text-muted">Fecha de Nacimiento</dt>
                                <dd class='pl-4 fw-bold'>{{ isset($cliente->dob) ? $cliente->dob : 'N/A'}}</dd>
                                <dt class="text-muted">Teléfono</dt>
                                <dd class='pl-4 fw-bold'>{{ isset($cliente->contact ) ? $cliente->contact  : 'N/A'}}</dd>
                                <dt class="text-muted">Correo</dt>
                                <dd class='pl-4 fw-bold'>{{ isset($cliente->user->email) ? $cliente->user->email : 'N/A'}}</dd>
                                <dt class="text-muted">Dirección</dt>
                                <dd class='pl-4 fw-bold'>{{ isset($cliente->address) ? $cliente->address : 'N/A'}}</dd>
                            </dl>
                        </div>
                        <div class="col-md-6">
                            <p>Cantidad total de pruebas realizadas: {{ count($pruebas) }}</p>
                            @if ($cantidadPruebas)
                                <p>Detalle de pruebas:</p>
                                <ul>
                                    @foreach ($cantidadPruebas as $prueba => $cantidad)
                                        <li>{{ $prueba }}: {{ $cantidad }} veces</li>
                                    @endforeach
                                </ul>
                            @else
                                <p>No se encontraron pruebas realizadas para este cliente.</p>
                            @endif

                        </div>
                    </div>
                    <div class="text-right">
                        <a class="btn btn-flat btn-dark btn-sm" href="{{ route('admin.list.paciente') }}" type="button" > Cerrar</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection