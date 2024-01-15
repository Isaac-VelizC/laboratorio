@extends('layouts.app')
@section('content')
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
<div class="content py-5">
    <div class="card card-outline card-primary rounded-0 shadow">
        <div class="card-header">
            <h4 class="card-title"><b>Detalles de tu Cita Reservada</b></h4>
            <div class="card-tools">
                @if ($cita->status == 4)
                    <button class="btn btn-info bg-gradient-info btn-flat btn-sm" type="button" id="upload_report"><i class="fa fa-upload"></i> Subir informe</button>
                    <button class="btn btn-danger bg-gradient-danger btn-flat btn-sm" type="button" id="upload_report"><i class="fa fa-upload"></i> Pago</button>
                @endif
                <button class="btn btn-default bg-gradient-navy btn-flat btn-sm" type="button" data-toggle="modal" data-target="#modal-estado"> Cambiar Estado</button>
                @can('Cliente')
                    <button class="btn btn-primary btn-flat btn-sm" type="button" id="edit_data"><i class="fa fa-edit"></i> Editar</button>
                    <button class="btn btn-danger btn-flat btn-sm" type="button" id="delete_data"><i class="fa fa-trash"></i> Eliminar</button>
                @endcan
                <a class="btn btn-default border btn-flat btn-sm" href="{{ route('admin.list.citas') }}" id="delete_data"><i class="fa fa-angle-left"></i> Volver</a>
            </div>
        </div>
        <div class="card-body">
            <div class="container-fluid" id="outprint">
                <div class="row">
                    <div class="col-2 border bg-gradient-primary text-light">Código de Cita</div>
                    <div class="col-4 border">{{ isset($cita->code) ? $cita->code :"" }}</div>
                    <div class="col-2 border bg-gradient-primary text-light">Calendario</div>
                    <div class="col-4 border">{{ isset($cita->schedule) ? date("M d, Y h:i A", strtotime($cita->schedule)) :"" }}</div>
                    <div class="col-2 border bg-gradient-primary text-light">Nombre Paciente</div>
                    <div class="col-10 border">{{ isset($cita->client) ? $cita->client->user->nombres .' '. $cita->client->user->apellido_pa.' '. $cita->client->user->apellido_ma :"" }}</div>
                    <div class="col-1 border bg-gradient-primary text-light">Sexo</div>
                    <div class="col-3 border">{{ isset($cita->client) ? $cita->client->gender :"" }}</div>
                    <div class="col-1 border bg-gradient-primary text-light">Teléfono</div>
                    <div class="col-3 border">{{ isset($cita->client) ? $cita->client->contact :"" }}</div>
                    <div class="col-1 border bg-gradient-primary text-light">Correo</div>
                    <div class="col-3 border">{{ isset($cita->client) ? $cita->client->user->email :"" }}</div>
                    <div class="col-2 border bg-gradient-primary text-light">Dirección</div>
                    <div class="col-10 border">{{ isset($cita->client) ? $cita->client->address :"" }}</div>
                    <div class="col-2 border bg-gradient-primary text-light">Estado</div>
                    <div class="col-4 border ">
                        <?php 
                            switch ($cita->status){
                                case 0:
                                    echo '<span class="">Pendiente</span>';
                                    break;
                                case 1:
                                    echo '<span class">Aprobado</span>';
                                    break;
                                case 2:
                                    echo '<span class">Muestra Recogida</span>';
                                    break;
                                case 3:
                                    echo '<span class="rounde">Entregado al laboratorio</span>';
                                    break;
                                case 4:
                                    echo '<span class">Finalizado</span>';
                                    break;
                                case 5:
                                    echo '<span class">Cancelado</span>';
                                    break;
                            }
                        ?>
                    </div>   
                    <div class="col-2 border bg-gradient-primary text-light">Prescripción</div>
                    <div class="col-4 border ">
                        @if (isset($cita->prescription_path))
                            <a href='#' target='_blank' download=''>{{ $cita->prescription_path }}</a>
                        @else
                            N/A
                        @endif
                    </div>                 
                    <?php if(isset($status) && $status == 6): ?>
                    <div class="col-2 border bg-gradient-primary text-light">Informe Cargado</div>
                    <div class="col-10 border ">
                        <?php if(isset($cita->code) && is_file(base_app."uploads/reports/".$cita->code.".pdf")): ?>
                            <a href='<?= base_url."uploads/reports/".$cita->code.".pdf" ?>' target='_blank' download='<?= $cita->code.".pdf" ?>'><?= $cita->code.".pdf" ?></a>
                        <?php else: ?>
                            N/A
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                </div>
                <hr>
                <fieldset>
                    <legend class="text-muted">Lista de Pruebas</legend>
                    <table class="table table-striped table-bordered">
                        <colgroup>
                            <col width="10%">
                            <col width="20%">
                            <col width="45%">
                        </colgroup>
                        <thead>
                            <tr class="bg-gradient-primary text-light">
                                <th class="text-center">#</th>
                                <th>Nombre</th>
                                <th>Costo</th>
                                <th>Llenar Informa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cita->pruebas as $item)
                                <tr>
                                    <td class="py-1 px-2 text-center">{{ $i++ }}</td>
                                    <td class="py-1 px-2">{{ $item->test->name }}</td>
                                    <td class="py-1 px-2 text-right">{{ number_format($item->test->cost ,2) }}</td>
                                    <td><a href="">Llenar</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </fieldset>
                <hr>
                <fieldset>
                    <legend class="text-muted">Historial</legend>
                    <table class="table table-striped table-bordered">
                        <colgroup>
                            <col width="10%">
                            <col width="20%">
                            <col width="40%">
                            <col width="30%">
                        </colgroup>
                        <thead>
                            <tr class="bg-gradient-primary text-light">
                                <th class="text-center">#</th>
                                <th>Fecha</th>
                                <th>Observaciones</th>
                                <th>Nuevo Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($hists as $item)
                            <tr>
                                <td class="py-1 px-2 text-center">{{ $h++ }}</td>
                                <td class="py-1 px-2">{{date("M d, Y H:i",strtotime($item->created_at))}}</td>
                                <td class="py-1 px-2">{{ $item->remarks }}</td>
                                <td class="py-1 px-2">
                                <?php 
                                    switch ($item->status){
                                        case 0:
                                            echo '<span class="">Pendiente</span>';
                                            break;
                                        case 1:
                                            echo '<span class">Aprobado</span>';
                                            break;
                                        case 2:
                                            echo '<span class">Muestra Recogida</span>';
                                            break;
                                        case 3:
                                            echo '<span class="rounde">Entregado al laboratorio</span>';
                                            break;
                                        case 4:
                                            echo '<span class">Finalizado</span>';
                                            break;
                                        case 5:
                                            echo '<span class">Cancelado</span>';
                                            break;
                                        case 6:
                                            echo '<span class">Informe Subido</span>';
                                            break;
                                    }
                                ?>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </fieldset>
            </div>
        </div>
    </div>
</div>
@include('admin.citas.modal_estado')
@endsection