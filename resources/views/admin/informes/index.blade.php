@extends('layouts.app')

@section('content')

@if(session('message'))
       <div id="myAlert" class="alert alert-left alert-success alert-dismissible fade show mb-3 alert-fade" role="alert">
           <span>{{ session('message') }}</span>
           <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
       </div>
   @endif

<div id="error"></div> <!-- Contenedor para mostrar los resultados -->
<div class="content py-5">
    <div class="card card-outline card-primary rounded-0 shadow">
        <div class="card-header">
            <p class="font-weight-bold text-lg">Informes sobre las pruebas por fechas</p>
        </div>
        <div class="card-body">
            <div class="container-fluid">
                <form id="informeForm" action="{{ route('admin.informe1.info1') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <div class="row">
                            <div class="col-1 border bg-gradient-primary text-light">Prueba</div>
                            <div class="col-3 border">
                                <select class="form-control" style="border: none;" name="prueba" id="prueba" required>
                                    <option value="" disabled selected>Seleccionar una Prueba</option>
                                    @foreach ($pruebas as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-1 border bg-gradient-primary text-light">Mes</div>
                            <div class="col-3 border">
                                <input type="month" class="form-control" style="border: none;" name="mes" id="mes">
                            </div>
                            <div class="col-1 border bg-gradient-primary text-light">Fecha</div>
                            <div class="col-3 border">
                                <input type="date" class="form-control" style="border: none;" name="fecha" id="fecha">
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-4 text-center">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="tipo" id="inlineradio1" value="1" checked>
                            <label class="form-check-label" for="inlineradio1">Solo Pruebas</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="tipo" id="inlineradio2" value="2">
                            <label class="form-check-label" for="inlineradio2">Pruebas con Clientes</label>
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

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
    function buscarInformes() {
        // Obtener los datos del formulario
        var formData = new FormData(document.getElementById("informeForm"));
        var fecha = document.getElementById("fecha").value;
        var mes = document.getElementById("mes").value;
        var prueba = document.getElementById("prueba").value;

        // Verificar si ambos campos están vacíos
        if (fecha === "" && mes === "") {
            alert("Debes llenar al menos uno de los campos de fecha o mes.");
            return false; // Detener el envío del formulario
        }
        axios.post('/admin/informes1/info', formData)
            .then(function (response) {
                var resultados = response.data.data;

                // Verificar si la lista de resultados está vacía
                if (resultados.length === 0) {
                    // Si la lista está vacía, mostrar un mensaje
                    document.getElementById("resultados").innerHTML = '<h3>No se encontraron resultados.</h3>';
                    return;
                }

                // Construir la presentación de los resultados en la tabla
                var htmlResultados = '<h3>Resultados del informe:</h3>';
                htmlResultados += '<table class="table table-striped table-bordered">';
                htmlResultados += '<thead>';
                htmlResultados += '<tr class="bg-gradient-primary text-light">';

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
                var htmlError = '<div id="myAlert" class="alert alert-left alert-danger alert-dismissible fade show mb-3 alert-fade" role="alert">';
                htmlError += '<span>' + errorMessage + '</span>';
                htmlError += '<button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>';
                htmlError += '</div>';
                // Mostrar el mensaje de error en el contenedor
                document.getElementById("error").innerHTML = htmlError;
            });

    }
</script>


@endsection
