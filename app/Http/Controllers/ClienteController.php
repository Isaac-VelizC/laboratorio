<?php

namespace App\Http\Controllers;

use App\Models\Horario;
use App\Models\listaCita;
use App\Models\listaCliente;
use App\Models\listaPruebaCita;
use App\Models\listaPruebas;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ClienteController extends Controller
{
    public function index() {
        $user = User::find(auth()->user()->id);
        $cliente = listaCliente::where('user_id', $user->id)->first();
        return view('clients.index', compact('cliente', 'user'));
    }

    public function misCitas() {
        $i = 1;
        $user = User::find(auth()->user()->id);
        $cliente = listaCliente::where('user_id', $user->id)->first();
        $citas = listaCita::where('client_id', $cliente->id)->get();
        $pruebas = listaPruebas::where('status', 1)->where('delete', 0)->get();
        return view('clients.citas.index', compact('citas', 'i', 'pruebas'));
    }

    public function storeCitas(Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                'date' => 'required|date',
                'time' => 'required',
                'test_ids' => 'required|array',
                'test_ids.*' => 'required|integer',
                'prescription' => 'nullable|file|mimes:jpeg,png,jpg,gif,doc,docx,pdf,txt',
            ]);
            // Manejar errores de validación
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }
            $user = auth()->user();
            if ($request->idPaciente) {
                $idUser = $request->idPaciente;
            } else {
                $idUser = $user->id;
            }
            $cli = listaCliente::where('user_id', $idUser)->first();
            if (!$cli) {
                return back()->with('error', 'No se encontró el cliente para el usuario.');
            }
            $prefix = date("Ym") . "-";
            $latestCode = listaCita::where('code', 'like', $prefix . '%')->max('code');
    
            if ($latestCode) {
                $code = sprintf("%'.04d", intval(substr($latestCode, -4)) + 1);
            } else {
                $code = sprintf("%'.04d", 1);
            }

            $hora = Horario::find($request->time);

            $cita = listaCita::create([
                'code' => $prefix . $code,
                'fecha' => $request->date,
                'hora_id' => $request->time,
                'horario' => $hora->hora,
                'client_id' => $cli->id,
                'status' => 0,
            ]);

            if ($request->hasFile('prescription')) {
                $image = $request->file('prescription');
                $imageName = time().'.'.$image->getClientOriginalExtension();
                $image->storeAs('uploads', $imageName, 'public');
                $cita->prescription = 'uploads/'.$imageName;
                $cita->save();
            }
    
            foreach ($request->test_ids as $test_id) {
                $prueba = listaPruebas::find($test_id);
                listaPruebaCita::create([
                    'appointment_id' => $cita->id,
                    'test_id' => $test_id,
                    'formulario' => $prueba->description
                ]);
            }
    
            return back()->with('message', 'Prueba agendada con éxito');
        } catch (\Throwable $th) {
            return back()->with('error', 'Ocurrió un error al agendar la prueba. ' . $th->getMessage());
        }
    }

    public function pageEditCitas($id) {
        $cita = listaCita::find($id);
        $i = 1;
        $user = User::find(auth()->user()->id);
        $cliente = listaCliente::where('user_id', $user->id)->first();
        $pruebas = listaPruebas::where('status', 1)->where('delete', 0)->get();
        return view('clients.citas.edit', compact('cita', 'pruebas'));
    }

    public function updateCitas(Request $request, $id)
    {
        try {
            
            $request->validate([
                'test_ids' => 'array',
                'test_ids.*' => 'integer',
                'prescription' => 'nullable|string',
                'date' => 'required|date',
            ]);

            // Encontrar y actualizar la cita
            $cita = listaCita::find($id);
            $cita->fecha = $request->date;
            if ($request->time) {
                $cita->hora_id = $request->time;
                $hora = Horario::find($request->time);
                $cita->horario = $hora->hora;
            }
    
            $cita->save();
    
            // Manejar la receta médica
            if ($request->hasFile('prescription')) {
                $image = $request->file('prescription');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('uploads', $imageName, 'public');
                $cita->prescription = 'uploads/' . $imageName;
                $cita->save();
            }
    
            // Manejar las pruebas
            if ($request->test_ids) {
                // Eliminar las pruebas existentes para la cita
                listaPruebaCita::where('appointment_id', $cita->id)->delete();
    
                // Asignar nuevas pruebas a la cita
                foreach ($request->test_ids as $test_id) {
                    $prueba = listaPruebas::find($test_id);
                    listaPruebaCita::create([
                        'appointment_id' => $cita->id,
                        'test_id' => $test_id,
                        'formulario' => $prueba->description
                    ]);
                }
            }
    
            return back()->with('message', 'Prueba actualizada con éxito');
        } catch (\Throwable $th) {
            return back()->with('error', 'Ocurrió un error al agendar la prueba. ' . $th->getMessage());
        }
    }
    
    public function controlHorarios($nuevaHora) {
        // Convertir la nueva hora a un objeto Carbon
        $nuevaHora = Carbon::parse($nuevaHora);

        // Calcular el rango de tiempo adicional de 15 minutos
        $fechaInicial = $nuevaHora->copy()->subMinutes(15);
        $fechaFinal = $nuevaHora->copy()->addMinutes(15);

        // Verificar si hay citas programadas dentro del rango de tiempo adicional
        $citas = listaPruebaCita::whereBetween('fecha', [$fechaInicial, $fechaFinal])->exists();

        // Devolver true si no hay citas programadas dentro del rango, de lo contrario, devolver false
        return !$citas;
    }

    public function resultados() {
        $i = 1;
        $user = User::find(auth()->user()->id);
        $cliente = listaCliente::where('user_id', $user->id)->first();
        $citas = listaCita::where('client_id', $cliente->id)->where('status', 4)->get();
        return view('clients.resultados', compact('citas', 'i'));
    }
    
    public function actualizarPerfil(Request $request, $id) {
        try {
            $user = User::find($id);
            if (!$user) {
                // Manejar el caso en el que el usuario no se encuentra
                return back()->with('error', 'Usuario no encontrado.');
            }
            
            $request->validate([
                'nombres' => 'required|string|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/u',
                'name' => 'required|string|max:255|unique:users,name,' . $id,
                'email' => 'required|string|email|max:255|unique:users,email,' . $id,
                'password' => 'nullable|string|min:8',
                'apellido_pa' => 'required|string|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/u',
                'apellido_ma' => 'nullable|string|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/u',
                'ci' => 'required|string|max:255|min:7|unique:users,ci,' . $id,
                'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            

            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'nombres' => $request->nombres,
                'apellido_pa' => $request->apellido_pa,
                'apellido_ma' => $request->apellido_ma,
                'ci' => $request->ci,
                'password' => $request->filled('password') ? Hash::make($request->password) : $user->password,
            ]);

            if ($user->type == 3) {
                $cliente = listaCliente::where('user_id', $user->id)->first();
            
                if ($cliente) {
                    $cliente->update([
                        'gender' => $request->gender,
                        'contact' => $request->contact,
                        'dob' => $request->dob,
                        'address' => $request->address
                    ]);
                } else {
                    return back()->with('error', 'Cliente no encontrado.');
                }
            }
            

            if ($request->hasFile('img')) {
                $image = $request->file('img');
                $imageName = time().'.'.$image->getClientOriginalExtension();
                $image->storeAs('avatars', $imageName, 'public'); // Almacenar en la carpeta 'public/avatars'
                $user->avatar = 'avatars/'.$imageName;
                $user->save();
            }
            return back()->with('success', 'Usuario actualizado con éxito');
        } catch (\Throwable $th) {
            // Manejar la excepción según tus necesidades
            return back()->with('error', 'Ocurrió un error al actualizar el usuario. ' . $th->getMessage());
        }
    }
    public function deleteCita(Request $request) {
        try {
            $cita = listaCita::findOrFail($request->id);
            // Verificar si la cita existe
            if (!$cita) {
                return back()->with('error', 'La cita no existe.');
            }
            $cita->pruebas()->delete();
            // Eliminar historial asociado
            $cita->history()->delete();
            // Eliminar la cita
            $cita->delete();
            return back()->with('message', 'La cita se eliminó con éxito');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $ex) {
            return back()->with('error', 'La cita con ID '.$request->id.' no se pudo encontrar.');
        } catch (\Throwable $th) {
            return back()->with('error', 'Ocurrió un error al eliminar la cita: '. $th->getMessage());
        }
    }

    public function editPacienteNew($id) {
        $cliente = listaCliente::find($id);
        return view('admin.pacientes.edit', compact('cliente'));
    }

    public function updatePacienteNew(Request $request, $id) {
        try {
            $cliente = listaCliente::find($id);
            if (!$cliente) {
                // Manejar el caso en el que el usuario no se encuentra
                return back()->with('error', 'Paciente no encontrado.');
            }
            $request->validate([
                'nombres' => 'required|string|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/u',
                'name' => 'required|string|max:255|unique:users,name,' . $cliente->user_id,
                'email' => 'required|string|email|max:255|unique:users,email,' . $cliente->user_id,
                'password' => 'nullable|string|min:8',
                'apellido_pa' => 'required|string|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/u',
                'apellido_ma' => 'nullable|string|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/u',
                'ci' => 'required|string|max:255|unique:users,ci,' . $cliente->user_id,
                'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            dd($request);
            $user = User::find($cliente->user_id);
            
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'nombres' => $request->nombres,
                'apellido_pa' => $request->apellido_pa,
                'apellido_ma' => $request->apellido_ma,
                'ci' => $request->ci,
                'password' => $request->filled('password') ? Hash::make($request->password) : $user->password,
            ]);

            return back()->with('success', 'Usuario actualizado con éxito');
        } catch (\Throwable $th) {
            // Manejar la excepción según tus necesidades
            return back()->with('error', 'Ocurrió un error al actualizar el usuario. ' . $th->getMessage());
        }
    }

    public function showPaciente($id) {
        $cliente = listaCliente::find($id);
        
        if (!$cliente) {
            return back()->with('error', 'No se encontró al paciente');
        }
    
        // Obtener todas las citas del cliente
        $citas = listaCita::where('client_id', $id)->get();
    
        // Inicializar un array para almacenar los resultados de las pruebas
        $pruebas = [];
    
        // Iterar sobre cada cita y obtener las pruebas asociadas
        foreach ($citas as $cita) {
            // Obtener las pruebas asociadas a esta cita
            $pruebasCita = listaPruebaCita::where('appointment_id', $cita->id)->get();
    
            // Agregar las pruebas a la lista
            foreach ($pruebasCita as $pruebaCita) {
                $pruebas[] = $pruebaCita->test->name;
            }
        }
    
        // Contar la cantidad de veces que aparece cada prueba
        $cantidadPruebas = array_count_values($pruebas);
    
        // Eliminar duplicados
        $pruebasUnicas = array_unique($pruebas);
    
        return view('admin.pacientes.show', compact('cliente', 'cantidadPruebas', 'pruebasUnicas', 'pruebas'));
    }
    
    
}
