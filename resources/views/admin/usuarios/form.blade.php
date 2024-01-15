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
			<form method="POST" action="{{ $isEditing ? route('admin.user.update', $user->id) : route('admin.user.store') }}" enctype="multipart/form-data">
                @csrf
				<div class="row">
                    <div class="form-group col-4">
                        <label for="nombres">Nombres</label>
                        <input type="text" name="nombres" id="nombres" class="form-control" value="{{ $isEditing ? $user->nombres : '' }}" required>
                    </div>
                    <div class="form-group col-4">
                        <label for="apellido_pa">Primer Apellido</label>
                        <input type="text" name="apellido_pa" id="apellido_pa" class="form-control" value="{{ $isEditing ? $user->apellido_pa : '' }}" required>
                    </div>
                    <div class="form-group col-4">
                        <label for="apellido_ma">Segundo Apellido (Opcional)</label>
                        <input type="text" name="apellido_ma" id="apellido_ma" class="form-control" value="{{ $isEditing ? $user->apellido_ma : '' }}">
                    </div>
                    <div class="form-group col-4">
                        <label for="ci">Cedula De Identidad</label>
                        <input type="text" name="ci" id="ci" class="form-control" value="{{ $isEditing ? $user->ci : '' }}" required>
                    </div>
                    <div class="form-group col-4">
                        <label for="email">E-mail</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ $isEditing ? $user->email : '' }}" required>
                    </div>
                    <div class="form-group col-4">
                        <label for="name">Usuario</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $isEditing ? $user->name : '' }}" required>
                    </div>
                    <div class="form-group col-4">
                        <label for="password">Contraseña</label>
                        <input type="password" name="password" id="password" class="form-control" value="" autocomplete="off" {{ $isEditing ? '' : 'required' }}>
                        @if ($isEditing)
                            <small class="text-info"><i>Deja esto en blanco si no desea cambiar la contraseña</i></small>
                        @endif
                    </div>
                    <div class="form-group col-4">
                        <label for="type">Tipo de Usuario</label>
                        <select name="type" id="type" class="custom-select"  required>
                            <option value="1" {{ $isEditing && $user->type == 1 ? 'selected' : '' }}>Administrador</option>
                            <option value="2" {{ $isEditing && $user->type == 2 ? 'selected' : '' }}>Bioquimico</option>
                        </select>
                    </div>
                    <div class="form-group col-4">
                        <label for="" class="control-label">Avatar</label>
                        <div class="custom-file">
                        <input type="file" class="custom-file-input rounded-circle" id="customFile" name="img" onchange="displayImg(this,$(this))">
                        <label class="custom-file-label" for="customFile">Seleccionar archivo</label>
                        </div>
                    </div>
                </div>
				<div class="form-group col-12 d-flex justify-content-center">
					<img src="{{ $isEditing && $user->avatar ? asset('storage/'.$user->avatar) : asset('dist/img/default.png') }}" alt="" id="cimg" class="img-fluid img-thumbnail">
				</div>
                <div class="card-footer">
                    <div class="col-md-12">
                        <div class="row">
                            <button class="btn btn-sm btn-primary mr-2" type="submit">Guardar</button>
                            <a class="btn btn-sm btn-secondary" href="{{ route('admin.list.user') }}">Salir</a>
                        </div>
                    </div>
                </div>
			</form>
		</div>
	</div>
</div>
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