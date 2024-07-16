<?php

namespace App\Http\Controllers;

use App\Models\listaCita;
use App\Models\listaCliente;
use App\Models\listaPruebas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();
        if ($user->status == 1) {
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
                $testListCount = listaPruebas::where('delete', 0)->where('status', 1)->count();
                $citaListTotalCount = listaCita::count();
                $citaListStatus0Count = listaCita::where('status', 0)->count();
                $citaListStatus123Count = listaCita::whereIn('status', [1, 2, 3])->count();
                $citaListStatus6Count = listaCita::where('status', 4)->count();
                $clientListTotalCount = listaCliente::count();
                return view('home', compact('testListCount', 'citaListTotalCount', 'citaListStatus0Count', 'citaListStatus123Count', 'citaListStatus6Count', 'clientListTotalCount'));
            }
        }
        else {
            return view('welcome');
        }
    }

    public function pageCopiasSeguridad() {
        $disk = Storage::disk('local');
        $files = $disk->files('backups');
        $backups = [];

        foreach ($files as $file) {
            $backups[] = [
                'path' => $file,
                'size' => $disk->size($file),
            ];
        }

        return view('admin.backup.index', compact('backups'));
    }
    // Método para ejecutar el backup
    public function runBackup()
    {
        try {
            Artisan::call('backup:run');
            return redirect()->back()->with('success', 'Backup ejecutado correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al ejecutar el backup: ' . $e->getMessage());
        }
    }

    public function downloadBackup($file)
    {
        $filePath = 'backups/' . $file;

        if (Storage::disk('local')->exists($filePath)) {
            return Storage::disk('local')->download($filePath);
        }

        return redirect()->back()->with('error', 'El archivo de backup no existe.');
    }

    public function deleteBackup($name) {
        $filePath = 'backups/' . $name;

        if (Storage::disk('local')->exists($filePath)) {
            Storage::disk('local')->delete($filePath);
            return back()->with('success', 'Backup eliminado exitosamente.');
        }

        return back()->with('error', 'No existe el archivo del backup.');
    }

}
