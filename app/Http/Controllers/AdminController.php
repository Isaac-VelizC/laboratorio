<?php

namespace App\Http\Controllers;

use App\Models\ImagenFile;
use App\Models\listaCita;
use App\Models\listaCliente;
use App\Models\listaHistorial;
use App\Models\listaPruebaCita;
use App\Models\listaPruebas;
use App\Models\SystemInfo;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use TCPDF;

class AdminController extends Controller
{
    public function usersList() {
        $i = 1;
        $users = User::where('type', 2)->get();
        return view('admin.usuarios.index', compact('users', 'i'));
    }
    public function createUserNew() {
        $isEditing = false;
        return view('admin.usuarios.form', compact('isEditing'));
    }
    public function editUserNew($id) {
        $isEditing = true;
        $user = User::find($id);
        return view('admin.usuarios.form', compact('isEditing', 'user'));
    }
    public function storeUserNew(Request $request) {
        try {    
            $request->validate([
                'nombres' => 'required|string|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/u',
                'name' => 'required|string|max:255|unique:users',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
                'apellido_pa' => 'required|string|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/u',
                'apellido_ma' => 'nullable|string|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/u',
                'ci' => 'required|string|regex:/^\d{7}(?:-[0-9A-Z]{1,2})?$/|unique:users',
                'type' => 'required|in:1,2',
                'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'nombres' => $request->nombres,
                'apellido_pa' => $request->apellido_pa,
                'apellido_ma' => $request->apellido_ma,
                'ci' => $request->ci,
                'type' => $request->type,
            ]);

            if ($request->hasFile('img')) {
                $image = $request->file('img');
                $imageName = time().'.'.$image->getClientOriginalExtension();
                $image->storeAs('avatars', $imageName, 'public'); // Almacenar en la carpeta 'public/avatars'
                $user->avatar = 'avatars/'.$imageName;
                $user->save();
            }

            return back()->with('success', 'Usuario creado con éxito');
        } catch (\Throwable $th) {
            // Manejar la excepción según tus necesidades
            return back()->with('error', 'Ocurrió un error al crear el usuario. '. $th->getMessage());
        }
    }
    public function updateUserNew(Request $request, $id) {
        try {
            $request->validate([
                'nombres' => 'required|string|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/u',
                'name' => 'required|string|max:255|unique:users,name,' . $id,
                'email' => 'required|string|email|max:255|unique:users,email,' . $id,
                'password' => 'nullable|string|min:8',
                'apellido_pa' => 'required|string|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/u',
                'apellido_ma' => 'nullable|string|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/u',
                'ci' => 'required|string|max:255|unique:users,ci,' . $id,
                'type' => 'required|in:1,2',
                'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $user = User::find($id);
            if (!$user) {
                // Manejar el caso en el que el usuario no se encuentra
                return back()->with('error', 'Usuario no encontrado.');
            }

            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'nombres' => $request->nombres,
                'apellido_pa' => $request->apellido_pa,
                'apellido_ma' => $request->apellido_ma,
                'ci' => $request->ci,
                'type' => $request->type,
                'password' => $request->filled('password') ? Hash::make($request->password) : $user->password,
            ]);

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
    public function deleteUserNew(Request $request) {
        try {
            $user = User::findOrFail($request->id);
            if ($user->status == 1) {
                $user->status = 0;
            } else {
                $user->status = 1;
            }
            $user->update();
    
            return back()->with('message', 'Usuario dado de baja correctamente');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al dar de baja el usuario: ' . $e->getMessage());
        }
    }
    public function pacientesList() {
        $i = 1;
        $pacientes = listaCliente::all();
        $pruebas = listaPruebas::where('status', 1)->where('delete_flag', 0)->get();
        return view('admin.pacientes.index', compact('pacientes', 'i', 'pruebas'));
    }
    public function storePaciente(Request $request) {
        try {
            $request->validate([
                'name' => 'required|string|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/u',
                'apellido_pa' => 'required|string|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/u',
                'apellido_ma' => 'nullable|string|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/u',
                'ci' => ['required', 'string', 'max:255', 'unique:users'],
                'gender' => ['required', 'in:Masculino,Femenino'],
                'dob' => ['nullable', 'date'],
                'contact' => ['required', 'string', 'max:255'],
                'address' => ['nullable', 'string', 'max:255'],
                'email' => ['nullable', 'string', 'email', 'max:255', 'unique:users'],
                'username' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('users', 'name')
                ],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
            $user = User::create([
                'name' => $request->username,
                'nombres' => $request->name,
                'apellido_pa' => $request->apellido_pa,
                'apellido_ma' => $request->apellido_ma,
                'ci' => $request->ci,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'type' => 3,
            ]);

            $user->assignRole('Cliente');
            // Creación del cliente asociado al usuario
            listaCliente::create([
                'gender' => $request->gender,
                'dob' => $request->dob,
                'contact' => $request->contact,
                'address' => $request->address,
                'user_id' => $user->id,
            ]);
            return back()->with('message', 'Paciente registrado correctamente');
        } catch (\Throwable $th) {
            return back()->with('error', 'Error al registrar: ' . $th->getMessage());
        }
    }
    public function deletepacienteNew(Request $request) {
        try {
            $cli = listaCliente::find($request->id);
            if ($cli->user->avatar) {
                Storage::delete('public/'.$cli->user->avatar);
            }
            User::find($cli->user_id)->delete();
            $cli->delete();
    
            return back()->with('message', 'Usuario eliminado correctamente');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al eliminar el usuario: ' . $e->getMessage());
        }
    }
    public function selectPruebas(Request $request) {
        $tags = [];
        if ($search = $request->name) {
            $tags = listaPruebas::where('name', 'LIKE', "%$search%")->where('delete_flag', 0)->get();
        }
        return response()->json($tags);
    }
    
    public function pruebaNewShow($id) {
        $prueba = listaPruebas::find($id);
        return view('admin.pruebas.show', compact('prueba'));
    }
    
    public function listasCitas() {
        $i = 1;
        $citas = listaCita::all();
        return view('admin.citas.index', compact('citas', 'i'));
    }
    public function citaShow($id) {
        $i = 1;
        $h = 1;
        $cita = listaCita::find($id);
        $hists = listaHistorial::where('appointment_id', $cita->id)->get();
        return view('admin.citas.show', compact('cita', 'hists', 'i', 'h'));
    }
    public function update_appointment_status(Request $request, $id) {
        try {
            $request->validate([
                'remarks' => 'nullable|string|max:255',
                'status' => 'required|numeric',
                
            ]);
            listaCita::find($id)->update(['status' => $request->status]);

            listaHistorial::create([
                'appointment_id' => $id,
                'status' => $request->status,
                'remarks' => $request->remarks ?: 'Sin observaciones',
            ]);

            return back()->with('message', 'Se cambio el estado con éxito');
        } catch (\Throwable $th) {
            return back()->with('error', 'Ocurrió un error al cambiae el estado. ' . $th->getMessage());
        }
    }
    
    public function showSystemInfo() {
        $name = SystemInfo::find(1);
        $shortname = SystemInfo::find(3);
        $logo = SystemInfo::find(5);
        $user_avatar = SystemInfo::find(4);
        return view('admin.config', compact('name', 'logo', 'shortname', 'user_avatar'));
    }
    public function updateInfoSystem(Request $request) {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'short_name' => 'required|string|max:255',
            ]);
            SystemInfo::find(1)->update(['meta_value' => $request->name]);
            SystemInfo::find(3)->update(['meta_value' => $request->short_name]);
            $logo = SystemInfo::find(5);
            if ($request->hasFile('img')) {
                $image = $request->file('img');
                $imageName = time().'.'.$image->getClientOriginalExtension();
                $image->storeAs('uploads', $imageName, 'public');
                $logo->meta_value = 'uploads/'.$imageName;
                $logo->save();
            }
            $archivos = $request->file('cover');
            if ($archivos) {
                foreach ($archivos as $archivo) {
                    $nombreArchivo = time() . '_' . $archivo->getClientOriginalName();
                    Storage::putFileAs('public/publicidad', $archivo, $nombreArchivo);
                    ImagenFile::create(['path' => $nombreArchivo]);
                }
            }
            return back()->with('message', 'La actualización se realizo con éxito');
        } catch (\Throwable $th) {
            return back()->with('error', 'Ocurrió un error. ' . $th->getMessage());
        }
    }
    public function deleteImg($id) {
        ImagenFile::find($id)->delete();
        return back()->with('message', 'La imagen se borro exitosamente');
    }
    public function addPacienteCita($id) {
        $cliente = listaCliente::find($id);
        return view('admin.pacientes.new_cita', compact('cliente'));
    }
}
