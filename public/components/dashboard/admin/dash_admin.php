<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Resumen General</h1>
    <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" href="">
        <i class="fas fa-download fa-sm text-white-50"></i>
        Generar Reporte
    </a>
</div>

<div class="row">
    <!-- Total Usuarios -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Visitas Totales</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800" id="visitasTotales">
                            <div>
                                3450 <span class="text-success"><i class="fas fa-arrow-up"></i> 12%</span>
                            </div>                        
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-eye fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Escuelas Activas -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Escuelas Activas
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"> 315 <span class="text-success"><i class="fas fa-arrow-up"></i> 5%</span></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-school fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Juegos Completados -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Juegos Completados</div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">3,450</div>
                            </div>
                            <div class="col">
                                <div class="progress progress-sm mr-2">
                                    <div class="progress-bar bg-info" role="progressbar"
                                        style="width: 65%" aria-valuenow="65" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-gamepad fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Membresías -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Membresías Activas</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">38</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-id-card fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Content Row -->
<div class="row">
    <!-- Actividad Reciente -->
    <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Actividad Reciente</h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                        aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header">Opciones:</div>
                        <a class="dropdown-item" href="#">Ver todo</a>
                        <a class="dropdown-item" href="#">Exportar datos</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Configurar</a>
                    </div>
                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="activityChart"></canvas>
                </div>
                <div class="mt-4 small">
                    <span class="mr-2">
                        <i class="fas fa-circle text-primary"></i> Estudiantes
                    </span>
                    <span class="mr-2">
                        <i class="fas fa-circle text-success"></i> Profesores
                    </span>
                    <span class="mr-2">
                        <i class="fas fa-circle text-info"></i> Administradores
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Distribución de Usuarios -->
    <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Distribución de Usuarios</h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                        aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header">Opciones:</div>
                        <a class="dropdown-item" href="#">Actualizar</a>
                        <a class="dropdown-item" href="#">Exportar</a>
                    </div>
                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-pie pt-4 pb-2">
                    <canvas id="userDistributionChart"></canvas>
                </div>
                <div class="mt-4 text-center small">
                    <span class="mr-2">
                        <i class="fas fa-circle text-primary"></i> Estudiantes
                    </span>
                    <span class="mr-2">
                        <i class="fas fa-circle text-success"></i> Profesores
                    </span>
                    <span class="mr-2">
                        <i class="fas fa-circle text-info"></i> Directores
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Content Row -->
<div class="row">
    <!-- Juegos Populares -->
    <div class="col-lg-6 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Juegos Más Populares</h6>
            </div>
            <div class="card-body">
                <h4 class="small font-weight-bold">Matemáticas Básicas <span class="float-right">1,245</span></h4>
                <div class="progress mb-4">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: 85%"
                        aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <h4 class="small font-weight-bold">Ortografía Avanzada <span class="float-right">932</span></h4>
                <div class="progress mb-4">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: 65%"
                        aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <h4 class="small font-weight-bold">Historia de Chile <span class="float-right">784</span></h4>
                <div class="progress mb-4">
                    <div class="progress-bar" role="progressbar" style="width: 55%"
                        aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <h4 class="small font-weight-bold">Ciencias Naturales <span class="float-right">621</span></h4>
                <div class="progress mb-4">
                    <div class="progress-bar bg-info" role="progressbar" style="width: 45%"
                        aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <h4 class="small font-weight-bold">Inglés Básico <span class="float-right">498</span></h4>
                <div class="progress">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 35%"
                        aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>

        <!-- Escuelas Destacadas -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Escuelas Destacadas</h6>
            </div>
            <div class="card-body">
                <div class="text-center">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Escuela</th>
                                <th>Estudiantes</th>
                                <th>Progreso</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Colegio Los Alerces</td>
                                <td>142</td>
                                <td><span class="badge badge-success">Alto</span></td>
                            </tr>
                            <tr>
                                <td>Escuela Básica El Roble</td>
                                <td>98</td>
                                <td><span class="badge badge-warning">Medio</span></td>
                            </tr>
                            <tr>
                                <td>Liceo Tecnológico</td>
                                <td>203</td>
                                <td><span class="badge badge-success">Alto</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <a href="escuelas">Ver todas las escuelas &rarr;</a>
            </div>
        </div>
    </div>

    <!-- Estadísticas por Asignatura -->
    <div class="col-lg-6 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Rendimiento por Asignatura</h6>
            </div>
            <div class="card-body">
                <div class="chart-bar pt-4 pb-2">
                    <canvas id="subjectPerformanceChart"></canvas>
                </div>
                <div class="mt-4 text-center small">
                    <span class="mr-2">
                        <i class="fas fa-circle text-primary"></i> Matemáticas
                    </span>
                    <span class="mr-2">
                        <i class="fas fa-circle text-success"></i> Lenguaje
                    </span>
                    <span class="mr-2">
                        <i class="fas fa-circle text-info"></i> Ciencias
                    </span>
                    <span class="mr-2">
                        <i class="fas fa-circle text-warning"></i> Historia
                    </span>
                </div>
                <hr>
                <h5 class="font-weight-bold">Top Estudiantes</h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <img src="<?php echo FAVICON.'avatars/Estudiante.jpeg'; ?>" class="rounded-circle mr-3" width="50" height="50">
                                    <div>
                                        <h6 class="mb-0">María González</h6>
                                        <small class="text-muted">Colegio Los Alerces</small>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <span class="badge badge-primary">Matemáticas: 98%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <img src="<?php echo FAVICON.'avatars/Estudiante.jpeg'; ?>" class="rounded-circle mr-3" width="50" height="50">
                                    <div>
                                        <h6 class="mb-0">Juan Pérez</h6>
                                        <small class="text-muted">Liceo Tecnológico</small>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <span class="badge badge-success">Ciencias: 95%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Notificaciones Recientes -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Notificaciones Recientes</h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                        aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="#">Marcar todas como leídas</a>
                        <a class="dropdown-item" href="#">Configurar notificaciones</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="list-group">
                    <a href="#" class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-1">Nueva escuela registrada</h6>
                            <small>Hace 15 minutos</small>
                        </div>
                        <p class="mb-1">Colegio San Agustín se ha unido a la plataforma.</p>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-1">Asignación completada</h6>
                            <small>Hace 1 hora</small>
                        </div>
                        <p class="mb-1">Profesor González asignó 3 nuevos juegos.</p>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-1">Logro desbloqueado</h6>
                            <small>Hace 3 horas</small>
                        </div>
                        <p class="mb-1">10 estudiantes alcanzaron el logro "Matemático Avanzado".</p>
                    </a>
                </div>
                <a href="notificaciones" class="btn btn-light btn-block mt-3">Ver todas las notificaciones</a>
            </div>
        </div>
    </div>
