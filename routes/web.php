<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClienteController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $redirectPath = auth()->guest() ? 'login' : route('home');
    return redirect($redirectPath);
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    //calendario
    Route::get('/user/cliente', [ClienteController::class, 'index'])->name('cliente.perfil');
    Route::get('/user/cliente/citas', [ClienteController::class, 'misCitas'])->name('cliente.citas');
    Route::get('/user/cliente/pruebas', [ClienteController::class, 'resultados'])->name('cliente.resultados');

    ///Admin
    Route::get('/admin/users', [AdminController::class, 'usersList'])->name('admin.list.user');
    Route::get('/admin/users/create', [AdminController::class, 'createUserNew'])->name('admin.user.create');
    Route::get('/admin/users/{id}/edit', [AdminController::class, 'editUserNew'])->name('admin.user.edit');
    Route::post('/admin/users/create', [AdminController::class, 'storeUserNew'])->name('admin.user.store');
    Route::post('/admin/users/{id}/edit', [AdminController::class, 'updateUserNew'])->name('admin.user.update');
    Route::delete('/admin/users/borrar', [AdminController::class, 'deleteUserNew'])->name('admin.user.delete');
    
    Route::get('/admin/pacientes', [AdminController::class, 'pacientesList'])->name('admin.list.paciente');
    Route::delete('/admin/pacientes/borrar', [AdminController::class, 'deletepacienteNew'])->name('admin.paciente.delete');
    Route::get('/admin/pruebas', [AdminController::class, 'pruebasList'])->name('admin.list.prueba');
});
