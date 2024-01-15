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
<div class="card card-outline card-primary rounded-0 shadow">
	<div class="card-header">
		<h3 class="card-title">Lista de Pacientes</h3>
	</div>
	<div class="card-body">
		<div class="container-fluid">
        <div class="container-fluid">
			<table id="example1" class="table table-bordered table-hover table-striped">
				<colgroup>
					<col width="5%">
					<col width="20%">
					<col width="25%">
					<col width="30%">
					<col width="10%">
					<col width="10%">
				</colgroup>
				<thead>
					<tr class="bg-gradient-primary text-light">
						<th>#</th>
						<th>Fecha de Registro</th>
						<th>Nombre</th>
						<th>Correo electrónico</th>
						<th>Teléfono</th>
						<th>Acción</th>
					</tr>
				</thead>
				<tbody>
                    @foreach ($pacientes as $item)
                        <tr>
                            <td class="text-center">{{ $i++ }}</td>
                            <td class="">{{ $item->created_at }}</td>
                            <td class=""><p class="m-0 truncate-1">{{ $item->user->nombres }} {{ $item->user->apellido_pa }} {{ $item->user->apellido_pa }}</p></td>
                            <td class=""><p class="m-0 truncate-1">{{ $item->user->email }}</p></td>
                            <td class=""><p class="m-0 truncate-1">{{ $item->contact }}</p></td>
                            <td align="center">
                                <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                        Acción
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu" role="menu">
                                    <a class="dropdown-item view_data" href="javascript:void(0)" data-toggle="modal" data-target="#modal_show_paciente{{$item->id}}"><span class="fa fa-eye text-dark"></span> Ver</a>
                                    @if (auth()->user()->type == 3)
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item delete_data" href="javascript:void(0)" onclick="confirmDelete({{ $item->id }})" data-toggle="modal" data-target="#modal-confirmacion">
                                            <span class="fa fa-trash text-danger"></span> Eliminar
                                        </a>
                                    @endif
								</div>
                            </td>
                        </tr>
						@include('admin.pacientes.show')
                    @endforeach
				</tbody>
			</table>
		</div>
		</div>
	</div>
</div>
<div class="modal fade" id="modal-confirmacion">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Confirmación</h4>
            </div>
            <form id="deleteForm" method="post" action="{{ route('admin.paciente.delete') }}">
                @csrf
                @method('DELETE')
                <input type="hidden" name="id" value="">
                <div class="modal-body">
                    <p>¿Estás seguro de eliminar este usuario de forma permanente?</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Continuar</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
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