@extends('layouts.app')

@section('content')
<style>
	img#cimg{
		height: 15vh;
		width: 15vh;
		object-fit: scale-down;
		border-radius: 100% 100%;
	}
	img#cimg2{
		height: 50vh;
		width: 100%;
		object-fit: contain;
	}
</style>
<div class="col-lg-12">
	<div class="card card-outline card-dark rounded-0 shadow">
		<div class="card-header">
			<h5 class="card-title">Información del Sistema</h5>
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
			<form method="POST" action="{{ route('admin.system.update') }}" id="system-frm" enctype="multipart/form-data">
				@csrf
				<div id="msg" class="form-group"></div>
				<div class="form-group">
					<label for="name" class="control-label">Nombre del Sistema</label>
					<input type="text" class="form-control form-control-sm" name="name" id="name" value="{{ $name->meta_value }}">
				</div>
				<div class="form-group">
					<label for="short_name" class="control-label">Nombre Corto del Sistema</label>
					<input type="text" class="form-control form-control-sm" name="short_name" id="short_name" value="{{ $shortname->meta_value }}">
				</div>
				<div class="form-group">
					<label for="" class="control-label">Logo del Sistema</label>
					<div class="custom-file">
					<input type="file" class="custom-file-input rounded-circle" id="customFile" name="img" onchange="displayImg(this,$(this))">
					<label class="custom-file-label" for="customFile">Seleccionar archivo</label>
					</div>
				</div>
				<div class="form-group d-flex justify-content-center">
					<img src="{{ $logo->meta_value ? asset('storage/'.$logo->meta_value) : asset('dist/img/avata-1.png') }}" alt="" id="cimg" class="img-fluid img-thumbnail">
				</div>
				<div class="form-group">
					<label for="" class="control-label">Publicidad</label>
					<div class="custom-file">
					<input type="file" class="custom-file-input rounded-circle" id="customFile" name="cover[]" multiple>
					<label class="custom-file-label" for="customFile">Escoger Archivo</label>
					</div>
				</div>
				<div class="form-group">
					<label for="" class="control-label">Publicidad</label>
					<div class="custom-file">
					  <input type="file" class="custom-file-input rounded-circle" id="customFile" name="cover[]" onchange="displayImg2(this,$(this))" multiple>
					  <label class="custom-file-label" for="customFile">Escoger Archivo</label>
					</div>
				</div>
				<div class="form-group d-flex justify-content-center">
					@php
						$files = \App\Models\ImagenFile::all();
					@endphp
					@foreach ($files as $file)
						<img src="{{ asset('storage/publicidad/'.$file->path) }}" alt="" id="cimg2" class="img-fluid img-thumbnail bg-gradient-dark border-dark">
					@endforeach
				</div>
			</form>
		</div>
		<div class="card-footer">
			<div class="col-md-12">
				<div class="row">
					<button class="btn btn-sm btn-primary" form="system-frm">Actualizar</button>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	function displayImg(input,_this) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	        	$('#cimg').attr('src', e.target.result);
	        	_this.siblings('.custom-file-label').html(input.files[0].name)
	        }

	        reader.readAsDataURL(input.files[0]);
	    }
	}
	function displayImg2(input,_this) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	        	_this.siblings('.custom-file-label').html(input.files[0].name)
	        	$('#cimg2').attr('src', e.target.result);
	        }

	        reader.readAsDataURL(input.files[0]);
	    }
	}
	function displayImg3(input,_this) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	        	_this.siblings('.custom-file-label').html(input.files[0].name)
	        	$('#cimg3').attr('src', e.target.result);
	        }

	        reader.readAsDataURL(input.files[0]);
	    }
	}
	$(document).ready(function(){
		 $('.summernote').summernote({
		        height: '60vh',
		        toolbar: [
		            [ 'style', [ 'style' ] ],
		            [ 'font', [ 'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear'] ],
		            [ 'fontname', [ 'fontname' ] ],
		            [ 'fontsize', [ 'fontsize' ] ],
		            [ 'color', [ 'color' ] ],
		            [ 'para', [ 'ol', 'ul', 'paragraph', 'height' ] ],
		            [ 'table', [ 'table' ] ],
					['insert', ['link', 'picture']],
		            [ 'view', [ 'undo', 'redo', 'fullscreen', 'codeview', 'help' ] ]
		        ]
		    })
	})
</script>
<script>
    let count = 0; // Iniciar en 0 para evitar el primer salto
    document.getElementById("radio1").checked = true;

    setInterval(nextImage, 5000);

    function nextImage() {
        count++;
        if (count >= 4) {
            count = 0;
        }
        let transformValue = "translateX(" + (-count * 25) + "%)";
        document.querySelector(".slides").style.transform = transformValue;
    }
</script>
@endsection