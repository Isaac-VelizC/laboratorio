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
                            <figure style="width:800.0pt;">
                                <table cellspacing="0" width="743">
                                    <tbody>
                                        <tr style="height:10.65pt;">
                                            <td style="border:1.0pt solid windowtext;height:10.65pt;padding:0cm 5.4pt;vertical-align:top;width:253.05pt;" colspan="2" width="337">
                                                <p style="text-align:center;">
                                                    <span style="font-family:&quot;Arial&quot;,sans-serif;font-size:12.0pt;"><span lang="ES" dir="ltr">Doctor</span></span>
                                                </p>
                                            </td>
                                            <td style="border-bottom-style:solid;border-color:windowtext;border-left-style:none;border-right-style:solid;border-top-style:solid;border-width:1.0pt;height:10.65pt;padding:0cm 5.4pt;vertical-align:top;width:99.2pt;" width="132">
                                                <p style="text-align:center;">
                                                    <span style="font-family:&quot;Arial&quot;,sans-serif;font-size:12.0pt;"><span lang="ES" dir="ltr">E. Petición</span></span>
                                                </p>
                                            </td>
                                            <td style="border-bottom-style:solid;border-color:windowtext;border-left-style:none;border-right-style:solid;border-top-style:solid;border-width:1.0pt;height:10.65pt;padding:0cm 5.4pt;vertical-align:top;width:92.15pt;" width="123">
                                                <p style="text-align:center;">
                                                    <span style="font-family:&quot;Arial&quot;,sans-serif;font-size:12.0pt;"><span lang="ES" dir="ltr">Edad</span></span>
                                                </p>
                                            </td>
                                            <td style="border-bottom-style:solid;border-color:windowtext;border-left-style:none;border-right-style:solid;border-top-style:solid;border-width:1.0pt;height:10.65pt;padding:0cm 5.4pt;vertical-align:top;width:112.6pt;" width="150">
                                                <p style="text-align:center;">
                                                    <span style="font-family:&quot;Arial&quot;,sans-serif;font-size:12.0pt;"><span lang="ES" dir="ltr">N° Historia</span></span>
                                                </p>
                                            </td>
                                        </tr>
                                        <tr style="height:13.65pt;">
                                            <td style="border-bottom-style:solid;border-color:windowtext;border-left-style:solid;border-right-style:solid;border-top-style:none;border-width:1.0pt;height:13.65pt;padding:0cm 5.4pt;vertical-align:top;width:253.05pt;" colspan="2" width="337">
                                                <p style="text-align:center;">
                                                    &nbsp; #nombreDoctor
                                                </p>
                                            </td>
                                            <td style="border-bottom:1.0pt solid windowtext;border-left-style:none;border-right:1.0pt solid windowtext;border-top-style:none;height:13.65pt;padding:0cm 5.4pt;vertical-align:top;width:99.2pt;" width="132">
                                                <p style="text-align:center;">
                                                    &nbsp; #ePeticion
                                                </p>
                                            </td>
                                            <td style="border-bottom:1.0pt solid windowtext;border-left-style:none;border-right:1.0pt solid windowtext;border-top-style:none;height:13.65pt;padding:0cm 5.4pt;vertical-align:top;width:92.15pt;" width="123">
                                                <p style="text-align:center;">
                                                    &nbsp; #edad
                                                </p>
                                            </td>
                                            <td style="border-bottom:1.0pt solid windowtext;border-left-style:none;border-right:1.0pt solid windowtext;border-top-style:none;height:13.65pt;padding:0cm 5.4pt;vertical-align:top;width:112.6pt;" width="150">
                                                <p style="text-align:center;">
                                                    &nbsp; #nHistoria
                                                </p>
                                            </td>
                                        </tr>
                                        <tr style="height:26.7pt;">
                                            <td style="border-bottom-style:solid;border-color:windowtext;border-left-style:solid;border-right-style:solid;border-top-style:none;border-width:1.0pt;height:26.7pt;padding:0cm 5.4pt;vertical-align:top;width:253.05pt;" colspan="2" width="337">
                                                <p style="text-align:center;">
                                                    <span style="font-family:&quot;Arial&quot;,sans-serif;font-size:12.0pt;"><span lang="ES" dir="ltr">Nombre del Paciente</span></span>
                                                </p>
                                            </td>
                                            <td style="border-bottom:1.0pt solid windowtext;border-left-style:none;border-right:1.0pt solid windowtext;border-top-style:none;height:26.7pt;padding:0cm 5.4pt;vertical-align:top;width:99.2pt;" width="132">
                                                <p style="text-align:center;">
                                                    <span style="font-family:&quot;Arial&quot;,sans-serif;font-size:12.0pt;"><span lang="ES" dir="ltr">N° Asegurado</span></span>
                                                </p>
                                            </td>
                                            <td style="border-bottom:1.0pt solid windowtext;border-left-style:none;border-right:1.0pt solid windowtext;border-top-style:none;height:26.7pt;padding:0cm 5.4pt;vertical-align:top;width:92.15pt;" width="123">
                                                <p style="text-align:center;">
                                                    <span style="font-family:&quot;Arial&quot;,sans-serif;font-size:12.0pt;"><span lang="ES" dir="ltr">Sexo</span></span>
                                                </p>
                                            </td>
                                            <td style="border-bottom:1.0pt solid windowtext;border-left-style:none;border-right:1.0pt solid windowtext;border-top-style:none;height:26.7pt;padding:0cm 5.4pt;vertical-align:top;width:112.6pt;" width="150">
                                                <p style="text-align:center;">
                                                    <span style="font-family:&quot;Arial&quot;,sans-serif;font-size:12.0pt;"><span lang="ES" dir="ltr">N° Consulta</span></span>
                                                </p>
                                            </td>
                                        </tr>
                                        <tr style="height:13.65pt;">
                                            <td style="border-bottom-style:solid;border-color:windowtext;border-left-style:solid;border-right-style:solid;border-top-style:none;border-width:1.0pt;height:13.65pt;padding:0cm 5.4pt;vertical-align:top;width:253.05pt;" colspan="2" width="337">
                                                <p style="text-align:center;">
                                                    &nbsp; #paciente
                                                </p>
                                            </td>
                                            <td style="border-bottom:1.0pt solid windowtext;border-left-style:none;border-right:1.0pt solid windowtext;border-top-style:none;height:13.65pt;padding:0cm 5.4pt;vertical-align:top;width:99.2pt;" width="132">
                                                <p style="text-align:center;">
                                                    &nbsp; #asegurado
                                                </p>
                                            </td>
                                            <td style="border-bottom:1.0pt solid windowtext;border-left-style:none;border-right:1.0pt solid windowtext;border-top-style:none;height:13.65pt;padding:0cm 5.4pt;vertical-align:top;width:92.15pt;" width="123">
                                                <p style="text-align:center;">
                                                    &nbsp; #sexo
                                                </p>
                                            </td>
                                            <td style="border-bottom:1.0pt solid windowtext;border-left-style:none;border-right:1.0pt solid windowtext;border-top-style:none;height:13.65pt;padding:0cm 5.4pt;vertical-align:top;width:112.6pt;" width="150">
                                                <p style="text-align:center;">
                                                    &nbsp; #consulta
                                                </p>
                                            </td>
                                        </tr>
                                        <tr style="height:13.65pt;">
                                            <td style="border-bottom-style:solid;border-color:windowtext;border-left-style:solid;border-right-style:solid;border-top-style:none;border-width:1.0pt;height:13.65pt;padding:0cm 5.4pt;vertical-align:top;width:160.9pt;" width="215">
                                                <p style="text-align:center;">
                                                    <span style="font-family:&quot;Arial&quot;,sans-serif;font-size:12.0pt;"><span lang="ES" dir="ltr">Origén</span></span>
                                                </p>
                                            </td>
                                            <td style="border-bottom:1.0pt solid windowtext;border-left-style:none;border-right:1.0pt solid windowtext;border-top-style:none;height:13.65pt;padding:0cm 5.4pt;vertical-align:top;width:191.35pt;" colspan="2" width="255">
                                                <p style="text-align:center;">
                                                    <span style="font-family:&quot;Arial&quot;,sans-serif;font-size:12.0pt;"><span lang="ES" dir="ltr">Entidad</span></span>
                                                </p>
                                            </td>
                                            <td style="border-bottom:1.0pt solid windowtext;border-left-style:none;border-right:1.0pt solid windowtext;border-top-style:none;height:13.65pt;padding:0cm 5.4pt;vertical-align:top;width:92.15pt;" width="123">
                                                <p style="text-align:center;">
                                                    <span style="font-family:&quot;Arial&quot;,sans-serif;font-size:12.0pt;"><span lang="ES" dir="ltr">Cliente</span></span>
                                                </p>
                                            </td>
                                            <td style="border-bottom:1.0pt solid windowtext;border-left-style:none;border-right:1.0pt solid windowtext;border-top-style:none;height:13.65pt;padding:0cm 5.4pt;vertical-align:top;width:112.6pt;" width="150">
                                                <p style="text-align:center;">
                                                    <span style="font-family:&quot;Arial&quot;,sans-serif;font-size:12.0pt;"><span lang="ES" dir="ltr">N° Orden</span></span>
                                                </p>
                                            </td>
                                        </tr>
                                        <tr style="height:27.3pt;">
                                            <td style="border-bottom-style:solid;border-color:windowtext;border-left-style:solid;border-right-style:solid;border-top-style:none;border-width:1.0pt;height:27.3pt;padding:0cm 5.4pt;vertical-align:top;width:160.9pt;" width="215">
                                                <p style="text-align:center;">
                                                    <span style="font-family:&quot;Arial&quot;,sans-serif;font-size:12.0pt;"><span lang="ES" dir="ltr"><strong>LABORATORIO PEREZ</strong></span><strong></strong></span>
                                                </p>
                                            </td>
                                            <td style="border-bottom:1.0pt solid windowtext;border-left-style:none;border-right:1.0pt solid windowtext;border-top-style:none;height:27.3pt;padding:0cm 5.4pt;vertical-align:top;width:191.35pt;" colspan="2" width="255">
                                                <p style="text-align:center;">
                                                    <span style="font-family:&quot;Arial&quot;,sans-serif;font-size:12.0pt;"><span lang="ES" dir="ltr"><strong>LABORATORIO PEREZ</strong></span><strong></strong></span>
                                                </p>
                                            </td>
                                            <td style="border-bottom:1.0pt solid windowtext;border-left-style:none;border-right:1.0pt solid windowtext;border-top-style:none;height:27.3pt;padding:0cm 5.4pt;vertical-align:top;width:92.15pt;" width="123">
                                                <p style="text-align:center;">
                                                    &nbsp; #cliente
                                                </p>
                                            </td>
                                            <td style="border-bottom:1.0pt solid windowtext;border-left-style:none;border-right:1.0pt solid windowtext;border-top-style:none;height:27.3pt;padding:0cm 5.4pt;vertical-align:top;width:112.6pt;" width="150">
                                                <p style="text-align:center;">
                                                    &nbsp; #nOrden
                                                </p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </figure>
                            <p style="line-height:90%;"> &nbsp; </p>
                            <figure style="width:800.8pt;">
                                <table cellspacing="0" cellpadding="0" width="745">
                                    <tbody>
                                        <tr style="height:22.7pt;">
                                            <td style="height:22.7pt;padding:0cm 5.4pt;vertical-align:top;width:558.8pt;" colspan="6" width="745">
                                                <p style="text-align:justify;">
                                                    <span style="font-family:&quot;Arial&quot;,sans-serif;font-size:12.0pt;"><span lang="ES" dir="ltr">Inmunología</span></span>
                                                </p>
                                            </td>
                                        </tr>
                                        <tr style="height:22.7pt;">
                                            <td style="background-color:#F2F2F2;height:22.7pt;padding:0cm 5.4pt;vertical-align:top;width:218.45pt;" colspan="2" width="291">
                                                <p style="text-align:justify;">
                                                    <span style="color:black;font-family:&quot;Arial&quot;,sans-serif;font-size:12.0pt;"><span lang="ES" dir="ltr"><strong><u>Determinación</u></strong></span></span><span style="font-family:&quot;Arial&quot;,sans-serif;font-size:12.0pt;"><strong></strong></span>
                                                </p>
                                            </td>
                                            <td style="background-color:#F2F2F2;height:22.7pt;padding:0cm 5.4pt;vertical-align:top;width:92.85pt;" width="124">
                                                <p style="text-align:center;">
                                                    <span style="color:black;font-family:&quot;Arial&quot;,sans-serif;font-size:12.0pt;"><span lang="ES" dir="ltr"><u>Resultado</u></span></span><span style="font-family:&quot;Arial&quot;,sans-serif;font-size:12.0pt;"></span>
                                                </p>
                                            </td>
                                            <td style="background-color:#F2F2F2;height:22.7pt;padding:0cm 5.4pt;vertical-align:top;width:77.9pt;" width="104">
                                                <p style="text-align:center;">
                                                    <span style="color:black;font-family:&quot;Arial&quot;,sans-serif;font-size:12.0pt;"><span lang="ES" dir="ltr"><u>Unidades</u></span></span><span style="font-family:&quot;Arial&quot;,sans-serif;font-size:12.0pt;"></span>
                                                </p>
                                            </td>
                                            <td style="background-color:#F2F2F2;height:22.7pt;padding:0cm 5.4pt;vertical-align:top;width:140.55pt;" width="187">
                                                <p style="text-align:center;">
                                                    <span style="color:black;font-family:&quot;Arial&quot;,sans-serif;font-size:12.0pt;"><span lang="ES" dir="ltr"><u>Valores de Referencia</u></span></span><span style="font-family:&quot;Arial&quot;,sans-serif;font-size:12.0pt;"></span>
                                                </p>
                                            </td>
                                            <td style="background-color:#F2F2F2;height:22.7pt;padding:0cm 5.4pt;vertical-align:top;width:29.05pt;" width="39">
                                                <p style="text-align:center;">
                                                    <span style="color:black;font-family:&quot;Arial&quot;,sans-serif;font-size:12.0pt;"><span lang="ES" dir="ltr"><u>!</u></span></span><span style="font-family:&quot;Arial&quot;,sans-serif;font-size:12.0pt;"></span>
                                                </p>
                                            </td>
                                        </tr>
                                        <tr style="height:22.7pt;">
                                            <td style="height:22.7pt;padding:0cm 5.4pt;vertical-align:top;width:218.45pt;" colspan="2" width="291">
                                                <p style="text-align:justify;">
                                                    <span style="font-family:&quot;Arial&quot;,sans-serif;font-size:12.0pt;"><span lang="ES" dir="ltr">Resultado Toxoplasmosis IgM</span></span>
                                                </p>
                                            </td>
                                            <td style="height:22.7pt;padding:0cm 5.4pt;vertical-align:top;width:92.85pt;" width="124">
                                                <p style="text-align:justify;">
                                                    <span style="font-family:&quot;Arial&quot;,sans-serif;font-size:12.0pt;"><span lang="ES" dir="ltr"><strong>@resultadoIgM &nbsp;</strong></span><strong></strong></span>
                                                </p>
                                            </td>
                                            <td style="height:22.7pt;padding:0cm 5.4pt;vertical-align:top;width:77.9pt;" width="104">
                                                <p style="text-align:justify;">
                                                    &nbsp;
                                                </p>
                                            </td>
                                            <td style="height:22.7pt;padding:0cm 5.4pt;vertical-align:top;width:140.55pt;" width="187">
                                                <p style="text-align:justify;">
                                                    &nbsp;
                                                </p>
                                            </td>
                                            <td style="height:22.7pt;padding:0cm 5.4pt;vertical-align:top;width:29.05pt;" width="39">
                                                <p style="text-align:justify;">
                                                    &nbsp;
                                                </p>
                                            </td>
                                        </tr>
                                        <tr style="height:22.7pt;">
                                            <td style="background-color:#F2F2F2;height:22.7pt;padding:0cm 5.4pt;vertical-align:top;width:218.45pt;" colspan="2" width="291">
                                                <p style="text-align:justify;">
                                                    <span style="color:black;font-family:&quot;Arial&quot;,sans-serif;font-size:12.0pt;"><span lang="ES" dir="ltr"><strong>Cut Off &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</strong></span></span><span style="font-family:&quot;Arial&quot;,sans-serif;font-size:12.0pt;"><strong></strong></span>
                                                </p>
                                            </td>
                                            <td style="background-color:#F2F2F2;height:22.7pt;padding:0cm 5.4pt;vertical-align:top;width:92.85pt;" width="124">
                                                <p style="text-align:justify;">
                                                    <span style="color:black;font-family:&quot;Arial&quot;,sans-serif;font-size:12.0pt;"><span lang="ES" dir="ltr"><strong>@resultadoCutOffIgM&nbsp;</strong></span></span><span style="font-family:&quot;Arial&quot;,sans-serif;font-size:12.0pt;"><strong></strong></span>
                                                </p>
                                            </td>
                                            <td style="background-color:#F2F2F2;height:22.7pt;padding:0cm 5.4pt;vertical-align:top;width:77.9pt;" width="104">
                                                <p style="text-align:justify;">
                                                    &nbsp;
                                                </p>
                                            </td>
                                            <td style="background-color:#F2F2F2;height:22.7pt;padding:0cm 5.4pt;vertical-align:top;width:140.55pt;" width="187">
                                                <p style="text-align:justify;">
                                                    &nbsp;
                                                </p>
                                            </td>
                                            <td style="background-color:#F2F2F2;height:22.7pt;padding:0cm 5.4pt;vertical-align:top;width:29.05pt;" width="39">
                                                <p style="text-align:justify;">
                                                    &nbsp;
                                                </p>
                                            </td>
                                        </tr>
                                        <tr style="height:22.7pt;">
                                            <td style=;height:22.7pt;padding:0cm 5.4pt;vertical-align:top;width:106.15pt;" width="142">
                                                <p style="text-align:justify;">
                                                    <span style="font-family:&quot;Arial&quot;,sans-serif;font-size:12.0pt;"><span lang="ES" dir="ltr"><strong>Conclusión &nbsp; &nbsp; &nbsp; &nbsp;</strong></span><strong></strong></span>
                                                </p>
                                            </td>
                                            <td style="height:22.7pt;padding:0cm 5.4pt;vertical-align:top;width:452.65pt;" colspan="5" width="604">
                                                <p style="text-align:justify;">
                                                    <span style="font-family:&quot;Arial&quot;,sans-serif;font-size:12.0pt;"><span lang="ES" dir="ltr"><strong>La muestra&nbsp; @estadoIgM &nbsp;presenta Anticuerpos de tipo IgM contra Toxoplasma Gondii.</strong></span><strong></strong></span>
                                                </p>
                                            </td>
                                        </tr>
                                        <tr style="height:22.7pt;">
                                            <td style="background-color:#F2F2F2;height:22.7pt;padding:0cm 5.4pt;vertical-align:top;width:218.45pt;" colspan="2" width="291">
                                                <p style="text-align:justify;">
                                                    <span style="color:black;font-family:&quot;Arial&quot;,sans-serif;font-size:12.0pt;"><span lang="EN-US" dir="ltr">Resultado Toxoplasmosis IgG&nbsp;</span></span><span style="font-family:&quot;Arial&quot;,sans-serif;font-size:12.0pt;"></span>
                                                </p>
                                            </td>
                                            <td style="background-color:#F2F2F2;height:22.7pt;padding:0cm 5.4pt;vertical-align:top;width:92.85pt;" width="124">
                                                <p style="text-align:justify;">
                                                    <span style="color:black;font-family:&quot;Arial&quot;,sans-serif;font-size:12.0pt;"><span lang="ES" dir="ltr"><strong>@resultadoIgG &nbsp;</strong></span></span><span style="font-family:&quot;Arial&quot;,sans-serif;font-size:12.0pt;"><strong></strong></span>
                                                </p>
                                            </td>
                                            <td style="background-color:#F2F2F2;height:22.7pt;padding:0cm 5.4pt;vertical-align:top;width:77.9pt;" width="104">
                                                <p style="text-align:justify;">
                                                    &nbsp;
                                                </p>
                                            </td>
                                            <td style="background-color:#F2F2F2;height:22.7pt;padding:0cm 5.4pt;vertical-align:top;width:140.55pt;" width="187">
                                                <p style="text-align:justify;">
                                                    &nbsp;
                                                </p>
                                            </td>
                                            <td style="background-color:#F2F2F2;height:22.7pt;padding:0cm 5.4pt;vertical-align:top;width:29.05pt;" width="39">
                                                <p style="text-align:justify;">
                                                    &nbsp;
                                                </p>
                                            </td>
                                        </tr>
                                        <tr style="height:22.7pt;">
                                            <td style="height:22.7pt;padding:0cm 5.4pt;vertical-align:top;width:218.45pt;" colspan="2" width="291">
                                                <p style="text-align:justify;">
                                                    <span style="font-family:&quot;Arial&quot;,sans-serif;font-size:12.0pt;"><span lang="EN-US" dir="ltr"><strong>Cut Off &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</strong></span><strong></strong></span>
                                                </p>
                                            </td>
                                            <td style="height:22.7pt;padding:0cm 5.4pt;vertical-align:top;width:92.85pt;" width="124">
                                                <p style="text-align:justify;">
                                                    <span style="font-family:&quot;Arial&quot;,sans-serif;font-size:12.0pt;"><span lang="ES" dir="ltr"><strong>@resultadoCutOffIgG &nbsp;</strong></span><strong></strong></span>
                                                </p>
                                            </td>
                                            <td style="height:22.7pt;padding:0cm 5.4pt;vertical-align:top;width:77.9pt;" width="104">
                                                <p style="text-align:justify;">
                                                    &nbsp;
                                                </p>
                                            </td>
                                            <td style="height:22.7pt;padding:0cm 5.4pt;vertical-align:top;width:140.55pt;" width="187">
                                                <p style="text-align:justify;">
                                                    &nbsp;
                                                </p>
                                            </td>
                                            <td style="height:22.7pt;padding:0cm 5.4pt;vertical-align:top;width:29.05pt;" width="39">
                                                <p style="text-align:justify;">
                                                    &nbsp;
                                                </p>
                                            </td>
                                        </tr>
                                        <tr style="height:22.7pt;">
                                            <td style="background-color:#F2F2F2;height:22.7pt;padding:0cm 5.4pt;vertical-align:top;width:106.15pt;" width="142">
                                                <p style="text-align:justify;">
                                                    <span style="color:black;font-family:&quot;Arial&quot;,sans-serif;font-size:12.0pt;"><span lang="ES" dir="ltr"><strong>Conclusión&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</strong></span></span><span style="font-family:&quot;Arial&quot;,sans-serif;font-size:12.0pt;"><strong></strong></span>
                                                </p>
                                            </td>
                                            <td style="background-color:#F2F2F2;height:22.7pt;padding:0cm 5.4pt;vertical-align:top;width:452.65pt;" colspan="5" width="604">
                                                <p style="text-align:justify;">
                                                    <span style="color:black;font-family:&quot;Arial&quot;,sans-serif;font-size:12.0pt;"><span lang="ES" dir="ltr"><strong>La muestra&nbsp; @estadoIgM &nbsp;presenta Anticuerpos de tipo IgG contra Toxoplasma Gondii.</strong></span></span><span style="font-family:&quot;Arial&quot;,sans-serif;font-size:12.0pt;"><strong></strong></span>
                                                </p>
                                            </td>
                                        </tr>
                                        <tr style="height:22.7pt;">
                                            <td style="height:22.7pt;padding:0cm 5.4pt;vertical-align:top;width:218.45pt;" colspan="2" width="291">
                                                <p style="text-align:justify;">
                                                    <span style="font-family:&quot;Arial&quot;,sans-serif;font-size:12.0pt;"><span lang="ES" dir="ltr"><strong>YIH Prueba Rápida</strong></span><strong></strong></span>
                                                </p>
                                            </td>
                                            <td style="height:22.7pt;padding:0cm 5.4pt;vertical-align:top;width:340.35pt;" colspan="4" width="454">
                                                <p style="text-align:justify;">
                                                    &nbsp;
                                                </p>
                                            </td>
                                        </tr>
                                        <tr style="height:22.7pt;">
                                            <td style="background-color:#F2F2F2;height:22.7pt;padding:0cm 5.4pt;vertical-align:top;width:558.8pt;" colspan="6" width="745">
                                                <p style="text-align:justify;">
                                                    <span style="color:black;font-family:&quot;Arial&quot;,sans-serif;font-size:12.0pt;"><span lang="ES" dir="ltr"><strong>&nbsp;Método: Prueba Rápida de detección de anticuerpos contra VIH.</strong></span></span><span style="font-family:&quot;Arial&quot;,sans-serif;font-size:12.0pt;"><strong></strong></span>
                                                </p>
                                            </td>
                                        </tr>
                                        <tr style="height:22.7pt;">
                                            <td style="height:22.7pt;padding:0cm 5.4pt;vertical-align:top;width:106.15pt;" width="142">
                                                <p style="text-align:justify;">
                                                    &nbsp;
                                                </p>
                                            </td>
                                            <td style="height:22.7pt;padding:0cm 5.4pt;vertical-align:top;width:452.65pt;" colspan="5" width="604">
                                                <p style="text-align:justify;">
                                                    <span style="font-family:&quot;Arial&quot;,sans-serif;font-size:12.0pt;"><span lang="ES" dir="ltr"><strong>@resultadoVIH &nbsp; contra el virus de inmunodeficiencia humana.</strong></span><strong></strong></span>
                                                </p>
                                            </td>
                                        </tr>
                                        <tr style="height:22.7pt;">
                                            <td style="background-color:#F2F2F2;height:22.7pt;padding:0cm 5.4pt;vertical-align:top;width:558.8pt;" colspan="6" width="745">
                                                <p style="text-align:justify;">
                                                    <span style="color:black;font-family:&quot;Arial&quot;,sans-serif;font-size:12.0pt;"><span lang="ES" dir="ltr">Reagina Plasmática Rápida. (R.P.R.)</span></span><span style="font-family:&quot;Arial&quot;,sans-serif;font-size:12.0pt;"></span>
                                                </p>
                                            </td>
                                        </tr>
                                        <tr style="height:22.7pt;">
                                            <td style="height:22.7pt;padding:0cm 5.4pt;vertical-align:top;width:558.8pt;" colspan="6" width="745">
                                                <p style="text-align:justify;">
                                                    <span style="font-family:&quot;Arial&quot;,sans-serif;font-size:12.0pt;"><span lang="ES" dir="ltr"><strong>Método: Aglutinación Látex cuantitativo.</strong></span><strong></strong></span>
                                                </p>
                                            </td>
                                        </tr>
                                        <tr style="height:22.7pt;">
                                            <td style="background-color:#F2F2F2;height:22.7pt;padding:0cm 5.4pt;vertical-align:top;width:558.8pt;" colspan="6" width="745">
                                                <p style=" 8pt;text-align:center;">
                                                    <span style="color:black;font-family:&quot;Arial&quot;,sans-serif;font-size:12.0pt;"><span lang="ES" dir="ltr"><strong>@estadoFinal</strong></span></span><span style="font-family:&quot;Arial&quot;,sans-serif;font-size:12.0pt;"><strong></strong></span>
                                                </p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </figure>
                        </div>
                    </div>
                <button type="submit" class="btn btn-primary">Guardar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            </form>
		</div>
	</div>
</div>
<!--script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/classic/ckeditor.js"></script-->
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
