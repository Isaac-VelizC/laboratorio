@extends('layouts.app')

@section('content')
<div class="card card-outline card-primary rounded-0 shadow">
	<div class="card-header">
		<h3 class="card-title">Lista de Resultados de mis Pruebas</h3>
	</div>
	<div class="card-body">
		<div class="container-fluid">
			<table id="example1" class="table table-bordered table-hover table-striped">
				<colgroup>
					<col width="5%">
					<col width="25%">
					<col width="25%">
					<col width="25%">
					<col width="20%">
				</colgroup>
				<thead>
					<tr class="bg-gradient-primary text-light">
						<th>#</th>
						<th>Código</th>
						<th>Prueba</th>
						<th>Resultados</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					@foreach ($citas as $item)
						<tr>
							<td class="text-center">{{ $i++ }}</td>
							<td class="">{{ $item->code }}</td>
							<td class=""><p class="m-0 truncate-1">Prueba</p></td>
							<td class="">
								<a href='' target='_blank' download='{{ $item->code }}.pdf'>{{ $item->code }}.pdf</a>
							</td>
							<td align="center">
								<a href='' target='_blank' class="text-muted"><i class="fa fa-eye"></i> <b>Ver</b></a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection
