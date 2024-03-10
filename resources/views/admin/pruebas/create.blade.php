@extends('layouts.app')
@section('content')
<div class="card card-outline card-primary rounded-0 shadow">
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
	<div class="card-header">
		<h2 class="text-center text-bold">CREAR PRUEBA</h2>
	</div>
	<div class="card-body">
		<div class="container-fluid">
            <form id="formulario" method="POST" action="{{ route('admin.new.prueba') }}">
                @csrf
                    <div class="row">
                        <div class="form-group col-4">
                            <label for="name" class="control-label">Nombre</label>
                            <input type="text" name="name" id="name" class="form-control form-control-border" placeholder="Ingresar nombre" value ="" required>
                        </div>
                        <div class="form-group col-4">
                            <label for="cost" class="control-label">Precio</label>
                            <input type="number" step="any" name="cost" id="cost" class="form-control form-control-border text-right" value ="" required>
                        </div>
                        <div class="form-group col-4">
                            <label for="status" class="control-label">Estado</label>
                            <select name="status" id="status" class="form-control form-control-border" placeholder="Enter test Name" required>
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
                        </div>
                        <input type="hidden" id="contenidoInput" name="description" value="">
                        <input type="hidden" id="valores" name="valores" value="">
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Formulario</label>
                        <div id="editor">
                            <table style="width: 100%; border-collapse: collapse; text-align:center;">
                                <tbody>
                                    <tr>
                                        <td>Doctor</td>
                                        <td>F. Petición</td>
                                        <td>Edad</td>
                                        <td>N° Historia</td>
                                    </tr>
                                    <tr>
                                        <td> &nbsp; #nombreDoctor</td>
                                        <td> &nbsp; #ePeticion</td>
                                        <td> &nbsp; #edad</td>
                                        <td> &nbsp; #nHistoria</td>
                                    </tr>
                                    <tr>
                                        <td>Nombre del Paciente</td>
                                        <td>N° Asegurado</td>
                                        <td>Sexo</td>
                                        <td>N° Consulta</td>
                                    </tr>
                                    <tr>
                                        <td> &nbsp; #paciente</td>
                                        <td> &nbsp; #asegurado</td>
                                        <td> &nbsp; #sexo</td>
                                        <td> &nbsp; #consulta</td>
                                    </tr>
                                    <tr>
                                        <td> Origén</td>
                                        <td> Entidad</td>
                                        <td> Cliente</td>
                                        <td> N° Orden</td>
                                    </tr>
                                    <tr>
                                        <td><strong>LABORATORIO PEREZ</strong></td>
                                        <td><strong>LABORATORIO PEREZ</strong></td>
                                        <td> &nbsp; #cliente</td>
                                        <td> &nbsp; #nOrden</td>
                                    </tr>
                                </tbody>
                            </table>
                            <br>
                            <table style="width: 100%;">
                                <tbody>
                                    <tr><td><strong>Inmunología</strong></td></tr>
                                    <tr>
                                        <td>Determinación</td>
                                        <td style="text-align:center;">Resultado</td>
                                        <td style="text-align:center;">Unidades</td>
                                        <td style="text-align:center;">Valores de Referencia</td>
                                        <td style="text-align:center;">!</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Resultado Toxoplasmosis IgM</strong></td>
                                        <td style="text-align: center;"><strong>&nbsp; @resultadoIgM &nbsp;</strong></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Cut Off</td>
                                        <td style="text-align: center;"><strong>&nbsp; @resultadoCutOffIgM&nbsp;</strong></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Conclusión</td>
                                        <td colspan="4"><strong>La muestra&nbsp; @estadoIgM &nbsp;presenta Anticuerpos de tipo IgM contra Toxoplasma Gondii.</strong></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Resultado Toxoplasmosis IgG</strong></td>
                                        <td style="text-align: center;"><strong>&nbsp; @resultadoIgG &nbsp;</strong></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Cut Off</td>
                                        <td style="text-align: center;"><strong>&nbsp; @resultadoCutOffIgG &nbsp;</strong></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Conclusión</td>
                                        <td colspan="4"><strong>La muestra&nbsp; @estadoIgM &nbsp;presenta Anticuerpos de tipo IgG contra Toxoplasma Gondii.</strong></td>
                                    </tr>
                                    <tr>
                                        <td colspan="5"><strong>YIH Prueba Rápida</strong></td>
                                    </tr>
                                    <tr>
                                        <td colspan="5">&nbsp;Método: Prueba Rápida de detección de anticuerpos contra VIH.</td>
                                    </tr>
                                    <tr>
                                        <td colspan="5" style="text-align: center;"><strong>&nbsp; @resultadoVIH &nbsp; contra el virus de inmunodeficiencia humana.</strong></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Reagina Plasmática Rápida. (R.P.R.)</strong></td>
                                    </tr>
                                    <tr>
                                        <td colspan="5">Método: Aglutinación Látex cuantitativo.</td>
                                    </tr>
                                    <tr>
                                        <td colspan="5" style="text-align: center;"><strong>&nbsp; @estadoFinal</strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <button type="submit" class="btn btn-primary">Guardar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            </form>
		</div>
	</div>
</div>
    <script src="{{ asset('assets/vendor/ckeditor5/build/ckeditor.js')}}"></script>
    <script>
        var valoresExtraidos = []; // Variable global para almacenar los valores extraídos
        ClassicEditor
            .create(document.querySelector('#editor'))
            .then(editor => {
                window.editor = editor;
                // Actualiza la variable global cada vez que cambie el contenido del editor
                editor.model.document.on('change:data', () => {
                    const contenido = editor.getData();
                    // Extrae los valores con '@' del contenido del editor y los guarda en la variable global
                    valoresExtraidos = contenido.match(/@[\w\d]+/g) || [];
                    document.getElementById('contenidoInput').value = contenido;
                });
            })
            .catch(error => {
                console.error('Error al crear el editor:', error);
            });
        // Manejador de eventos para el botón de enviar del formulario
        document.getElementById('formulario').addEventListener('submit', function() {
            // Actualiza el valor del campo oculto con los valores extraídos
            document.getElementById('valores').value = valoresExtraidos.join(',');
        });
    </script>
@endsection
