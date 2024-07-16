<?php

namespace App\Http\Controllers;

use App\Models\Horario;
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
    public function index()
    {
        $pruebas = listaPruebas::where('delete', 0)->get();
        return view('admin.informes.index', compact('pruebas'));
    }

    public function informe1(Request $request) {
        try {
            $request->validate([
                'prueba' => 'nullable|numeric',
                'mes' => 'nullable|month',
                'fecha' => 'nullable|date',
                'tipo' => 'required|numeric|in:1,2,3',
            ]);

            $resul = [];

            if ($request->filled('prueba')) {
                if ($request->tipo == 1) {
                    $resul = $this->generarInformePorPrueba($request);
                } elseif ($request->tipo == 2) {
                    $resul = $this->generarInformePorEdad($request);
                } elseif ($request->tipo == 3) {
                    $resul = $this->generarInformePorSexo($request);
                }
            } else {
                return response()->json(['error' => 'No hay nada para procesar'], 400);
            }
            //dd($resul);

            return response()->json(['data' => $resul], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error al realizar el informe: ' . $th->getMessage()], 500);
        }
    }
    
    public function generarInformePorPrueba(Request $request) {
        $pruebasConMasCitas = listaPruebaCita::where('test_id', $request->prueba)
            ->whereHas('appointment', function ($query) use ($request) {
                if ($request->has('mes') && $request->mes != null ) {
                    $query->whereMonth('fecha', Carbon::parse($request->mes)->month);
                } elseif ($request->has('fecha')) {
                    $query->whereDate('fecha', $request->fecha);
                }
            })
            ->get()
            ->groupBy(function ($item) {
                return $item->appointment->client->user->nombres . ' ' . $item->appointment->client->user->apellido_pa . ' ' . $item->appointment->client->user->apellido_ma;
            });

        return $pruebasConMasCitas->map(function ($group, $cliente) {
            $totalCosto = 0;
            foreach ($group as $prueba) {
                $totalCosto += $prueba->test->cost;
            }
            return [
                'Prueba' => $group->first()->test->name,
                'Cliente' => $cliente,
                'Cantidad' => $group->count(),
                'Costo Prueba' => $group->first()->test->cost,
                'Total Costo' => $totalCosto,
                //'Fecha' => $request->has('mes') ? 'Mes' : 'Fecha',
            ];
        })->values()->toArray();
    }

    public function generarInformePorEdad(Request $request) {
        $pruebasConMasCitas = listaPruebaCita::where('test_id', $request->prueba)
            ->whereHas('appointment', function ($query) use ($request) {
                if ($request->has('mes') && $request->mes != null) {
                    $query->whereMonth('fecha', Carbon::parse($request->mes)->month);
                } elseif ($request->has('fecha')) {
                    $query->whereDate('fecha', $request->fecha);
                }
            })
            ->get()
            ->groupBy(function ($item) {
                return $item->appointment->client->user->nombres . ' ' . $item->appointment->client->user->apellido_pa . ' ' . $item->appointment->client->user->apellido_ma;
            });

        return $pruebasConMasCitas->map(function ($group, $cliente) {
            $fechaNacimiento = Carbon::parse($group->first()->appointment->client->dob);
            $fechaActual = Carbon::now();
            $edad = $fechaActual->diffInYears($fechaNacimiento);
            return [
                'Prueba' => $group->first()->test->name,
                'Cliente' => $cliente,
                'Edad' => $edad,
                'Fecha' => Carbon::now()->format('y-m'),
            ];
        })->values()->toArray();
    }

    public function generarInformePorSexo(Request $request) {
        $pruebasConMasCitas = listaPruebaCita::where('test_id', $request->prueba)
            ->whereHas('appointment', function ($query) use ($request) {
                if ($request->has('mes') && $request->mes != null) {
                    $query->whereMonth('fecha', Carbon::parse($request->mes)->month);
                } elseif ($request->has('fecha')) {
                    $query->whereDate('fecha', $request->fecha);
                }
            })
            ->get()
            ->groupBy(function ($item) {
                return $item->appointment->client->user->nombres . ' ' . $item->appointment->client->user->apellido_pa . ' ' . $item->appointment->client->user->apellido_ma;
            });
    
        return $pruebasConMasCitas->map(function ($group, $cliente) {
            $sexo = $group->first()->appointment->client->gender;
            return [
                'Prueba' => $group->first()->test->name,
                'Cliente' => $cliente,
                'Sexo' => $sexo,
                'Fecha' => Carbon::now()->format('y-m'),
            ];
        })->values()->toArray();
    }
    
    public function generatePDFPago($id)
    {
        $cita = listaCita::find($id);
        $name = SystemInfo::find(3);
        $pdf = PDF::loadView('pdfs.pago', ['cita' => $cita, 'name' => $name->meta_value]);
        return $pdf->stream('invoice.pdf');
    }
    ///Redirecciones
    public function informeBioquimico()
    {
        $pruebas = listaPruebas::where('delete', 0)->get();
        $bioquimicos = User::where('type', 2)->get();
        $horarios = Horario::all();
        return view('admin.informes.infoBioquimico', compact('bioquimicos', 'pruebas', 'horarios'));
    }

    public function informePaciente()
    {
        $pacientes = listaCliente::all();
        $pruebas = listaPruebas::where('delete', 0)->get();
        // Obtener la cantidad de pacientes menores de 18 años
        $menores_de_18 = listaCliente::whereHas('user', function ($query) {
            $query->where('dob', '>', Carbon::now()->subYears(18));
        })->count();

        // Obtener la cantidad de pacientes mayores de 18 años
        $mayores_de_18 = listaCliente::whereHas('user', function ($query) {
            $query->where('dob', '<=', Carbon::now()->subYears(18));
        })->count();
        return view('admin.informes.infoPaciente', compact('pruebas', 'pacientes', 'menores_de_18', 'mayores_de_18'));
    }
    ///Infomres Bioquimico

    public function informeBioquimicoList(Request $request)
    {
        try {
            $request->validate([
                'prueba' => 'required|numeric',
                //'mes' => 'nullable|month',
                'date' => 'nullable|date',
                'bioquimico' => 'nullable|numeric',
                'hora_inicio' => 'nullable|string',
                'hora_fin' => 'nullable|string',
            ]);
            $resul = [];
            
            $prueba = listaPruebas::find($request->prueba);
            if ($request->hora_inicio == null && $request->hora_fin == null) {
                $resul = $this->realizarBusquedas($request, $prueba);
            } else {
                $dataByHora = listaPruebaCita::with(['appointment.client', 'appointment.user'])
                ->whereHas('appointment', function ($query) use ($request) {
                    if ($request->has('bioquimico')) {
                        $query->where('bio_id', $request->bioquimico);
                    }
                    if ($request->has('hora_inicio') && $request->has('hora_fin')) {
                        $query->whereBetween('horario', [$request->hora_inicio, $request->hora_fin]);
                    }
                })
                ->whereDate('fecha', $request->date)
                ->where('test_id', $request->prueba)
                ->get()
                ->groupBy(function ($item) {
                    return $item->bioquimico->nombres . ' ' . $item->bioquimico->apellido_pa . ' ' . $item->bioquimico->apellido_ma;
                })
                ->map(function ($group) use ($prueba, $request) {
                    $horas = $request->hora_inicio . ' - '. $request->hora_fin;
                    return [
                        'Bioquimico' => $group->first()->bioquimico->nombres . ' ' . $group->first()->bioquimico->apellido_pa . ' ' . $group->first()->bioquimico->apellido_ma,
                        'prueba' => $prueba->name,
                        'cantidad' => $group->count(),
                        'Hora' => $horas,
                    ];
                })
                ->values()
                ->toArray();
                $resul = $dataByHora;
            }

            return response()->json(['data' => $resul]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    private function realizarBusquedas($request, $prueba) {
        $resultado = [];
        if ($request->has('mes') && $request->mes != null) {
            // Obtener datos por mes
            $dataByMonth = listaPruebaCita::with(['appointment.client', 'appointment.user'])
                ->whereHas('appointment', function ($query) use ($request) {
                    if ($request->has('bioquimico')) {
                        $query->where('bio_id', $request->bioquimico);
                    }
                })
                ->whereMonth('fecha', Carbon::parse($request->mes)->month)
                ->where('test_id', $request->prueba)
                ->get()
                ->groupBy(function ($item) {
                    return $item->bioquimico->nombres . ' ' . $item->bioquimico->apellido_pa . ' ' . $item->bioquimico->apellido_ma;
                })
                ->map(function ($group) use ($prueba) {
                    return [
                        'Bioquimico' => $group->first()->bioquimico->nombres . ' ' . $group->first()->bioquimico->apellido_pa . ' ' . $group->first()->bioquimico->apellido_ma,
                        'prueba' => $prueba->name,
                        'cantidad' => $group->count(),
                        'mes' => Carbon::parse($group->first()->fecha)->format('F'),
                    ];
                })
                ->values()
                ->toArray();
            $resultado = $dataByMonth;
        } elseif ($request->has('date') && $request->date != null) {
            // Obtener datos por fecha
            $dataByDate = listaPruebaCita::with(['appointment.client', 'appointment.user'])
                ->whereHas('appointment', function ($query) use ($request) {
                    if ($request->has('bioquimico')) {
                        $query->where('bio_id', $request->bioquimico);
                    }
                })
                ->whereDate('fecha', $request->date)
                ->where('test_id', $request->prueba)
                ->get()
                ->groupBy(function ($item) {
                    return $item->bioquimico->nombres . ' ' . $item->bioquimico->apellido_pa . ' ' . $item->bioquimico->apellido_ma;
                })
                ->map(function ($group) use ($prueba) {
                    return [
                        'Bioquimico' => $group->first()->bioquimico->nombres . ' ' . $group->first()->bioquimico->apellido_pa . ' ' . $group->first()->bioquimico->apellido_ma,
                        'prueba' => $prueba->name,
                        'cantidad' => $group->count(),
                        'fecha' => $group->first()->fecha,
                    ];
                })
                ->values()
                ->toArray();
            $resultado = $dataByDate;
        } else {
            $dataByTest = listaPruebaCita::with(['appointment.client', 'appointment.user'])
                ->whereHas('appointment', function ($query) use ($request) {
                    if ($request->has('bioquimico')) {
                        $query->where('bio_id', $request->bioquimico);
                    }
                })
                ->where('test_id', $request->prueba)
                ->get()
                ->groupBy(function ($item) {
                    return $item->bioquimico->nombres . ' ' . $item->bioquimico->apellido_pa . ' ' . $item->bioquimico->apellido_ma;
                })
                ->map(function ($group) use ($prueba) {
                    return [
                        'Bioquimico' => $group->first()->bioquimico->nombres . ' ' . $group->first()->bioquimico->apellido_pa . ' ' . $group->first()->bioquimico->apellido_ma,
                        'prueba' => $prueba->name,
                        'cantidad' => $group->count(),
                        'fecha' => $group->first()->fecha,
                    ];
                })
                ->values()
                ->toArray();
            $resultado = $dataByTest;
        }

        return $resultado;
    }

    ///Informes Pacientes
    public function informePacienteList(Request $request)
    {
        try {
            $request->validate([
                'mes' => 'nullable|month',
                'date' => 'nullable|date',
                'paciente' => 'required|numeric',
            ]);
            $resul = [];
            if ($request->has('mes') && $request->mes != null) {
                $dataByMonth = listaPruebaCita::with(['appointment.client', 'test'])
                    ->whereHas('appointment', function ($query) use ($request) {
                        if ($request->has('paciente')) {
                            $query->where('client_id', $request->paciente);
                        }
                    })
                    ->whereMonth('fecha', Carbon::parse($request->mes)->month)
                    ->get()
                    ->groupBy(function ($item) {
                        return $item->appointment->client->name . ' - ' . $item->test->name;
                    })
                    ->map(function ($group) {
                        return [
                            'nombre_paciente' => $group->first()->appointment->client->user->nombres . ' ' . $group->first()->appointment->client->user->apellido_pa,
                            'prueba' => $group->first()->test->name,
                            'cantidad' => $group->count(),
                            'mes' => Carbon::parse()->format('F'),
                        ];
                    })
                    ->values()
                    ->toArray();

                if (count($dataByMonth) > 0) {
                    $resul = [
                        'data' => $dataByMonth,
                    ];
                } else {
                    $resul = [
                        'data' => 'No hay datos que mostrar',
                    ];
                }
            } else {
                // Obtener datos por fecha
                $dataByDate = listaPruebaCita::with(['appointment.client', 'test'])
                    ->whereHas('appointment', function ($query) use ($request) {
                        if ($request->has('paciente')) {
                            $query->where('client_id', $request->paciente);
                        }
                    })
                    ->when($request->has('date'), function ($query) use ($request) {
                        $query->whereDate('fecha', $request->date);
                    })
                    ->get()
                    ->groupBy(function ($item) {
                        return $item->appointment->client->name . ' - ' . $item->test->name . ' - ' . $item->fecha;
                    })
                    ->map(function ($group) {
                        return [
                            'nombre_paciente' => $group->first()->appointment->client->user->nombres . ' ' . $group->first()->appointment->client->user->apellido_pa,
                            'prueba' => $group->first()->test->name,
                            'fecha' => $group->first()->fecha,
                        ];
                    })
                    ->values()
                    ->toArray();

                $resul = [
                    'data' => $dataByDate,
                ];
            }

            return response()->json($resul);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function pacientesPorPeriodo() {
        $hoy = Carbon::today();
        
        $pacientesPorDia = listaCita::whereDate('fecha', $hoy->format('Y-m-d'))->count();

        // Pacientes por semana
        $pacientesPorSemana = listaCita::whereDate('fecha', '>=', $hoy->startOfWeek())
            ->whereDate('fecha', '<=', $hoy->endOfWeek())
            ->count();

        // Pacientes por mes
        $pacientesPorMes = listaCita::whereMonth('fecha', $hoy->month)
            ->whereYear('fecha', $hoy->year)
            ->count();

        return response()->json([
            'pacientesPorDia' => $pacientesPorDia,
            'pacientesPorSemana' => $pacientesPorSemana,
            'pacientesPorMes' => $pacientesPorMes,
        ]);
    }
    

    public function getCompletedTestsByPeriod() {
        $hoy = Carbon::today();
        
        $completedTestsByDay = listaPruebaCita::whereDate('fecha', $hoy->format('Y-m-d'))
            ->where('estado', 2)->count();

        // Pacientes por semana
        $completedTestsByWeek = listaPruebaCita::whereDate('fecha', '>=', $hoy->startOfWeek())
            ->whereDate('fecha', '<=', $hoy->endOfWeek())
            ->where('estado', 2)->count();

        // Pacientes por mes
        $completedTestsByMonth = listaPruebaCita::whereMonth('fecha', $hoy->month)
            ->whereYear('fecha', $hoy->year)
            ->where('estado', 2)->count();

        return response()->json([
            'completedTestsByMonth' => $completedTestsByMonth,
            'completedTestsByDay' => $completedTestsByDay,
            'completedTestsByWeek' => $completedTestsByWeek,
        ]);
    }

    public function getRegisterClientsByPeriod() {
        $hoy = Carbon::today();
        
        $completedTestsByDay = listaCliente::whereDate('created_at', $hoy->format('Y-m-d'))->count();

        // Pacientes por semana
        $completedTestsByWeek = listaCliente::whereDate('created_at', '>=', $hoy->startOfWeek())
            ->whereDate('created_at', '<=', $hoy->endOfWeek())->count();

        // Pacientes por mes
        $completedTestsByMonth = listaCliente::whereMonth('created_at', $hoy->month)
            ->whereYear('created_at', $hoy->year)->count();

        return response()->json([
            'completedTestsByMonth' => $completedTestsByMonth,
            'completedTestsByDay' => $completedTestsByDay,
            'completedTestsByWeek' => $completedTestsByWeek,
        ]);
    }
}
