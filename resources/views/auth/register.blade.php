@extends('layouts.app')

@section('content')
@php
    $name = \App\Models\SystemInfo::find(1);
    $logo = \App\Models\SystemInfo::find(5);
@endphp
<div id="auth">
    <div class="row h-100">
        <div class="col-lg-6 d-none d-lg-block">
            <div><br><br><br><br><br><br><br>
                <center><img src="{{ $logo->meta_value ? asset('storage/'.$logo->meta_value) : asset('dist/img/avata-1.png') }}" height="100" width="100" alt="" class="avatar"></center>
                <h1 class="text-center py-5 login-title"><b>{{ $name->meta_value }}</b></h1>
            </div>
        </div>
        <div class="col-lg-6 col-12">
            <div id="auth-left">
                <p class="auth-subtitle mb-5 text-center">Formulario de Registro.</p>
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-4">
                            <input type="text" name="name" id="name" placeholder="Nombre" autofocus required class="form-control @error('name') is-invalid @enderror">
                            <small class="mx-2">Nombres</small>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <input type="text" name="apellido_pa" id="apellido_pa" placeholder="Primer Apellido" class="form-control @error('apellido_pa') is-invalid @enderror">
                            <small class="mx-2">Primer Apellido</small>
                            @error('apellido_pa')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <input type="text" name="apellido_ma" id="apellido_ma" placeholder="Segundo Apellido (Opcional)" class="form-control @error('apellido_ma') is-invalid @enderror">
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
                            <input type="text" name="ci" id="ci" placeholder="" required class="form-control @error('ci') is-invalid @enderror">
                            <small class="mx-2">Cedula de Itentidad</small>
                            @error('ci')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <select name="gender" id="gender" class="form-control @error('gender') is-invalid @enderror" required>
                                <option value="Masculino">Masculino</option>
                                <option value="Femenino">Femenino</option>
                            </select>
                            <small class="mx-2">Sexo</small>
                            @error('gender')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <input type="date" name="dob" id="dob" placeholder="(opcional)" required class="form-control @error('dob') is-invalid @enderror">
                            <small class="mx-2">Fecha de Nacimiento</small>
                            @error('dob')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <input type="text" name="contact" id="contact" placeholder="" required class="form-control @error('contact') is-invalid @enderror">
                            <small class="mx-2">Teléfono</small>
                            @error('contact')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <input name="address" id="address" rows="3" class="form-control @error('address') is-invalid @enderror">
                            <small class="mx-2">Dirección</small>
                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <input type="email" name="email" id="email" placeholder="correo" required class="form-control @error('email') is-invalid @enderror">
                            <small class="mx-2">Correo</small>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                            <small class="mx-2">Contraseña</small>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            <small class="mx-2">Confirma Contraseña</small>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-8">
                            <a href="{{ route('login') }}">¿Ya tienes una cuenta?</a>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Regístrate</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
