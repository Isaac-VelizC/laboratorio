@extends('layouts.app')

@section('content')

<div class="card card-outline card-primary">
    <div class="card-body">
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
        <div class="container-fluid">
            <div id="msg"></div>
            <form action="{{ route('cliente.update.perfil', $cliente->user->id) }}" method="POST" enctype="multipart/form-data" id="manage-user">
                @csrf  
                <input type="hidden" name="id" value="{{ $user->id }}">
                <div class="row">
                    <div class="form-group col-md-4">
                        <input type="text" name="nombres" id="nombres" placeholder="Nombre" autofocus required class="form-control form-control-sm form-control-border" value="{{ isset($user->nombres) ? $user->nombres : '' }}">
                        <small class="mx-2">Nombre</small>
                    </div>
                    <div class="form-group col-md-4">
                        <input type="text" name="apellido_pa" id="apellido_pa" placeholder="(opcional)" class="form-control form-control-sm form-control-border" value="{{ isset($user->apellido_pa) ? $user->apellido_pa : '' }}">
                        <small class="mx-2">Segundo Nombre</small>
                    </div>
                    <div class="form-group col-md-4">
                        <input type="text" name="apellido_ma" id="apellido_ma" placeholder="Apellido" required class="form-control form-control-sm form-control-border" value="{{ isset($user->apellido_ma) ? $user->apellido_ma : '' }}">
                        <small class="mx-2">Apellido</small>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-4">
                        <input type="text" name="ci" id="ci" required class="form-control form-control-sm form-control-border" value="{{ isset($user->ci) ? $user->ci : '' }}">
                        <small class="mx-2">Cedula de Itentidad</small>
                    </div>
                    <div class="form-group col-md-4">
                        <select name="gender" id="gender" class="form-control form-control-sm form-control-border" required>
                            <option value="Masculino" {{ isset($cliente->gender) && $cliente->gender =='Masculino' ? 'selected' : '' }}>Masculino</option>
                            <option value="Femenino" {{ isset($cliente->gender) && $cliente->gender =='Femenino' ? 'selected' : '' }}>Femenino</option>
                        </select>
                        <small class="mx-2">Sexo</small>
                    </div>
                    <div class="form-group col-md-4">
                        <input type="date" name="dob" id="dob" placeholder="(optional)" required class="form-control form-control-sm form-control-border"  value="{{ isset($cliente->dob) ? $cliente->dob : '' }}">
                        <small class="mx-2">Fecha de Nacimiento</small>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-4">
                        <input type="text" name="address" id="address" class="form-control form-control-sm rounded-0" value="{{ isset($cliente->address) ? $cliente->address : '' }}">
                        <small class="mx-2">Dirección</small>
                    </div>
                    <div class="form-group col-md-4">
                        <input type="text" name="contact" id="contact" placeholder="+57-3XX-XXXXXXX" required class="form-control form-control-sm form-control-border" value="{{ isset($cliente->contact) ? $cliente->contact : '' }}">
                        <small class="mx-2">Teléfono</small>
                    </div>
                    <div class="form-group col-md-4">
                        <input type="text" name="name" id="name" required class="form-control form-control-sm form-control-border" value="{{ isset($cliente->user->name) ? $cliente->user->name : '' }}">
                        <small class="mx-2">Username</small>
                    </div>
                </div>
                <div class="row">
                      <div class="form-group col-md-4">
                        <input type="email" name="email" id="email" placeholder="correo@mail.com" required class="form-control form-control-sm form-control-border" value="{{ isset($user->email) ? $user->email : '' }}">
                        <small class="mx-2">Correo electrónico</small>
                    </div>
                      <div class="form-group col-md-4">
                        <input type="password" name="password" id="password" class="form-control form-control-sm form-control-border">
                        <small class="mx-2">Contraseña</small>
                    </div>
                      <div class="form-group col-md-4">
                        <input type="password" name="cpass" id="cpass" class="form-control form-control-sm form-control-border">
                        <small class="mx-2">Confirmar Contraseña</small>
                    </div>
                </div>
                <small class="text-muted">Deja los campos de Contraseña en blanco si no desea actualizar su contraseña.</small>
                  <div class="form-group">
                      <label for="" class="control-label">Avatar</label>
                      <div class="custom-file">
                        <input type="file" class="form-control" id="customFile" name="img" onchange="displayImg(this,$(this))">
                        <label class="custom-file-label" for="customFile">Seleccionar archivo</label>
                      </div>
                  </div>
                  <div class="form-group d-flex justify-content-center">
                    @if (isset($user->avatar))
                        <img src="{{ asset('storage/'.$user->avatar) }}" alt="" id="cimg" class="img-fluid img-thumbnail">
                    @else
                        <img src="{{ asset('imgs/3.png') }}" alt="" id="cimg" class="img-fluid img-thumbnail">
                    @endif
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <button type="submit" class="btn btn-sm btn-primary" form="manage-user">Actualizar</button>
                        </div>
                    </div>
            </form>
        </div>
    </div>
</div>

<style>
    img#cimg {
        height: 15vh;
        width: 15vh;
        object-fit: cover;
        border-radius: 100% 100%;
    }
</style>

<script>
	function displayImg(input,_this) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	        	$('#cimg').attr('src', e.target.result);
	        }

	        reader.readAsDataURL(input.files[0]);
	    }
	}

</script>
@endsection
