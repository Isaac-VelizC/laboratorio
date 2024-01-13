<?php

namespace App\Http\Controllers;

use App\Models\listaCliente;
use App\Models\User;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index() {
        $user = User::find(auth()->user()->id);
        $cliente = listaCliente::where('user_id', $user->id)->first();
        return view('clients.index', compact('cliente', 'user'));
    }
}