</div>


<script>
    const ctx = document.getElementById('activityChart').getContext('2d');

    const activityChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb', 'Dom'],
            datasets: [
                {
                    label: 'Estudiantes',
                    data: [12, 19, 14, 20, 16, 10, 9],
                    borderColor: '#4e73df',
                    backgroundColor: 'rgba(78, 115, 223, 0.1)',
                    fill: true,
                    tension: 0.4
                },
                {
                    label: 'Profesores',
                    data: [5, 7, 9, 6, 8, 4, 3],
                    borderColor: '#1cc88a',
                    backgroundColor: 'rgba(28, 200, 138, 0.1)',
                    fill: true,
                    tension: 0.4
                },
                {
                    label: 'Administradores',
                    data: [2, 3, 4, 2, 1, 1, 0],
                    borderColor: '#36b9cc',
                    backgroundColor: 'rgba(54, 185, 204, 0.1)',
                    fill: true,
                    tension: 0.4
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
</script>
<script>
    const pieCtx = document.getElementById('userDistributionChart').getContext('2d');

    const userDistributionChart = new Chart(pieCtx, {
        type: 'doughnut',
        data: {
            labels: ['Estudiantes', 'Profesores', 'Directores'],
            datasets: [{
                data: [70, 20, 10],
                backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
                hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
                hoverBorderColor: 'rgba(234, 236, 244, 1)'
            }]
        },
        options: {
            maintainAspectRatio: false,
            responsive: true,
            cutout: '70%',
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    titleColor: '#6e707e',
                    titleMarginBottom: 10,
                    padding: 10
                }
            }
        }
    });
</script>
<script>
    const barCtx = document.getElementById('subjectPerformanceChart').getContext('2d');

    const subjectPerformanceChart = new Chart(barCtx, {
        type: 'bar',
        data: {
            labels: ['Matemáticas', 'Lenguaje', 'Ciencias', 'Historia'],
            datasets: [{
                label: 'Porcentaje de rendimiento',
                data: [85, 78, 90, 70],
                backgroundColor: [
                    '#4e73df', // azul
                    '#1cc88a', // verde
                    '#36b9cc', // celeste
                    '#f6c23e'  // amarillo
                ],
                borderRadius: 5,
                maxBarThickness: 50,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    max: 100,
                    ticks: {
                        callback: function(value) {
                            return value + '%';
                        }
                    },
                    title: {
                        display: true,
                        text: 'Porcentaje'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Asignatura'
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.parsed.y + '%';
                        }
                    }
                }
            }
        }
    });
</script>

