<?php

namespace App\Http\Controllers;

use App\Models\listaCita;
use App\Models\listaCliente;
use App\Models\listaPruebaCita;
use App\Models\listaPruebas;
use App\Models\User;
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
        $pruebas = listaPruebas::where('status', 1)->where('delete_flag', 0)->get();
        return view('clients.citas.index', compact('citas', 'i', 'pruebas'));
    }
    public function storeCitas(Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                'schedule' => 'required|date',
                'test_ids' => 'required|array',
                'test_ids.*' => 'required|integer',
                'prescription' => 'nullable|file',
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

            $cita = listaCita::create([
                'code' => $prefix . $code,
                'schedule' => $request->schedule,
                'client_id' => $cli->id,
                'status' => 0,
            ]);

            if ($request->hasFile('prescription')) {
                $image = $request->file('prescription');
                $imageName = time().'.'.$image->getClientOriginalExtension();
                $image->storeAs('uploads', $imageName, 'public');
                $cita->prescription_path = 'uploads/'.$imageName;
                $cita->save();
            }
    
            foreach ($request->test_ids as $test_id) {
                $prueba = listaPruebas::find($test_id);
                listaPruebaCita::create([
                    'appointment_id' => $cita->id,
                    'test_id' => $test_id,
                    'descripcion' => $prueba->description
                ]);
            }
    
            return back()->with('message', 'Prueba agendada con éxito');
        } catch (\Throwable $th) {
            return back()->with('error', 'Ocurrió un error al agendar la prueba. ' . $th->getMessage());
        }
    }

    public function updateCitas(Request $request, $id) {
        try {
            $validator = Validator::make($request->all(), [
                'schedule' => 'required|date',
                'test_ids' => 'required|array',
                'test_ids.*' => 'required|integer',
                'prescription' => 'nullable|string',
            ]);
            // Manejar errores de validación
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }
            $cita = listaCita::find($id)->update([
                'schedule' => $request->schedule,
                'status' => 0,
            ]);
    
            foreach ($request->test_ids as $test_id) {
                listaPruebaCita::where([
                    'appointment_id' => $cita->id,
                    'test_id' => $test_id,
                ]);
            }
    
            return back()->with('success', 'Prueba agendada con éxito');
        } catch (\Throwable $th) {
            return back()->with('error', 'Ocurrió un error al agendar la prueba. ' . $th->getMessage());
        }
    }
    
    public function resultados() {
        $i = 1;
        $user = User::find(auth()->user()->id);
        $cliente = listaCliente::where('user_id', $user->id)->first();
        $citas = listaCita::where('client_id', $cliente->id)
        ->where('status', 4)
        ->get();
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
        
            // Eliminar pruebas asociadas
            $cita->pruebas()->delete();
        
            // Eliminar historial asociado
            $cita->history()->delete();
        
            // Eliminar la cita
            $cita->delete();
        
            return back()->with('message', 'Cita eliminada correctamente');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al eliminar la cita: ' . $e->getMessage());
        }
    }
}
