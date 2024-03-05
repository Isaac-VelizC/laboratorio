@extends('layouts.app')
@section('content')
<style>
    .img-thumb-path{
        width:100px;
        height:80px;
        object-fit:scale-down;
        object-position:center center;
    }
</style>
<div class="card card-outline card-primary rounded-0 shadow">
	<div class="card-header">
		<h3 class="card-title">Lista de Citas Reservadas</h3>
	</div>
	<div class="card-body">
        <div class="container-fluid">
			<table class="table table-bordered table-hover table-striped">
				<colgroup>
					<col width="5%">
					<col width="15%">
					<col width="10%">
					<col width="20%">
					<col width="30%">
					<col width="10%">
					<col width="10%">
				</colgroup>
				<thead>
					<tr class="bg-gradient-primary text-light">
						<th>#</th>
						<th>Fecha de Creación</th>
						<th>Código</th>
						<th>Paciente</th>
						<th>Prueba</th>
						<th>Estado</th>
						<th>Acción</th>
					</tr>
				</thead>
				<tbody>
                    @foreach ($citas as $item)
						<tr>
							<td class="text-center">{{ $i++ }}</td>
							<td class="">{{ date("Y-m-d H:i",strtotime($item->created_at)) }}</td>
							<td class="">{{ $item->code }}</td>
							<td class=""><p class="m-0 truncate-1">{{ $item->client->user->nombres }} {{ $item->client->user->apellido_pa }} {{ $item->client->user->apellido_ma }}</p></td>
							<td class="">
								<p class="m-0 truncate-1">
									@foreach ($item->pruebas as $h)
									{{ $h->test->name }},
									@endforeach
								</p>
							</td>
							<td class="text-center">
								<?php 
									switch ($item->status){
										case 0:
											echo '<span class="rounded-pill badge badge-secondary ">Pendiente</span>';
											break;
										case 1:
											echo '<span class="rounded-pill badge badge-primary ">Aprobado</span>';
											break;
										case 2:
											echo '<span class="rounded-pill badge badge-warning ">Muestra Recogida</span>';
											break;
										case 3:
											echo '<span class="rounded-pill badge badge-primary bg-teal ">Entregado al laboratorio</span>';
											break;
										case 4:
											echo '<span class="rounded-pill badge badge-success ">Finalizado</span>';
											break;
										case 5:
											echo '<span class="rounded-pill badge badge-danger ">Cancelado</span>';
											break;
										case 6:
											echo '<span class="rounded-pill badge-success badge border text-dark ">Informe subido</span>';
											break;
									}
								?>
							</td>
							<td align="center">
								<button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
										Acción
									<span class="sr-only">Toggle Dropdown</span>
								</button>
								<div class="dropdown-menu" role="menu">
									<a class="dropdown-item" href="{{ route('admin.cita.show', $item->id) }}" data-id ="{{ $item->id }}"><span class="fa fa-eye text-dark"></span> Ver</a>
									@can('Cliente')
										<div class="dropdown-divider"></div>
										<a class="dropdown-item edit_data" href="javascript:void(0)" data-id ="{{ $item->id }}"><span class="fa fa-edit text-primary"></span> Editar</a>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item delete_data" href="javascript:void(0)" data-id="{{ $item->id }}"><span class="fa fa-trash text-danger"></span> Eliminar</a>
									@endcan
								</div>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection