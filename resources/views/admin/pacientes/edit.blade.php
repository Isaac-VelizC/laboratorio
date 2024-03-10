@extends('layouts.app')
@section('content')
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
<div class="card card-outline card-primary">
	<div class="card-body">
		<div class="container-fluid">
			<div id="msg"></div>
			<form method="POST" action="{{ route('cliente.update.perfil', $cliente->user_id) }}">
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
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a type="button" class="btn btn-default" href="{{ route('admin.list.paciente') }}">Cancelar</a>
                </div>
            </form>
		</div>
	</div>
</div>
@endsection