<?php

namespace App\Http\Controllers;

use App\Models\listaPruebaCita;
use App\Models\listaPruebas;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function PHPSTORM_META\map;

class InformeController extends Controller
{
    public function index() {
        $pruebas = listaPruebas::where('delete_flag', 0)->get();
        return view('admin.informes.index', compact('pruebas'));
    }

    public function informe1(Request $request)
    {
        try {
            $request->validate([
                'prueba' => 'nullable|numeric',
                'mes' => 'nullable|month',
                'fecha' => 'nullable|date',
                'tipo' => 'required|numeric|in:1,2',
            ]);

            $resul = [];
            if (empty($request->prueba) && $request->tipo == 2) {
                return response()->json(['error' => 'Seleccione una prueba'], 400);
            } else {
                if ($request->filled('mes')) {
                    if ($request->tipo == 1) {
                        $resul = $this->generarInformePorMes($request->mes);
                    } else {
                        $resul = $this->generarInformePorMesClient($request->mes, $request->prueba);
                    }
                } else if ($request->filled('fecha')) {
                    if ($request->tipo == 1) {
                        $resul = $this->generarInformePorFecha($request->fecha, $request->prueba);
                    } else {
                        $resul = $this->generarInformePorFechaClient($request->fecha, $request->prueba);
                    }
                } else {
                    return response()->json(['error' => 'No hay nada para procesar'], 400);
                }
            }

            return response()->json(['data' => $resul], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error al realizar el informe: ' . $th->getMessage()], 500);
        }
    }

    public function generarInformePorFecha($fecha)
    {
        
        $fech = Carbon::parse($fecha);
        // Consulta para obtener las pruebas con más citas para una fecha específica
        $pruebasConMasCitas = listaPruebaCita::select('test_id', DB::raw('COUNT(*) as cantidad_citas'))
            ->whereDate('created_at', $fech)
            ->groupBy('test_id')
            ->orderByDesc('cantidad_citas')
            ->limit(10) // Limitar a las 10 pruebas con más citas
            ->get();
            // Mapear los resultados
        $resultadosMapeados = $pruebasConMasCitas->map(function ($prueba) {
            return [
                'Prueba' => $prueba->test->name,
                'Cantidad_citas' => $prueba->cantidad_citas,
                'Costo Prueba' => $prueba->test->cost,
            ];
        });
        return $resultadosMapeados;
    }

    public function generarInformePorMes($mes)
    {
        $fecha = Carbon::parse($mes);

        // Consulta para obtener las pruebas con más citas para un mes específico
        $pruebasConMasCitas = listaPruebaCita::select('test_id', DB::raw('COUNT(*) as cantidad_citas'))
            ->whereYear('created_at', $fecha->year)
            ->whereMonth('created_at', $fecha->month)
            ->groupBy('test_id')
            ->orderByDesc('cantidad_citas')
            ->limit(10) // Limitar a las 10 pruebas con más citas
            ->get();
        
        // Mapear los resultados
        $resultadosMapeados = $pruebasConMasCitas->map(function ($prueba) {
            return [
                'Prueba' => $prueba->test->name,
                'Cantidad_citas' => $prueba->cantidad_citas,
                'Costo Prueba' => $prueba->test->cost,
            ];
        });

        return $resultadosMapeados;
    }

    private function mapResults($pruebasConMasCitas) {
        return $pruebasConMasCitas->map(function ($prueba) {
            return [
                'Prueba' => $prueba->test->name,
                'Costo Prueba' => $prueba->test->cost,
                'Codigo Cita' => $prueba->appointment->code,
                'Cliente' => $prueba->appointment->client->user->nombres . ' ' .$prueba->appointment->client->user->apellido_pa . ' ' .$prueba->appointment->client->user->apellido_ma,
                'CI' => $prueba->appointment->client->user->ci,
                'Fecha' => $prueba->appointment->schedule,
            ];
        });
    }

    public function generarInformePorFechaClient($fecha, $prueba) {
        $fech = Carbon::parse($fecha);
        // Consulta para obtener las pruebas con más citas para una fecha específica
        $pruebasConMasCitas = listaPruebaCita::where('test_id', $prueba)
            ->whereDate('created_at', $fech)->get();
        
        return $this->mapResults($pruebasConMasCitas);
    }

    public function generarInformePorMesClient($mes, $prueba) {
        $fecha = Carbon::parse($mes);
        // Consulta para obtener las pruebas con más citas para un mes específico
        $pruebasConMasCitas = listaPruebaCita::where('test_id', $prueba)
            ->whereYear('created_at', $fecha->year)
            ->whereMonth('created_at', $fecha->month)
            ->get();

        return $this->mapResults($pruebasConMasCitas);
    }

}
