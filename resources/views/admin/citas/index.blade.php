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
                <h3>Lista de Citas Reservadas</h3>
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
							<th>Fecha de Cita</th>
							<th>Código</th>
							<th>Paciente</th>
							<th>Prueba</th>
							<th>Estado</th>
                            <tr></tr>
                        </tr>
                    </thead>
                    <tbody>
						@foreach ($citas as $item)
							<tr>
								<td class="text-center">{{ $i++ }}</td>
								<td>{{ $item->fecha }} - {{ $item->horario }}</td>
								<td>{{ $item->code }}</td>
								<td><p class="m-0 truncate-1">{{ $item->client->user->nombres }} {{ $item->client->user->apellido_pa }} {{ $item->client->user->apellido_ma }}</p></td>
								<td>
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
												echo '<span class="badge bg-secondary ">Pendiente</span>';
												break;
											case 1:
												echo '<span class="badge bg-primary ">Aprobado</span>';
												break;
											case 2:
												echo '<span class="badge bg-warning ">Muestra Recogida</span>';
												break;
                                            case 3:
												echo '<span class="badge bg-info ">Unir Pdfs</span>';
												break;
											case 4:
												echo '<span class="badge bg-success ">Finalizado</span>';
												break;
										}
									?>
								</td>
								<td class="text-center">
                                    <div class="flex align-items-center">
                                        <a class="px-1" href="{{ route('admin.cita.show', $item->id) }}">
                                            <i class="bi bi-eye"></i>
                                        </a>
										@if ($item->status <= 1 && auth()->user()->type != 2)
                                            <a class="px-1" href="{{ route('admin.cita.edit.page', $item->id) }}">
                                                <i class="bi bi-pen"></i>
                                            </a>
                                            <a class="px-1" href="javascript:void(0)" onclick="confirmDelete({{ $item->id }})" data-bs-toggle="modal" data-bs-backdrop="false" data-bs-target="#modal-confirmacion">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        @endif
                                    </div>
                                </td>
							</tr>
						@endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="modal-confirmacion">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Confirmación</h4>
            </div>
            <form id="deleteForm" method="post" action="{{ route('admin.citas.delete') }}">
                @csrf
                @method('DELETE')
                <input type="hidden" name="id" value="">
                <div class="modal-body">
                    <p>¿Estás seguro de eliminar este usuario de forma permanente?</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Continuar</button>
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function confirmDelete(userId) {
        // Actualizar el valor del campo 'id' en el formulario antes de mostrar el modal
        $('#modal-confirmacion').find('input[name="id"]').val(userId);
    }
</script>
@endsection
