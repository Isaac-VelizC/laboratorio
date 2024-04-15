<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\InformeController;
use App\Http\Controllers\PruebaController;
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
})->name('home');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    //calendario
    Route::get('/user/cliente', [ClienteController::class, 'index'])->name('cliente.perfil');
    Route::post('/user/update/{id}', [ClienteController::class, 'actualizarPerfil'])->name('cliente.update.perfil');
    Route::get('/user/cliente/citas', [ClienteController::class, 'misCitas'])->name('cliente.citas');
    Route::post('/user/cliente/citas/store', [ClienteController::class, 'storeCitas'])->name('cliente.citas.new');
    Route::post('/user/cliente/citas/update/{id}', [ClienteController::class, 'updateCitas'])->name('cliente.citas.edit');
    Route::delete('/user/cliente/citas/delete', [ClienteController::class, 'deleteCita'])->name('admin.citas.delete');
    
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
    Route::post('/admin/createpacoent', [AdminController::class, 'storePaciente'])->name('admin.create.client');
    //PUEBAS
    Route::get('/admin/pruebas', [PruebaController::class, 'pruebasList'])->name('admin.list.prueba');
    Route::get('/admin/add/new/test', [PruebaController::class, 'formNewTest'])->name('admin.form.new.prueba');
    Route::post('/admin/pruebas/create', [PruebaController::class, 'pruebaNew'])->name('admin.new.prueba');
    Route::get('/admin/pruebas/edit/{id}/view', [PruebaController::class, 'formEditTest'])->name('admin.form.edit.prueba');
    Route::post('/admin/pruebas/edit/{id}', [PruebaController::class, 'pruebaEditar'])->name('admin.edit.prueba');
    Route::get('/admin/pruebas/show/{id}', [AdminController::class, 'pruebaNewShow'])->name('admin.prueba.show');
    Route::delete('/admin/pruebas/borrar', [PruebaController::class, 'deletePruebaNew'])->name('admin.prueba.delete');
    Route::delete('/admin/delete/prueba', [PruebaController::class, 'deletePrueba'])->name('admin.delete');

    Route::get('/admin/citas/all', [AdminController::class, 'listasCitas'])->name('admin.list.citas');
    Route::get('/admin/citas/show/{id}', [AdminController::class, 'citaShow'])->name('admin.cita.show');
    Route::post('/admin/appointment/status/{id}', [AdminController::class, 'update_appointment_status'])->name('admin.cita.status');
    Route::get('/admin/citas/form/{id}/{cita}', [PruebaController::class, 'llenar_formulario'])->name('admin.llenar.form');
    Route::post('/admin/citas/form/add', [PruebaController::class, 'addFormularioPDF'])->name('admin.guardar.informe');
    Route::post('/admin/citas/admin/add', [PruebaController::class, 'addFormularioAdmin'])->name('admin.guardar.admin');
    Route::get('/admin/configuracion', [AdminController::class, 'showSystemInfo'])->name('admin.system.info');
    Route::post('/admin/configuracion/update', [AdminController::class, 'updateInfoSystem'])->name('admin.system.update');
    Route::get('/admin/delete/img/{id}', [AdminController::class, 'deleteImg'])->name('admin.delete.img');

    Route::get('/admin/pacientes/{id}/edit', [ClienteController::class, 'editPacienteNew'])->name('admin.paciente.edit');
    Route::post('/admin/pacientes/{id}/edit', [ClienteController::class, 'updatePacienteNew'])->name('admin.paciente.update');
    
    Route::get('/cita/ver/add/{id}', [AdminController::class, 'addPacienteCita'])->name('admin.cita.new.add');
    
    Route::post('/select',[AdminController::class, 'selectPruebas'])->name('search.pruebas');

    //Informes
    Route::get('/admin/informes/info', [InformeController:: class, 'index'])->name('admin.informe.info');
    Route::post('/admin/informes1/info', [InformeController:: class, 'informe1'])->name('admin.informe1.info1');
    
    Route::get('/admin/informesBioquimico/info', [InformeController:: class, 'informeBioquimico'])->name('admin.informe.info2');
    Route::post('/admin/informes2/info', [InformeController:: class, 'informeBioquimicoList'])->name('admin.informe1.info22');
    Route::get('/admin/informesPacientes/info', [InformeController:: class, 'informePaciente'])->name('admin.informe.info3');
    Route::post('/admin/informes3/info', [InformeController:: class, 'informePacienteList'])->name('admin.informe1.info33');

    Route::get('/admin/pago/{id}/pdf', [InformeController::class, 'generatePDFPago'])->name('admin.pdf.pago');
});
