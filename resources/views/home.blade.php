@extends('layouts.app')

@section('content')
    <div class="page-heading">
        <h3>Sistema de Laboratorio Clínico</h3>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-12">
                <div class="row">
                    @if(auth()->user()->type != 3)
                        <div class="col-12 col-lg-3 col-md-6">
                            <div class="card">
                                <div class="card-body px-3 py-4-5">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="stats-icon purple">
                                                <i class="bi bi-clipboard-data"></i>
                                            </div>
                                        </div>
                                        <div class="col-8">
                                            <h6 class="text-muted font-semibold">Pruebas</h6>
                                            <h6 class="font-extrabold mb-0">{{ $testListCount }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-3 col-md-6">
                            <div class="card">
                                <div class="card-body px-3 py-4-5">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="stats-icon blue">
                                                <i class="bi bi-person-check"></i>
                                            </div>
                                        </div>
                                        <div class="col-8">
                                            <h6 class="text-muted font-semibold">Citas de Pacientes</h6>
                                            <h6 class="font-extrabold mb-0">{{ $citaListStatus0Count }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-3 col-md-6">
                            <div class="card">
                                <div class="card-body px-3 py-4-5">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="stats-icon green">
                                                <i class="bi bi-calendar-event"></i>
                                            </div>
                                        </div>
                                        <div class="col-8">
                                            <h6 class="text-muted font-semibold">Citas Aprobadas</h6>
                                            <h6 class="font-extrabold mb-0">{{ $citaListStatus123Count }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-3 col-md-6">
                            <div class="card">
                                <div class="card-body px-3 py-4-5">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="stats-icon red">
                                                <i class="bi bi-people"></i>
                                            </div>
                                        </div>
                                        <div class="col-8">
                                            <h6 class="text-muted font-semibold">Pacientes</h6>
                                            <h6 class="font-extrabold mb-0">{{ $clientListTotalCount }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-3 col-md-6">
                            <div class="card">
                                <div class="card-body px-3 py-4-5">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="stats-icon red">
                                                <i class="bi bi-card-checklist"></i>
                                            </div>
                                        </div>
                                        <div class="col-8">
                                            <h6 class="text-muted font-semibold">Pruebas Terminadas</h6>
                                            <h6 class="font-extrabold mb-0">{{ $citaListStatus6Count }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @role('Cliente')
                        <div class="col-12 col-lg-3 col-md-6">
                            <div class="card">
                                <div class="card-body px-3 py-4-5">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="stats-icon green">
                                                <i class="bi bi-calendar3-week"></i>
                                            </div>
                                        </div>
                                        <div class="col-8">
                                            <h6 class="text-muted font-semibold">Citas Pendientes</h6>
                                            <h6 class="font-extrabold mb-0">{{ $pendientes }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-3 col-md-6">
                            <div class="card">
                                <div class="card-body px-3 py-4-5">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="stats-icon red">
                                                <i class="bi bi-calendar-event"></i>
                                            </div>
                                        </div>
                                        <div class="col-8">
                                            <h6 class="text-muted font-semibold">Citas Aprobadas</h6>
                                            <h6 class="font-extrabold mb-0">{{ $aprobadas }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-3 col-md-6">
                            <div class="card">
                                <div class="card-body px-3 py-4-5">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="stats-icon red">
                                                <i class="bi bi-card-checklist"></i>
                                            </div>
                                        </div>
                                        <div class="col-8">
                                            <h6 class="text-muted font-semibold">Pruebas Terminadas</h6>
                                            <h6 class="font-extrabold mb-0">{{ $terminadas }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endrole
                </div>
                @role('Admin')
                <div class="row">
                    <div class="col-md-4">
                        <canvas id="patientsChart"></canvas>
                    </div>
                    <div class="col-md-4">
                        <canvas id="patientsChartTest"></canvas>
                    </div>
                    <div class="col-md-4">
                        <canvas id="clientsChartTest"></canvas>
                    </div>
                </div>
                @endrole
            </div>
        </section>
    </div>
    
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Obtener los datos de los pacientes por periodo
        fetch('/admin/informe/pacientes-por-periodo')
            .then(response => response.json())
            .then(data => {
                const patientsChart = new Chart(document.getElementById('patientsChart'), {
                    type: 'bar',
                    data: {
                        labels: ['Hoy', 'Esta semana', 'Este mes'],
                        datasets: [{
                            label: 'Citas por periodo',
                            data: [data.pacientesPorDia, data.pacientesPorSemana, data.pacientesPorMes],
                            backgroundColor: [
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)'
                            ],
                            borderColor: [
                                'rgba(54, 162, 235, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            });
    </script>
    <script>
        // Obtener los datos de los pacientes por periodo
        fetch('/admin/informe/pruebas-terminadas-periodo')
            .then(response => response.json())
            .then(data => {
                const patientsChart = new Chart(document.getElementById('patientsChartTest'), {
                    type: 'bar',
                    data: {
                        labels: ['Hoy', 'Esta semana', 'Este mes'],
                        datasets: [{
                            label: 'Pruebas terminadas por periodo',
                            data: [data.completedTestsByDay, data.completedTestsByWeek, data.completedTestsByMonth],
                            backgroundColor: [
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)'
                            ],
                            borderColor: [
                                'rgba(54, 162, 235, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            });
    </script>

<script>
    // Obtener los datos de los pacientes por periodo
    fetch('/admin/informe/clientes-registros-periodo')
        .then(response => response.json())
        .then(data => {
            const patientsChart = new Chart(document.getElementById('clientsChartTest'), {
                type: 'bar',
                data: {
                    labels: ['Hoy', 'Esta semana', 'Este mes'],
                    datasets: [{
                        label: 'Registro de Clientes por Periodo',
                        data: [data.completedTestsByDay, data.completedTestsByWeek, data.completedTestsByMonth],
                        backgroundColor: [
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)'
                        ],
                        borderColor: [
                            'rgba(54, 162, 235, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
</script>
    
@endsection