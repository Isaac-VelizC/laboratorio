@extends('layouts.app')
@section('content')
<div class="page-heading">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible show fade">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible show fade">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <!-- Basic Vertical form layout section start -->
    <section id="basic-vertical-layouts">
        <div class="row match-height">
            <div class="col-md-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Editar Paciente {{ $cliente->user->nombres }}</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-vertical" method="POST" action="{{ route('cliente.update.perfil', $cliente->user_id) }}">
                                @csrf
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <input type="text" name="nombres" id="name" placeholder="Nombre" value="{{ $cliente->user->nombres }}" autofocus required class="form-control form-control-sm form-control-border @error('name') is-invalid @enderror">
                                            <small class="mx-2">Nombres</small>
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <input type="text" name="apellido_pa" id="apellido_pa" value="{{ $cliente->user->apellido_pa }}" placeholder="Primer Apellido" class="form-control form-control-sm form-control-border @error('apellido_pa') is-invalid @enderror" required>
                                            <small class="mx-2">Primer Apellido</small>
                                            @error('apellido_pa')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <input type="text" name="apellido_ma" id="apellido_ma" value="{{ $cliente->user->apellido_ma}}" placeholder="Segundo Apellido (Opcional)" class="form-control form-control-sm form-control-border @error('apellido_ma') is-invalid @enderror">
                                            <small class="mx-2">Segundo Apellido</small>
                                            @error('apellido_ma')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <input type="text" name="ci" id="ci" placeholder="CI" value="{{ $cliente->user->ci }}" required class="form-control form-control-sm form-control-border @error('ci') is-invalid @enderror">
                                            <small class="mx-2">Cedula de Itentidad</small>
                                            @error('ci')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <select name="gender" id="gender" class="form-control form-control-sm form-control-border @error('gender') is-invalid @enderror" required>
                                                <option value="Masculino" @if ($cliente->gender == 'Masculino') selected @endif>Masculino</option>
                                                <option value="Femenino" @if ($cliente->gender == 'Male') selected @endif>Femenino</option>
                                            </select>
                                            <small class="mx-2">Sexo</small>
                                            @error('gender')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>                        
                                        <div class="form-group col-md-4">
                                            <input type="date" name="dob" id="dob" value="{{ $cliente->dob }}" placeholder="(opcional)" required class="form-control form-control-sm form-control-border @error('dob') is-invalid @enderror">
                                            <small class="mx-2">Fecha de Nacimiento</small>
                                            @error('dob')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <input type="text" name="contact" id="contact" value="{{ $cliente->contact }}" class="form-control form-control-sm form-control-border @error('contact') is-invalid @enderror">
                                            <small class="mx-2">Teléfono</small>
                                            @error('contact')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <input name="address" id="address" rows="3" value="{{ $cliente->address }}" class="form-control form-control-sm rounded-0 @error('address') is-invalid @enderror">
                                            <small class="mx-2">Dirección</small>
                                            @error('address')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <input type="email" name="email" id="email" value="{{ $cliente->user->email }}" placeholder="Correo" class="form-control form-control-sm form-control-border">
                                            <small class="mx-2">Correo</small>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <input type="text" name="name" id="username" value="{{ $cliente->user->name }}" placeholder="Username" required class="form-control form-control-sm form-control-border @error('username') is-invalid @enderror">
                                            <small class="mx-2">Username</small>
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-4">
                                            <input type="password" name="password" id="password" class="form-control form-control-sm form-control-border" autocomplete="off">
                                            <small class="mx-2"><i>Deja esto en blanco si no desea cambiar la contraseña</i></small>
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                    <a type="button" class="btn btn-default" href="{{ route('admin.list.paciente') }}">Cancelar</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection