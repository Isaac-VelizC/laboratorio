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
    @include('clients.citas.modal_new')
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Lista de mis Citas</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <div class="float-start float-lg-end">
                    <button id="create_new" class="btn btn-flat btn-sm btn-primary" data-bs-toggle="modal" data-bs-backdrop="false" data-bs-target="#modal-lg"> Nueva Cita</button>
                </div>
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
                            <th>Fecha de Creación</th>
                            <th>Código</th>
                            <th>Prueba</th>
                            <th>Estado</th>
                            <tr></tr>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($citas as $item)
                            <tr>
                                <td class="text-center">{{ $i++ }}</td>
                                <td>{{ date("Y-m-d H:i",strtotime($item->created_at)) }}</td>
                                <td>{{ $item->code }}</td>
                                <td>
                                    @foreach ($item->pruebas as $h)
                                    <p class="m-0 truncate-1">{{ $h->test->name }}, </p>
                                    @endforeach
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
                                            echo '<span class="badge bg-warning ">Muestra Recolectada</span>';
                                            break;
                                        case 3:
                                            echo '<span class="badge bg-primary bg-teal ">Entregado al laboratorio</span>';
                                            break;
                                        case 4:
                                            echo '<span class="badge bg-success ">Finalizada</span>';
                                            break;
                                        case 5:
                                            echo '<span class="badge bg-danger ">Cancelada</span>';
                                            break;
										case 6:
											echo '<span class="badge lg-success ">Informe subido</span>';
											break;
									}
								?>
                                </td>
                                <td class="text-center">
                                    <div class="flex align-items-center">
                                        <a class="px-1" href="{{ route('admin.cita.show', $item->id) }}">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        @if ($item->status <= 1)
                                            <a class="px-2" href="{{ route('admin.cita.edit.page', $item->id) }}">
                                                <span class="bi bi-pen"></span>
                                            </a>
                                            <a class="px-2" href="javascript:void(0)" onclick="confirmDelete({{ $item->id }})" data-bs-toggle="modal" data-bs-backdrop="false" data-bs-target="#modal-confirmacion">
                                                <span class="bi bi-trash"></span>
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

@include('clients.citas.modal_new')
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

<script>
    // Obtenemos la fecha actual en formato yyyy-mm-dd
    var fechaActual = new Date().toISOString().split('T')[0];
    // Asignamos la fecha actual al atributo min del elemento input
    document.getElementById('date').setAttribute('min', fechaActual);
</script>

@endsection