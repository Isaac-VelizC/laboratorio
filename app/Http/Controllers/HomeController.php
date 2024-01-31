<?php

namespace App\Http\Controllers;

use App\Models\listaCita;
use App\Models\listaCliente;
use App\Models\listaPruebas;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();
        if ($user->type == 3) {
            $cliente = listaCliente::where('user_id', $user->id)->first();
            $reservadas = listaCita::where('client_id', $cliente->id)->count();
            $pendientes = listaCita::where('client_id', $cliente->id)->where('status', 0)->count();
            $aprobadas = listaCita::where('client_id', $cliente->id)
            ->whereIn('status', [1, 2, 3])
            ->count();
            $terminadas = listaCita::where('client_id', $cliente->id)->where('status', 4)->count();
            return view('home', compact('pendientes', 'reservadas', 'terminadas', 'aprobadas'));
        } else {
            $testListCount = listaPruebas::where('delete_flag', 0)
                        ->where('status', 1)
                        ->count();
            $citaListTotalCount = listaCita::count();
            $citaListStatus0Count = listaCita::where('status', 0)->count();
            $citaListStatus123Count = listaCita::whereIn('status', [1, 2, 3])->count();
            $citaListStatus6Count = listaCita::where('status', 4)->count();
            $clientListTotalCount = listaCliente::count();
            return view('home', compact('testListCount', 'citaListTotalCount', 'citaListStatus0Count', 'citaListStatus123Count', 'citaListStatus6Count', 'clientListTotalCount'));
        }
    }
}
