<?php

namespace App\Http\Controllers;

use App\Models\listaCita;
use App\Models\listaCliente;
use App\Models\listaHistorial;
use App\Models\listaPruebas;
use App\Models\SystemInfo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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
                'nombres' => 'required|string|max:255',
                'name' => 'required|string|max:255|unique:users',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
                'apellido_pa' => 'required|string|max:255',
                'apellido_ma' => 'string|max:255',
                'ci' => 'required|string|max:255|unique:users',
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
                'nombres' => 'required|string|max:255',
                'name' => 'required|string|max:255|unique:users,name,' . $id,
                'email' => 'required|string|email|max:255|unique:users,email,' . $id,
                'password' => 'nullable|string|min:8',
                'apellido_pa' => 'required|string|max:255',
                'apellido_ma' => 'nullable|string|max:255',
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
            if ($user->avatar) {
                Storage::delete('public/'.$user->avatar);
            }
            $user->delete();
    
            return back()->with('message', 'Usuario eliminado correctamente');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al eliminar el usuario: ' . $e->getMessage());
        }
    }
    public function pacientesList() {
        $i = 1;
        $pacientes = listaCliente::all();
        return view('admin.pacientes.index', compact('pacientes', 'i'));
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
    public function pruebasList() {
        $i = 1;
        $pruebas = listaPruebas::where('delete_flag', 0)->get();
        $form = SystemInfo::find(10);
        $valorDefecto = $form->meta_value;
        return view('admin.pruebas.index', compact('pruebas', 'i', 'valorDefecto'));
    }
    public function pruebaNew(Request $request) {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'cost' => 'required|numeric|min:1',
                'status' => 'required|numeric',
                'description' => 'required|string',
            ]);

            listaPruebas::create([
                'name' => $request->name,
                'cost' => $request->cost,
                'status' => $request->status,
                'description' => $request->description,
            ]);

            return back()->with('success', 'Prueba creado con éxito');
        } catch (\Throwable $th) {
            return back()->with('error', 'Ocurrió un error al crear la Prueba. ' . $th->getMessage());
        }
    }
    public function pruebaNewShow($id) {
        $prueba = listaPruebas::find($id);
        return view('admin.pruebas.show', compact('prueba'));
    }
    public function pruebaEditar(Request $request, $id) {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'cost' => 'required|numeric|min:1',
                'status' => 'required|numeric',
                'description' => 'required|string',
            ]);

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
                'remarks' => 'required|string|max:255',
                'status' => 'required|numeric',
                
            ]);
            listaCita::find($id)->update(['status' => $request->status]);

            listaHistorial::create([
                'appointment_id' => $id,
                'status' => $request->status,
                'remarks' => $request->remarks,
            ]);

            return back()->with('message', 'Se cambio el estado con éxito');
        } catch (\Throwable $th) {
            return back()->with('error', 'Ocurrió un error al cambiae el estado. ' . $th->getMessage());
        }
    }
    public function llenar_fomraulario($id) {
        $prueba = listaPruebas::find($id);
        return view('admin.citas.informa',compact('prueba'));
    }
    public function addFormularioPDF(Request $request) {
        dd('Crear PDF');
    }
    public function showSystemInfo() {
        $infos = [];
        $info = SystemInfo::all();
        return view('admin.config', compact('info'));
    }
}
