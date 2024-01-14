@extends('layouts.app')
@section('content')
<style>
    .img-avatar{
        width:45px;
        height:45px;
        object-fit:cover;
        object-position:center center;
        border-radius:100%;
    }
</style>
@if(session('success'))
       <div id="myAlert" class="alert alert-left alert-success alert-dismissible fade show mb-3 alert-fade" role="alert">
           <span>{{ session('success') }}</span>
           <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
       </div>
   @endif
   @if(session('error'))
       <div id="myAlert" class="alert alert-left alert-danger alert-dismissible fade show mb-3 alert-fade" role="alert">
           <span>{{ session('error') }}</span>
           <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
       </div>
   @endif
<div class="card card-outline card-primary">
	<div class="card-header">
		<h3 class="card-title">Lista de Usuarios</h3>
		<div class="card-tools">
			<a href="{{ route('admin.user.create') }}" class="btn btn-flat btn-primary"><span class="fas fa-plus"></span> Nuevo</a>
		</div>
	</div>
	<div class="card-body">
		<div class="container-fluid">
        <div class="container-fluid">
			<table id="example1" class="table table-hover table-striped">
				<thead>
					<tr>
						<th>#</th>
						<th>Avatar</th>
						<th>Nombre</th>
						<th>Cedula de Identidad</th>
						<th>Tipo de Usuario</th>
						<th>Acción</th>
					</tr>
				</thead>
				<tbody>
                    @foreach ($users as $item)
                        <tr>
                            <td class="text-center">{{ $i++ }}</td>
                            <td class="text-center"><img src="{{ $item->avatar ? asset('storage/'.$item->avatar) : asset('dist/img/default.png') }}" class="img-avatar img-thumbnail p-0 border-2" alt="user_avatar"></td>
                            <td>{{ $item->nombres }} {{ $item->apellido_pa }} {{ $item->apellido_ma }}</td>
                            <td ><p class="m-0 truncate-1">{{ $item->ci }} </p></td>
							<td ><p class="m-0"> {{ $item->type == 1 ? "Administrador" : "Bioquimico"}}</p></td>
                            <td align="center">
                                <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                        Acción
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu" role="menu">
                                    <a class="dropdown-item" href="{{ route('admin.user.edit', $item->id) }}"><span class="fa fa-edit text-primary"></span> Editar</a>
                                    <div class="dropdown-divider"></div>
                                    @if ($item->status != 1)
                                        <a class="dropdown-item verify_user" href="javascript:void(0)" data-id="{{ $item->id }}"  data-name="{{ $item->name }}"><span class="fa fa-check text-primary"></span> Verificar</a>
                                        <div class="dropdown-divider"></div>
                                    @endif
                                    <a class="dropdown-item delete_data" href="javascript:void(0)" onclick="confirmDelete({{ $item->id }})" data-toggle="modal" data-target="#modal-default">
                                        <span class="fa fa-trash text-danger"></span> Eliminar
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
				</tbody>
			</table>
		</div>
		</div>
	</div>
</div>

<!-- Modal de confirmación con botón de confirmación -->
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Confirmación</h4>
            </div>
            <form id="deleteForm" method="post" action="{{ route('admin.user.delete') }}">
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
        $('#modal-default').find('input[name="id"]').val(userId);
    }
</script>

@endsection
