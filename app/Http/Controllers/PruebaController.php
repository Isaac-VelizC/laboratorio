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
use TCPDF;

class PruebaController extends Controller
{
    public function pruebasList() {
        $i = 1;
        $pruebas = listaPruebas::where('delete_flag', 0)->get();
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
            
            $prueba = listaPruebas::create([
                'name' => $request->name,
                'cost' => $request->cost,
                'status' => $request->status,
                'description' => $request->description,
            ]);
            
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
            $test = listaPruebas::find($request->id);
            $test->delete_flag = 1;
            $test->update();
            return back()->with('message', 'Prueba eliminado correctamente');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al eliminar el Prueba: ' . $e->getMessage());
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
            if ($request->valores !== null) {
                FormTypeValue::where('test_id', $id)->delete();
                $this->asignarTipo($request->valores, $id);
            }

            listaPruebas::find($id)->update([
                'name' => $request->name,
                'cost' => $request->cost,
                'status' => $request->status,
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
        $descripcion = $form->descripcion;
        if (!$prueba) {
            return back()->with('message', 'No se encontro la prueba');
        } else if(!$cita) {
            return back()->with('message', 'No se encontro la cita');
        } else if (!$cliente) {
            return back()->with('message', 'No se encontro al cliente');
        } else {

            if ($descripcion) {
                $formulario =  $this->reemplazarValues($descripcion, $cliente);
            }
            return view('admin.citas.informe',compact('prueba', 'cliente', 'cita', 'formulario', 'inputs'));
        }
    }

    function reemplazarValues($formulario, $cliente) {
        $nombreDoctor = Auth::user()->nombres . ' ' . Auth::user()->apellido_pa . ' ' . Auth::user()->apellido_ma;
        $valuePeticion = 232;
        $valueSexo = $cliente->gender;
        $valueEdad = $this->calcularEdad($cliente->dob);
        $nHistoria = 79;
        $paciente = $cliente->user->nombres . ' ' . $cliente->user->apellido_pa . ' ' . $cliente->user->apellido_ma;
        $asegurado = 765;
        $consulta = 876;
        $cliente = 97;
        $nOrden = 45;
    
        // Reemplazar los valores en el formulario
        $formulario = str_replace('#nombreDoctor', $nombreDoctor, $formulario);
        $formulario = str_replace('#ePeticion', $valuePeticion, $formulario);
        $formulario = str_replace('#edad', $valueEdad, $formulario);
        $formulario = str_replace('#nHistoria', $nHistoria, $formulario);
        $formulario = str_replace('#paciente', $paciente, $formulario);
        $formulario = str_replace('#asegurado', $asegurado, $formulario);
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

            $edit->descripcion = $modificadoForm;
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
            $edit->descripcion = $modificadoForm;
            $edit->estado = 2;
            $edit->update();
            
            listaHistorial::create([
                'appointment_id' => $request->cita,
                'status' => 4,
                'remarks' => 'Prueba finalizada',
            ]);
            $fecha = Carbon::now()->format('Y-m-d_H-i-s');
            
            $html = $modificadoForm;
            $pdf = new TCPDF();
            $pdf->AddPage();
            $pdf->writeHTML($html, true, false, true, false, '');
            $filename = $fecha . '.pdf';
            $pdf->Output(public_path('storage/pdfs/' . $filename), 'F');
            listaPruebaCita::where('appointment_id', $request->cita)
                ->where('test_id', $request->prueba)->update([
                'informe' => 'pdfs/' . $filename,
            ]);

            $todos = listaPruebaCita::where('appointment_id', $request->cita)->get();
            $estadoForm = $todos->every(function ($item) {
                return $item->estado == 2;
            });
            if ($estadoForm) {
                $citaEdit = listaCita::find($request->cita);
                $citaEdit->status = 4;
                $citaEdit->update();
            }
            
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
    
}