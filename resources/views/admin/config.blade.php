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
	<div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Información del Sistema</h3>
            </div>
        </div>
    </div>
	<section class="section">
        <div class="card">
			<div class="card-body">
				<form class="form form-vertical" method="POST" action="{{ route('admin.system.update') }}" id="system-frm" enctype="multipart/form-data">
					@csrf
					<div class="form-body">
						<div class="row">
							<div class="col-md-4">
								<div class="form-group has-icon-left">
									<label for="first-name-icon">Nombre del Sistema</label>
									<div class="position-relative">
										<input type="text" class="form-control" name="name" id="name" value="{{ $name->meta_value }}">
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group has-icon-left">
									<label for="first-name-icon">Nombre Corto del Sistema</label>
									<div class="position-relative">
										<input type="text" class="form-control" name="short_name" id="short_name" value="{{ $shortname->meta_value }}">
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group has-icon-left">
									<label for="first-name-icon">Logo del Sistema</label>
									<div class="position-relative">
										<input type="file" class="form-control" id="customFile" name="img" onchange="displayImg(this,$(this))">
									</div>
								</div>
							</div>
							<div class="form-group d-flex justify-content-center">
								<img src="{{ $logo->meta_value ? asset('storage/'.$logo->meta_value) : asset('dist/img/avata-1.png') }}" alt="" id="cimg" class="img-fluid img-thumbnail">
							</div>
							<div class="col-md-4">
								<div class="form-group has-icon-left">
									<label for="first-name-icon">Publicidad</label>
									<div class="position-relative">
										<input type="file" class="form-control" id="customFile" name="cover[]" multiple>
									</div>
								</div>
							</div>
							<div class="card-footer">
								<div class="text-center">
									<button type="submit" class="btn btn-primary me-1 mb-1">Actualizar</button>
								</div>
							</div>
							
						</div>
					</div>
					<div>
						@php
							$files = \App\Models\ImagenFile::all();
						@endphp
						@foreach ($files as $file)
							<img src="{{ asset('storage/publicidad/'.$file->path) }}" alt="" width="250" height="250" class="img-fluid img-thumbnail bg-gradient-dark border-dark">
							<a href="{{ route('admin.delete.img', $file->id) }}" class="btn btn-link">
								<i class="bi bi-trash"></i>
							</a>
						@endforeach
					</div>
				</form>
			</div>
		</div>
	</section>
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
