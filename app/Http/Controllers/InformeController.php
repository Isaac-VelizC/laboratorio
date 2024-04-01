<?php

namespace App\Http\Controllers;

use App\Models\listaCita;
use App\Models\listaCliente;
use App\Models\listaPruebaCita;
use App\Models\listaPruebas;
use App\Models\SystemInfo;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InformeController extends Controller
{
    public function index() {
        $pruebas = listaPruebas::where('delete', 0)->get();
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

    public function generatePDFPago($id) {
        $cita = listaCita::find($id);
        $name = SystemInfo::find(3);
        $pdf = PDF::loadView('pdfs.pago', ['cita' => $cita, 'name' => $name->meta_value]);
        return $pdf->stream('invoice.pdf');
    }

    public function informeBioquimico() {
        $pruebas = listaPruebas::where('delete', 0)->get();
        $bioquimicos = User::where('type', 2)->get();
        return view('admin.informes.infoBioquimico', compact('bioquimicos', 'pruebas'));
    }

    public function informePaciente() {
        $pacientes = listaCliente::all();
        $pruebas = listaPruebas::where('delete', 0)->get();
        // Obtener la cantidad de pacientes menores de 18 años
        $menores_de_18 = listaCliente::whereHas('user', function($query) {
            $query->where('dob', '>', Carbon::now()->subYears(18));
        })->count();

        // Obtener la cantidad de pacientes mayores de 18 años
        $mayores_de_18 = listaCliente::whereHas('user', function($query) {
            $query->where('dob', '<=', Carbon::now()->subYears(18));
        })->count();
        return view('admin.informes.infoPaciente', compact('pruebas', 'pacientes', 'menores_de_18', 'mayores_de_18'));
    }

    public function informeBioquimicoList(Request $request) {
        try {
            $request->validate([
                'prueba' => 'nullable|numeric',
                'mes' => 'nullable|month',
                'bioquimico' => 'nullable|numeric',
            ]);
            $resul = [];
            $prueba = null; // Definir la variable $prueba fuera de los bloques condicionales

            if (empty($request->prueba)) {
                return response()->json(['error' => 'Seleccione una prueba'], 400);
            } else {
                $prueba = listaPruebas::find($request->prueba);

                if ($request->filled('mes')) {
                    $resul = collect([$request->bioquimico])->map(function($bioquimico) use ($request, $prueba) {
                        $user = User::find($bioquimico);
                        return [
                            'Bioquimico' => $user->nombres.' '.$user->apellido_pa.' '.$user->apellido_ma,
                            'prueba' => $prueba->name,
                            'Mes' => $request->mes,
                            'cantidad' => $this->obtCountMes($request),
                        ];
                    });
                    
                } else if ($request->filled('bioquimico')) {
                    $resul = collect([$request->bioquimico])->map(function($bioquimico) use ($request, $prueba) {
                        $user = User::find($bioquimico);
                        return [
                            'Bioquimico' => $user->nombres.' '.$user->apellido_pa.' '.$user->apellido_ma,
                            'prueba' => $prueba->name,
                            'cantidad' => $this->obtCount($request),
                        ];
                    });                    
                } else {
                    $users = User::where('type', 2)->get();
                    $resul = $users->map(function($user) use ($request, $prueba) {
                        return [
                            'Bioquimico' => $user->nombres.' '.$user->apellido_pa.' '.$user->apellido_ma,
                            'prueba' => $prueba->name, // Obtener la prueba desde la solicitud
                            'cantidad' => $this->CountAllBioquimicos($request, $user->id), // Pasar el ID del usuario
                        ];
                    });
                }
            }
            return response()->json(['data' => $resul], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error al realizar el informe: ' . $th->getMessage()], 500);
        }
    }

    private function obtCount($request) {
        $count = User::find($request->bioquimico)
                        ->citas()
                        ->whereHas('pruebas', function ($query) use ($request) {
                            $query->where('test_id', $request->prueba)
                                ->where('status', 4);
                        })
                        ->count();
        return $count;
    }

    private function obtCountMes($request) {
        $resul = User::find($request->bioquimico)
            ->citas()
            ->whereYear('fecha', '=', date('Y', strtotime($request->mes)))
            ->whereMonth('fecha', '=', date('m', strtotime($request->mes)))
            ->whereHas('pruebas', function ($query) use ($request) {
                $query->where('test_id', $request->prueba)
                      ->where('status', 4);
            })
            ->count();
        return $resul;
    }

    private function CountAllBioquimicos($request, $id) {
        $count = User::find($id)
                        ->citas()
                        ->whereHas('pruebas', function ($query) use ($request) {
                            $query->where('test_id', $request->prueba)
                                ->where('status', 4);
                        })
                        ->count();
        return $count;
    }

    public function informePacienteList(Request $request) {
        try {
            $request->validate([
                'prueba' => 'nullable|numeric',
                //'mes' => 'nullable|month',
                'paciente' => 'nullable|numeric',
                'tipo' => 'nullable|numeric|in:1,2',
            ]);

            $resul = [];
            if ($request->filled('paciente')) {
                $users = listaCita::where('client_id', $request->paciente)->get();
                $resul = $users->map(function($user) {
                    return [
                        'cliente' => $user->client->user->nombres.' '.$user->client->user->apellido_pa.' '.$user->client->user->apellido_ma,
                        'fecha' => $user->fecha,
                        'hora' => $user->horario, // Obtener la prueba desde la solicitud
                        'codigo' => $user->code, // Pasar el ID del usuario
                    ];
                });
            } else if ($request->tipo == 1) {
                $resul = $this->pacientesMes();
            } else if ($request->tipo == 2) {
                $resul = $this->pruebasPacientes();
            } else {
                return response()->json(['error' => 'No hay nada para procesar'], 400);
            }
            return response()->json(['data' => $resul], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error al realizar el informe: ' . $th->getMessage()], 500);
        }
    }

    private function pacientesMes() {
        $year = Carbon::now()->year;
        // Consultar la cantidad de pacientes registrados por mes
        $pacientes_por_mes = listaCliente::whereYear('created_at', $year)
            ->get()
            ->groupBy(function($date) {
                return Carbon::parse($date->created_at)->format('m');
            })
            ->map(function($item, $key) {
                return $item->count();
            });
        // Arreglo con los nombres de los meses
        $nombres_meses = [
            'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
            'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
        ];
        // Inicializar un arreglo para almacenar la cantidad de pacientes por mes con el nombre del mes
        $resultados = [];
        // Iterar sobre los meses y construir el arreglo de resultados
        foreach ($pacientes_por_mes as $mesNumero => $cantidad) {
            $mesNombre = $nombres_meses[$mesNumero - 1]; // Convertir el número de mes a nombre de mes
            $resultados[] = [
                'mes' => $mesNombre,
                'cantidad' => $cantidad,
            ];
        }
        return $resultados;
    }
    
    private function pruebasPacientes() {
        $cantidad_pruebas_realizadas = listaPruebaCita::select('test_id', DB::raw('COUNT(id) as cantidad'))
            ->groupBy('test_id')
            ->get();

        $resul = $cantidad_pruebas_realizadas->map(function($item) {
            return [
                'prueba' => $item->test->name,
                'cantidad' => $item->cantidad,
            ];
        });
        return $resul;
    }
}
