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
                        <h4 class="card-title">Informaación del Usuario</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-vertical" method="POST" action="{{ $isEditing ? route('admin.user.update', $user->id) : route('admin.user.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group has-icon-left">
                                                <label for="first-name-icon">Nombres</label>
                                                <div class="position-relative">
                                                    <input type="text" name="nombres" id="nombres" class="form-control" value="{{ $isEditing ? $user->nombres : '' }}" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group has-icon-left">
                                                <label for="first-name-icon">Primer Apellido</label>
                                                <div class="position-relative">
                                                    <input type="text" name="apellido_pa" id="apellido_pa" class="form-control" value="{{ $isEditing ? $user->apellido_pa : '' }}" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group has-icon-left">
                                                <label for="first-name-icon">Segundo Apellido</label>
                                                <div class="position-relative">
                                                    <input type="text" name="apellido_ma" id="apellido_ma" class="form-control" value="{{ $isEditing ? $user->apellido_ma : '' }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group has-icon-left">
                                                <label for="first-name-icon">Cedula de Identidad</label>
                                                <div class="position-relative">
                                                    <input type="text" name="ci" id="ci" class="form-control" value="{{ $isEditing ? $user->ci : '' }}" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group has-icon-left">
                                                <label for="first-name-icon">Correo Electronico</label>
                                                <div class="position-relative">
                                                    <input type="email" name="email" id="email" class="form-control" value="{{ $isEditing ? $user->email : '' }}" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group has-icon-left">
                                                <label for="first-name-icon">Nombre de Usuario</label>
                                                <div class="position-relative">
                                                    <input type="text" name="name" id="name" class="form-control" value="{{ $isEditing ? $user->name : '' }}" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group has-icon-left">
                                                <label for="first-name-icon">Contraseña</label>
                                                <div class="position-relative">
                                                    <input type="password" name="password" id="password" class="form-control" value="" autocomplete="off" {{ $isEditing ? '' : 'required' }}>
                                                </div>
                                                @if ($isEditing)
                                                    <small class="text-info"><i>Deja esto en blanco si no desea cambiar la contraseña</i></small>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group has-icon-left">
                                                <label for="first-name-icon">Tipo de usuario</label>
                                                <div class="position-relative">
                                                    <select name="type" id="type" class="form-select"  required>
                                                        <option value="2" {{ $isEditing && $user->type == 2 ? 'selected' : '' }}>Bioquimico</option>
                                                        <option value="1" {{ $isEditing && $user->type == 1 ? 'selected' : '' }}>Administrador</option>
                                                    </select>                                                
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group has-icon-left">
                                                <label for="first-name-icon">Avatar</label>
                                                <div class="position-relative">
                                                    <input type="file" class="form-control" id="customFile" name="img" onchange="displayImg(this,$(this))">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-12 d-flex justify-content-center">
                                            <img src="{{ $isEditing && $user->avatar ? asset('storage/'.$user->avatar) : asset('imgs/3.png') }}" alt="" id="cimg" class="img-fluid img-thumbnail">
                                        </div>
                                        <br>
                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Guardar</button>
                                            <a href="{{ route('admin.list.user') }}" class="btn btn-light-secondary me-1 mb-1">Salir</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- // Basic Vertical form layout section end -->
<style>
	img#cimg{
		height: 15vh;
		width: 15vh;
		object-fit: cover;
		border-radius: 100% 100%;
	}
</style>
<script>
    $(function(){
		$('.select2').select2({
			width:'resolve'
		})
	})
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