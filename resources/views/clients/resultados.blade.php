@extends('layouts.app')
@section('content')

<div class="page-heading">
    @if(session('message'))
        <div class="alert alert-success alert-dismissible show fade">
            {{ session('message') }}
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
                <h3>Lista de Resultados de mis Pruebas</h3>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>#</th>
							<th>Código</th>
							<th>Prueba</th>
							<th>Resultados</th>
                            <tr></tr>
                        </tr>
                    </thead>
                    <tbody>
						@foreach ($citas as $item)
							<tr>
								<td class="text-center">{{ $i++ }}</td>
								<td>{{ $item->code }}</td>
								<td>
									@foreach ($item->pruebas as $brt)
										<p class="m-0 truncate-1">{{ $brt->test->name }}</p>
									@endforeach
								</td>
								<td>
									@foreach ($item->pruebas as $brt)
										<a href='{{ asset('storage/'.$brt->pdf) }}' target="_blank">{{ $brt->pdf }} , </a>
									@endforeach
								</td>
								<td>
									@foreach ($item->pruebas as $brt)
										<a class="btn btn-primary" href='{{ asset('storage/'.$brt->pdf) }}' download='{{ $brt->pdf }}'>Descargar</a>
									@endforeach
								</td>
							</tr>
						@endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>

@endsection