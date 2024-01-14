@extends('layouts.app')

@section('content')
<div class="card card-outline card-primary">
	<div class="card-body">
		<div class="container-fluid">
			<div id="msg"></div>
			<div class="row">
                <dl>
                    <dt class="text-muted">Nombre de Prueba</dt>
                    <dd class='pl-4 fs-4 fw-bold'>{{ isset($prueba->name) ? $prueba->name : 'N/A' }}</dd>
                    <dt class="text-muted">Costo</dt>
                    <dd class='pl-4 fs-4 fw-bold'>{{ isset($prueba->cost) ? number_format($prueba->cost,2) : '0.00' }}</dd>
                    <dt class="text-muted">Estado</dt>
                    <dd class='pl-4 fs-4 fw-bold'>
                        @if ($prueba->status == 1)
                            <span class="px-4 badge badge-primary rounded-pill">Activo</span>
                        @else
                            <span class="px-4 badge badge-danger rounded-pill">Inactivo</span>
                        @endif
                    </dd>
                </dl>
            </div>  
            <div class="row">
                <div class="col-md-12">
                    <small class="text-muted">Descripción</small>
                    <div>{!! $prueba->description !!}</div>
                </div>
            </div>
		</div>
	</div>
</div>
@endsection