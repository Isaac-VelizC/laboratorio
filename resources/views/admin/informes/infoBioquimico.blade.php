@extends('layouts.app')
@section('content')

<div class="page-heading">
    @if(session('message'))
        <div class="alert alert-success alert-dismissible show fade">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div id="error"></div>
    <!-- Basic Vertical form layout section start -->
    <section id="basic-vertical-layouts">
        <div class="row match-height">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Pruebas Finalizadas por bioquimico</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="container-fluid">
                                <form id="informeForm" action="{{ route('admin.informe1.info22') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-2 border bg-primary text-light">Bioquimico</div>
                                            <div class="col-md-3 border">
                                                <select class="form-control" style="border: none;" name="bioquimico" id="bioquimico">
                                                    <option value="" disabled selected>Seleccionar Bioquimico</option>
                                                    @foreach ($bioquimicos as $item)
                                                        <option value="{{ $item->id }}">{{ $item->nombres }} {{ $item->apellido_pa }} {{ $item->apellido_ma }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-1 border bg-primary text-light">Prueba</div>
                                            <div class="col-md-2 border">
                                                <select class="form-control" style="border: none;" name="prueba" id="prueba" required>
                                                    <option value="" disabled selected>Seleccionar una Prueba</option>
                                                    @foreach ($pruebas as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-1 border bg-primary text-light">Mes</div>
                                            <div class="col-md-3 border">
                                                <input type="month" class="form-control" style="border: none;" name="mes" id="mes">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="flex text-center">
                                        <button type="reset" class="btn btn-danger mr-4">Cancelar</button>
                                        <button type="button" class="btn btn-primary -ml-4" onclick="buscarInformes()">Buscar</button>
                                    </div>
                                </form>
                                <hr>
                                <div id="resultados"></div> <!-- Contenedor para mostrar los resultados -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<script>
    function buscarInformes() {
        // Obtener los datos del formulario
        var formData = new FormData(document.getElementById("informeForm"));
        var bioquimico = document.getElementById("bioquimico").value;
        var mes = document.getElementById("mes").value;
        var prueba = document.getElementById("prueba").value;

        axios.post('/admin/informes2/info', formData)
            .then(function (response) {
                var resultados = response.data.data;

                // Verificar si la lista de resultados está vacía
                if (resultados.length === 0) {
                    // Si la lista está vacía, mostrar un mensaje
                    document.getElementById("resultados").innerHTML = '<h3 class="text-center">No se encontraron resultados.</h3>';
                    return;
                }

                // Construir la presentación de los resultados en la tabla
                var htmlResultados = '<h3>Resultados del informe:</h3>';
                htmlResultados += '<table class="table table-striped table-bordered">';
                htmlResultados += '<thead>';
                htmlResultados += '<tr class="bg-primary text-light">';

                // Obtener los nombres de los campos del primer resultado
                var campos = Object.keys(resultados[0]);

                // Iterar sobre los nombres de los campos y construir las columnas de la tabla
                campos.forEach(function (campo) {
                    htmlResultados += '<th>' + campo + '</th>';
                });

                htmlResultados += '</tr>';
                htmlResultados += '</thead>';
                htmlResultados += '<tbody>';

                // Iterar sobre los resultados y construir las filas de la tabla
                resultados.forEach(function (resultado) {
                    htmlResultados += '<tr>';
                    campos.forEach(function (campo) {
                        htmlResultados += '<td>' + resultado[campo] + '</td>';
                    });
                    htmlResultados += '</tr>';
                });

                htmlResultados += '</tbody>';
                htmlResultados += '</table>';

                // Actualizar el contenido del contenedor de resultados
                document.getElementById("resultados").innerHTML = htmlResultados;
            })
            .catch(function (error) {
                // Obtener el mensaje de error del objeto de error
                var errorMessage = error.response.data.error;
                // Construir el mensaje de error
                var htmlError = '<div class="alert alert-danger alert-dismissible show fade">';
                htmlError += '<span>' + errorMessage + '</span>';
                htmlError += '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                htmlError += '</div>';
                // Mostrar el mensaje de error en el contenedor
                document.getElementById("error").innerHTML = htmlError;
            });
    }
</script>
@endsection
