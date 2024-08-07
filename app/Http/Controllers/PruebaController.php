<?php

namespace App\Http\Controllers;

use App\Models\FormTypeValue;
use App\Models\listaCita;
use App\Models\listaCliente;
use App\Models\listaHistorial;
use App\Models\listaPruebaCita;
use App\Models\listaPruebas;
use App\Models\SystemInfo;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Karriere\PdfMerge\PdfMerge;
use TCPDF;

class PruebaController extends Controller
{
    public function pruebasList() {
        $i = 1;
        $pruebas = listaPruebas::all();
        return view('admin.pruebas.index', compact('pruebas', 'i'));
    }

    public function formNewTest() {
        $form = SystemInfo::find(10);
        $valorDefecto = $form->meta_value;
        return view('admin.pruebas.create', compact('valorDefecto'));
    }

    public function pruebaNew(Request $request) {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'cost' => 'required|numeric|min:1',
                'status' => 'required|numeric',
                'description' => 'required|string',
            ]);
            $prueba = new listaPruebas();
            $prueba->name = $request->name;
            $prueba->cost = $request->cost;
            $prueba->delete = $request->status;
            $prueba->description = $request->description;
            if (empty($request->valores)) {
                return back()->with('error', 'La prueba no tiene campos para ser llenado');
            }
            $prueba->save();
            $this->asignarTipo($request->valores, $prueba->id);

            return back()->with('message', 'Prueba creado con éxito');
        } catch (\Throwable $th) {
            return back()->with('error', 'Ocurrió un error al crear la Prueba. ' . $th->getMessage());
        }
    }

    function asignarTipo($cadena, $id) {
        // Separar el string en palabras individuales
        $palabras = explode(',', $cadena);
        // Iterar sobre cada palabra y asignarla a la categoría correspondiente
        foreach ($palabras as $palabra) {
            // Eliminar espacios en blanco al inicio y al final de la palabra
            $palabra = trim($palabra);
            // Verificar si la palabra termina en 'N' o 'S' y asignarla a la categoría correspondiente
            if (substr($palabra, -1) === 'N') {
                FormTypeValue::create([
                    'test_id' => $id,
                    'name' => $palabra,
                    'type' => 'number'
                ]);
            } elseif (substr($palabra, -1) === 'S') {
                FormTypeValue::create([
                    'test_id' => $id,
                    'name' => $palabra,
                    'type' => 'text'
                ]);
            }
        }
    }
    
    public function deletePruebaNew(Request $request) {
        try {
            $test = listaPruebas::findOrFail($request->id);
            $test->delete = $test->delete ? 0 : 1; // Alternar entre 0 y 1
            $test->save();
            $message = $test->delete ? 'Se dio de Baja' : 'Se dio de Alta';
            return back()->with('message', $message . ' la prueba correctamente');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al eliminar la Prueba: ' . $e->getMessage());
        }
    }

    public function deletePrueba(Request $request) {
        try {
            $lista = listaPruebas::findOrFail($request->id);
            // Eliminar los valores asociados a la prueba
            $lista->values()->delete();
            // Ahora puedes eliminar la prueba
            $lista->delete();
            return back()->with('message', 'Prueba eliminada correctamente');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al eliminar la Prueba: ' . $e->getMessage());
        }
    }    
    
    public function formEditTest($id) {
        $item = listaPruebas::find($id);
        return view('admin.pruebas.edit', compact('item'));
    }
    
    public function pruebaEditar(Request $request, $id) {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'cost' => 'required|numeric|min:1',
                'status' => 'required|numeric',
                'description' => 'required|string',
            ]);
            //dd($request);
            if ($request->valores !== null) {
                FormTypeValue::where('test_id', $id)->delete();
                $this->asignarTipo($request->valores, $id);
            }
            
            listaPruebas::find($id)->update([
                'name' => $request->name,
                'cost' => $request->cost,
                'delete' => $request->status,
                'description' => $request->description,
            ]);

            return back()->with('success', 'Prueba actualizado con éxito');
        } catch (\Throwable $th) {
            return back()->with('error', 'Ocurrió un error al actualizar la prueba. ' . $th->getMessage());
        }
    }

    public function llenar_formulario($id, $citaId) {
        $cita = listaCita::find($citaId);
        $cliente = listaCliente::find($cita->client_id);
        $prueba = listaPruebas::find($id);
        $inputs = FormTypeValue::where('test_id', $id)->get();
        $form = listaPruebaCita::where('appointment_id', $citaId)->where('test_id', $id)->first();
        $descripcion = $form->formulario;
        if (!$prueba) {
            return back()->with('message', 'No se encontro la prueba');
        } else if(!$cita) {
            return back()->with('message', 'No se encontro la cita');
        } else if (!$cliente) {
            return back()->with('message', 'No se encontro al cliente');
        } else {

            if ($descripcion) {
                $formulario =  $this->reemplazarValues($descripcion, $cliente, $cita, $form);
            }
            return view('admin.citas.informe',compact('prueba', 'cliente', 'cita', 'formulario', 'inputs'));
        }
    }

    function reemplazarValues($formulario, $cliente, $cita, $form) {
        $nombreDoctor = Auth::user()->nombres . ' ' . Auth::user()->apellido_pa . ' ' . Auth::user()->apellido_ma;
        $valuePeticion = $cita->fecha;
        $valueSexo = $cliente->gender;
        $valueEdad = $this->calcularEdad($cliente->dob);
        $nHistoria = 'LP-'.$cita->id;
        $paciente = $cliente->user->nombres . ' ' . $cliente->user->apellido_pa . ' ' . $cliente->user->apellido_ma;
        //$asegurado = '-';
        $consulta = $cita->code;
        $cliente = $cliente->id;
        $nOrden = $form->code;
    
        // Reemplazar los valores en el formulario
        $formulario = str_replace('#nombreDoctor', $nombreDoctor, $formulario);
        $formulario = str_replace('#fPeticion', $valuePeticion, $formulario);
        $formulario = str_replace('#edad', $valueEdad, $formulario);
        $formulario = str_replace('#nHistoria', $nHistoria, $formulario);
        $formulario = str_replace('#paciente', $paciente, $formulario);
        //$formulario = str_replace('#asegurado', $asegurado, $formulario);
        $formulario = str_replace('#sexo', $valueSexo, $formulario);
        $formulario = str_replace('#consulta', $consulta, $formulario);
        $formulario = str_replace('#cliente', $cliente, $formulario);
        $formulario = str_replace('#nOrden', $nOrden, $formulario);
    
        return $formulario;
    }
    
    function calcularEdad($fechaNacimiento) {
        // Obtener la fecha actual
        $fechaActual = new DateTime();
        // Convertir la fecha de nacimiento a un objeto DateTime
        $fechaNacimiento = new DateTime($fechaNacimiento);
        // Calcular la diferencia entre la fecha actual y la fecha de nacimiento
        $diferencia = $fechaActual->diff($fechaNacimiento);
        // Obtener la edad en años
        $edad = $diferencia->y;
        return $edad;
    }
    
    public function addFormularioAdmin(Request $request) {
        try {
            $rules = [];
            foreach ($request->input() as $key => $value) {
                $rules[$key] = 'required';
            }
            $validator = Validator::make($request->all(), $rules);
            // Verificar si la validación falla
            if ($validator->fails()) {
                return back()->with('error', 'Todos los datos son requeridos. '. $validator);
            }

            $edit = listaPruebaCita::where('appointment_id', $request->cita)->where('test_id', $request->prueba)->first();
            if (!$edit) {
                return back()->with('error', 'No se encontró la prueba de la cita.');
            }

            $modificadoForm = $this->reemplazarValuesFormulario($request->valoresInputs, $request->description);

            $edit->formulario = $modificadoForm;
            $edit->estado = 1;
            $edit->update();
            listaHistorial::create([
                'appointment_id' => $request->cita,
                'status' => 2,
                'remarks' => 'Sin observaciones',
            ]);
            $todos = listaPruebaCita::where('appointment_id', $request->cita)->get();
            $estadoForm = $todos->every(function ($item) {
                return $item->estado == 1;
            });
            if ($estadoForm) {
                $citaEdit = listaCita::find($request->cita);
                if ($citaEdit) {
                    $citaEdit->status = 2;
                    $citaEdit->update();
                } else {
                    return back()->with('error', 'No se encontró la cita.');
                }
            }
            return redirect()->back()->with('message', 'Guardado correctamente');
        } catch (\Throwable $th) {
            return back()->with('error', 'Ocurrió un error. ' . $th->getMessage());
        }
    }

    public function addFormularioPDF(Request $request) {
        try {
            $request->validate([
                'valoresInputs' => 'required|string',
                'description' => 'required|string',
            ]);

            $modificadoForm = $this->reemplazarValuesFormulario($request->valoresInputs, $request->description);
            $edit = listaPruebaCita::where('appointment_id', $request->cita)->where('test_id', $request->prueba)->first();
            $edit->formulario = $modificadoForm;
            $edit->estado = 2;
            $edit->update();
            
            listaHistorial::create([
                'appointment_id' => $request->cita,
                'status' => 4,
                'remarks' => 'Prueba finalizada',
            ]);
            $fecha = Carbon::now()->format('Y-m-d_H-i-s');
            $html = $modificadoForm;
            // Crear un nuevo objeto TCPDF con orientación horizontal y formato personalizado
            //$pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);
            $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
            // Agregar una nueva página al PDF
            $pdf->AddPage();
            // Escribir el HTML en el PDF
            $pdf->writeHTML($html, true, false, true, false, '');
            // Definir el nombre del archivo PDF
            $filename = $fecha . '.pdf';
            // Guardar el PDF en el directorio de almacenamiento público
            $pdf->Output(public_path('storage/pdfs/' . $filename), 'F');
            // Actualizar el campo 'pdf' en la base de datos
            listaPruebaCita::where('appointment_id', $request->cita)
                ->where('test_id', $request->prueba)->update([
                'pdf' => 'pdfs/' . $filename,
                'bio_id' => auth()->user()->id,
            ]);
            
            $citaEdit = listaCita::find($request->cita);
            // Verificar si todos los formularios están completos
            $cat = listaPruebaCita::where('appointment_id', $request->cita)->count();
            $todos = listaPruebaCita::where('appointment_id', $request->cita)->where('estado', 2)->get();
            if ($cat == count($todos)) {
                $citaEdit->status = 3;
            } else {
                if ($cat == 1 && count($todos) == 1 ) {
                    $citaEdit->status = 4;
                }
            }
            if ($cat == 1) {
                $citaEdit->status = 4;
            }
            
            $citaEdit->update();

            return redirect()->back()->with('message', 'Guardado correctamente');
        } catch (\Throwable $th) {
            return back()->with('error', 'Ocurrió un error. ' . $th->getMessage());
        }
    }

    function reemplazarValuesFormulario($valoresInputs, $descripcion) {
        // Decodificar la cadena JSON de los valores de los inputs
        $valores = json_decode($valoresInputs, true);
        // Recorrer los valores y reemplazarlos en la descripción
        foreach ($valores as $nombreInput => $valorInput) {
            // Reemplazar el nombre del input con su valor en la descripción
            $descripcion = str_replace($nombreInput, $valorInput, $descripcion);
        }
        // Devolver la descripción modificada
        return $descripcion;
    }

    function unirPdf(Request $request, $idCita) {
        try {
            $request->validate([
                'pdfs' => 'required',
                'pdfs.*' => 'file|mimes:pdf',
            ]);
            // Obtener la lista de pruebas de la cita
            $lista = listaPruebaCita::where('appointment_id', $idCita)->get();
            // Obtener los nombres de los PDFs de la lista
            $nombresPDFLista = $lista->pluck('pdf')->toArray();
            // Obtener los nombres de los archivos subidos
            $nombresArchivosSubidos = [];
            foreach ($request->file('pdfs') as $archivo) {
                // Obtener el nombre del archivo subido
                $nombreArchivo = $archivo->getClientOriginalName();
            
                // Convertir el nombre del archivo subido al mismo formato que los nombres de PDFs en la lista
                // Reemplazar solo el primer '_' por '/' en el nombre del archivo subido
                $nombreArchivoFormateado = preg_replace('/_/', '/', $nombreArchivo, 1);
            
                // Agregar el nombre del archivo subido formateado al array
                $nombresArchivosSubidos[] = $nombreArchivoFormateado;
            }            
            // Verificar que los nombres de los archivos subidos coincidan con los nombres de los PDFs de la lista
            foreach ($nombresArchivosSubidos as $nombreArchivo) {
                if (!in_array($nombreArchivo, $nombresPDFLista)) {
                    // Si un archivo subido no coincide con ningún PDF de la lista, devuelve un error o realiza alguna acción
                    return back()->with('error', 'El archivo subido no coincide con ningún PDF de la lista.');
                }
            }

            $cantidad = count($lista);
            if (count($request->pdfs) != $cantidad) {
                return back()->with('error', 'Debe de ingresar '. $cantidad. ' pdfs.');
            }
            $pdf = new PdfMerge();
            foreach ($request->pdfs as $key => $pdfFile) {
                $pdf->add($pdfFile->getPathName());
            }
            $nombre_pdf = Carbon::now()->format('Y-m-d_H-i-s').'.pdf';
            $path = public_path('storage/pdfs/' . $nombre_pdf);
            $pdf->merge($path);
            // Retorna la ruta del PDF unido
            listaCita::find($idCita)->update([
                'pdf_general' => 'pdfs/' . $nombre_pdf,
                'status' => 4,
            ]);
            return back()->with('message', 'Pdfs unidos exitosamente');
        } catch (\Throwable $th) {
            return back()->with('error', 'Error el unir los pdfs: ' . $th->getMessage());
        }
    }
}