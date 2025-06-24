<!-- Nav Item - Dashboard -->
<li class="nav-item <?php echo $slug == 'dashboard' ? 'active' : ''; ?>">
    <a class="nav-link" href="admin">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span>
    </a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading - Gestión -->
<div class="sidebar-heading">
    Gestión Principal
</div>

<!-- Usuarios -->
<li class="nav-item <?php echo ($slug === 'usuarios' || $slug === 'roles' || $slug === 'clientes') ? 'active' : ''; ?>">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUsuarios"
        aria-expanded="true" aria-controls="collapseUsuarios">
        <i class="fas fa-fw fa-users"></i>
        <span>Usuarios</span>
    </a>
    <div id="collapseUsuarios" class="collapse" aria-labelledby="headingUsuarios" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Gestión de Usuarios:</h6>
            <a class="collapse-item <?php echo $slug === 'usuarios' ? 'active' : ''; ?>" href="usuarios">Todos los Usuarios</a>
            <a class="collapse-item <?php echo $slug === 'clientes' ? 'active' : ''; ?>" href="clientes">Clientes</a>
            <a class="collapse-item <?php echo $slug === 'roles' ? 'active' : ''; ?>" href="roles">Roles</a>
        </div>
    </div>
</li>

<!-- Escuelas -->
<li class="nav-item <?php echo ($slug === 'escuelas' || $slug === 'cursos' || $slug === 'asignatura') ? 'active' : ''; ?>">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEscuelas"
        aria-expanded="true" aria-controls="collapseEscuelas">
        <i class="fas fa-fw fa-school"></i>
        <span>Escuelas</span>
    </a>
    <div id="collapseEscuelas" class="collapse" aria-labelledby="headingEscuelas" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Gestión Escolar:</h6>
            <a class="collapse-item <?php echo $slug === 'escuelas' ? 'active' : '';?>" href="escuelas">Escuelas</a>
            <a class="collapse-item <?php echo $slug === 'cursos' ? 'active' : '';?>" href="cursos">Cursos</a>
            <a class="collapse-item <?php echo $slug === 'asignatura' ? 'active' : '' ?>" href="asignatura">Asignaturas</a>
            <a class="collapse-item" href="profesores">Profesores</a>
            <a class="collapse-item" href="estudiantes">Estudiantes</a>
        </div>
    </div>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading - Reportes -->
<div class="sidebar-heading">
    Reportes y Análisis
</div>

<!-- Reportes -->
<li class="nav-item <?php echo $slug === 'reportes' ? 'active' : ''; ?>">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseReportes"
        aria-expanded="true" aria-controls="collapseReportes">
        <i class="fas fa-fw fa-chart-bar"></i>
        <span>Reportes</span>
    </a>
    <div id="collapseReportes" class="collapse" aria-labelledby="headingReportes" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Análisis de Datos:</h6>
            <a class="collapse-item" href="reportes/escuelas">Estadísticas Escolares</a>
            <a class="collapse-item" href="reportes/region">Datos por Región</a>
        </div>
    </div>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading - Configuración -->
<div class="sidebar-heading">
    Configuración
</div>

<!-- Configuración -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseConfig"
        aria-expanded="true" aria-controls="collapseConfig">
        <i class="fas fa-fw fa-cogs"></i>
        <span>Configuración</span>
    </a>
    <div id="collapseConfig" class="collapse" aria-labelledby="headingConfig" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Ajustes del Sistema:</h6>
            <a class="collapse-item" href="configuracion/general">General</a>
            <a class="collapse-item" href="configuracion/regiones">Regiones</a>
            <a class="collapse-item" href="configuracion/comunas">Comunas</a>
            <a class="collapse-item" href="configuracion/estados">Estados</a>
        </div>
    </div>
</li>