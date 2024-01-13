@extends('layouts.app')

@section('content')
<style>
    html, body {
        height: 100% !important;
        width: 100% !important;
    }

    body {
        background-size: cover;
        background-repeat: no-repeat;
    }

    .login-title {
        text-shadow: 2px 2px black;
    }

    #login {
        flex-direction: flex !important;
    }

    #logo-img {
        height: 150px;
        width: 150px;
        object-fit: scale-down;
        object-position: center center;
        border-radius: 100%;
    }

    #login .col-7,
    #login .col-5 {
        width: 100% !important;
        max-width: unset !important;
    }
</style>
<div class="h-100 d-flex align-items-center w-100" id="login">
    <div class="col-7 h-100 d-flex align-items-center justify-content-center">
        <div class="w-100">
            <center><img src="logo" alt="" id="logo-img"></center>
            <h1 class="text-center py-5 login-title"><b>Sistema de Laboratorio Clínico</b></h1>
        </div>
    </div>
    <div class="col-5 h-100">
        <div class="d-flex w-100 h-100 justify-content-center align-items-center">
            <div class="card col-lg-10 card-outline card-primary rounded-0 shadow">
                <div class="card-header rounded-0">
                    <h4 class="text-dark text-center"><b>Formulario de Registro</b></h4>
                </div>
                <div class="card-body rounded-0 text-dark">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-4">
                                <input type="text" name="name" id="name" placeholder="Nombre" autofocus required class="form-control form-control-sm form-control-border @error('name') is-invalid @enderror">
                                <small class="mx-2">Nombres</small>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <input type="text" name="middlename" id="middlename" placeholder="Primer Apellido" class="form-control form-control-sm form-control-border @error('middlename') is-invalid @enderror">
                                <small class="mx-2">Primer Apellido</small>
                                @error('middlename')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <input type="text" name="lastname" id="lastname" placeholder="Segundo Apellido (Opcional)" required class="form-control form-control-sm form-control-border @error('lastname') is-invalid @enderror">
                                <small class="mx-2">Segundo Apellido</small>
                                @error('lastname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <select name="gender" id="gender" class="form-control form-control-sm form-control-border @error('gender') is-invalid @enderror" required>
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
                                <input type="date" name="dob" id="dob" placeholder="(opcional)" required class="form-control form-control-sm form-control-border @error('dob') is-invalid @enderror">
                                <small class="mx-2">Fecha de Nacimiento</small>
                                @error('dob')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <input type="text" name="contact" id="contact" placeholder="" required class="form-control form-control-sm form-control-border @error('contact') is-invalid @enderror">
                                <small class="mx-2">Teléfono</small>
                                @error('contact')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <small class="mx-2">Dirección</small>
                                <input name="address" id="address" rows="3" class="form-control form-control-sm rounded-0 @error('address') is-invalid @enderror">
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-10">
                                <input type="email" name="email" id="email" placeholder="correo" required class="form-control form-control-sm form-control-border @error('email') is-invalid @enderror">
                                <small class="mx-2">Correo</small>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-10">
                                <input id="password" type="password" class="form-control form-control-sm form-control-border @error('password') is-invalid @enderror" name="password" required>
                                <small class="mx-2">Contraseña</small>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-10">
                                <input id="password-confirm" type="password" class="form-control form-control-sm form-control-border" name="password_confirmation" required>
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
</div>
@endsection
