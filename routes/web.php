<?php

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
});
