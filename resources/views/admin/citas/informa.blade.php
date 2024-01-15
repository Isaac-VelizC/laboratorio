@extends('layouts.app')

@section('content')
<div class="col-lg-12">
	<div class="card card-outline card-dark rounded-0 shadow">
		<div class="card-header">
			<h5 class="card-title">Información del Sistema</h5>
		</div>
		<div class="card-body">
			<form method="POST" action="{{ route('admin.guardar.informe') }}">
                <div class="form-group">
                    <label for="name" class="control-label">Formulario</label>
                    <textarea rows="3" name="description" id="description" class="form-control form-control-sm rounded-0">{{ $prueba->description }}</textarea>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <button class="btn btn-sm btn-primary" type="submit">Guardar</button>
                    </div>
                </div>
			</form>
		</div>
	</div>
</div>
<script src="https://cdn.tiny.cloud/1/s3ijv308t7r50xn8yt1whdc04z4t01ll60glxr6y9sqq9lfo/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    

<script>
    tinymce.init({
    selector: 'textarea',
    plugins: 'ai tinycomments mentions anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed permanentpen footnotes advtemplate advtable advcode editimage tableofcontents mergetags powerpaste tinymcespellchecker autocorrect a11ychecker typography inlinecss',
    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | align lineheight | tinycomments | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
    tinycomments_mode: 'embedded',
    tinycomments_author: 'Author name',
    ai_request: (request, respondWith) => respondWith.string(() => Promise.reject("See docs to implement AI Assistant")),
  });
</script>
@endsection