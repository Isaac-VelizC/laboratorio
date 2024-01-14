@extends('layouts.app')

@section('content')

<div class="card card-outline card-primary">
    <div class="card-body">
        <div class="container-fluid">
            <div id="msg"></div>
            <form action="" id="manage-user">  
                <input type="hidden" name="id" value="{{ $user->id }}">
                <div class="row">
                    <div class="form-group col-md-4">
                        <input type="text" name="firstname" id="firstname" placeholder="Nombre" autofocus required class="form-control form-control-sm form-control-border" value="{{ isset($user->firstname) ? $user->firstname : '' }}">
                        <small class="mx-2">Nombre</small>
                    </div>
                    <div class="form-group col-md-4">
                        <input type="text" name="middlename" id="middlename" placeholder="(opcional)" class="form-control form-control-sm form-control-border" value="{{ isset($user->middlename) ? $user->middlename : '' }}">
                        <small class="mx-2">Segundo Nombre</small>
                    </div>
                    <div class="form-group col-md-4">
                        <input type="text" name="lastname" id="lastname" placeholder="Apellido" required class="form-control form-control-sm form-control-border" value="{{ isset($user->lastname) ? $user->lastname : '' }}">
                        <small class="mx-2">Apellido</small>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-4">
                        <select name="gender" id="gender" class="form-control form-control-sm form-control-border" required>
                            <option value="Male" {{ isset($user->gender) && $user->gender =='Male' ? 'selected' : '' }}>Masculino</option>
                            <option value="Female" {{ isset($user->gender) && $user->gender =='Female' ? 'selected' : '' }}>Femenino</option>
                        </select>
                        <small class="mx-2">Sexo</small>
                    </div>
                    <div class="form-group col-md-4">
                        <input type="date" name="dob" id="dob" placeholder="(optional)" required class="form-control form-control-sm form-control-border"  value="{{ isset($user->dob) ? $user->dob : '' }}">
                        <small class="mx-2">Fecha de Nacimiento</small>
                    </div>
                    <div class="form-group col-md-4">
                        <input type="text" name="contact" id="contact" placeholder="+57-3XX-XXXXXXX" required class="form-control form-control-sm form-control-border" value="{{ isset($user->contact) ? $user->contact : '' }}">
                        <small class="mx-2">Teléfono</small>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12">
                        <small class="mx-2">Dirección</small>
                        <textarea name="address" id="address" rows="3" class="form-control form-control-sm rounded-0">{{ isset($user->address) ? $user->address : '' }}</textarea>
                    </div>
                </div>
                <div class="row">
                      <div class="form-group col-md-10">
                        <input type="email" name="email" id="email" placeholder="correo@mail.com" required class="form-control form-control-sm form-control-border" value="{{ isset($user->email) ? $user->email : '' }}">
                        <small class="mx-2">Correo electrónico</small>
                    </div>
                </div>
                <div class="row">
                      <div class="form-group col-md-10">
                        <input type="password" name="password" id="password" class="form-control form-control-sm form-control-border">
                        <small class="mx-2">Contraseña</small>
                    </div>
                </div>
                <div class="row">
                      <div class="form-group col-md-10">
                        <input type="password" name="cpass" id="cpass" class="form-control form-control-sm form-control-border">
                        <small class="mx-2">Confirmar Contraseña</small>
                    </div>
                </div>
                <small class="text-muted">Deja los campos de Contraseña en blanco si no desea actualizar su contraseña.</small>
                  <div class="form-group">
                      <label for="" class="control-label">Avatar</label>
                      <div class="custom-file">
                        <input type="file" class="custom-file-input rounded-circle" id="customFile" name="img" onchange="displayImg(this,$(this))">
                        <label class="custom-file-label" for="customFile">Seleccionar archivo</label>
                      </div>
                  </div>
                  <div class="form-group d-flex justify-content-center">
                    @if (isset($user->avatar))
                        <img src="{{ $user->avatar }}" alt="" id="cimg" class="img-fluid img-thumbnail">
                    @else
                        <img src="{{ asset('dist/img/no-image-available.png') }}" alt="" id="cimg" class="img-fluid img-thumbnail">
                    @endif
                  </div>
            </form>
        </div>
    </div>
    <div class="card-footer">
        <div class="col-md-12">
            <div class="row">
                <button class="btn btn-sm btn-primary" form="manage-user">Actualizar</button>
            </div>
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
	$('#manage-user').submit(function(e){
		e.preventDefault();
		var _this = $(this)
		$('.pop-msg').remove()
		var el = $('<div>')
			el.addClass("pop-msg alert")
			el.hide()
		if($('#password').val() != $('#cpass').val()){
			el.addClass('alert-danger')
			el.text("Password does not match")
			$('#password').focus()
			$('#password, #cpass').addClass('is-invalid');
			$('#manage-user').append(el)
			el.show('slow')
			return false;
		}
		start_loader()
		$.ajax({
			url:_base_url_+'classes/Users.php?f=save_client',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp ==1){
					location.reload()
				}else if(resp == 3){
					$('#msg').html('<div class="alert alert-danger">Correo existe actualmente</div>')
				}else{
					$('#msg').html('<div class="alert alert-danger">Ocurre un error</div>')
				}
				end_loader()
			}
		})
	})

</script>
@endsection