<?php

namespace App\Http\Controllers;

use App\Models\listaCita;
use App\Models\listaCliente;
use App\Models\listaPruebas;
use App\Models\User;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index() {
        $user = User::find(auth()->user()->id);
        $cliente = listaCliente::where('user_id', $user->id)->first();
        return view('clients.index', compact('cliente', 'user'));
    }
    public function misCitas() {
        $i = 0;
        $user = User::find(auth()->user()->id);
        $cliente = listaCliente::where('user_id', $user->id)->first();
        $citas = listaCita::where('client_id', $cliente->id)->get();
        $pruebas = listaPruebas::where('status', 1)->get();
        return view('clients.citas.index', compact('citas', 'i', 'pruebas'));
    }
    public function resultados() {
        
        return view('clients.resultados');
    }
}
