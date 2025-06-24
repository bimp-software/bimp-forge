<nav class="navbar navbar-expand navbar-light bg-white topbar shadow mb-4 static-top">

    <!-- Botón para abrir el sidebar -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3" aria-label="Menú lateral">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Búsqueda -->
    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
        <div class="input-group">
            <input type="text" class="form-control bg-light border-0 small" placeholder="Buscar..." aria-label="Buscar">
            <div class="input-group-append">
                <button class="btn btn-primary" type="button" title="Buscar">
                    <i class="fas fa-search fa-sm"></i>
                </button>
            </div>
        </div>
    </form>

    <!-- Íconos -->
    <ul class="navbar-nav ml-auto align-items-center">

        <!-- Accesos rápidos -->
        <li class="nav-item mx-1">
            <a class="nav-link active" href="dashboard" title="Panel principal">
                <i class="fas fa-tachometer-alt"></i>
            </a>
        </li>
        <li class="nav-item mx-1">
            <a class="nav-link" href="calendar.php" title="Calendario">
                <i class="fas fa-calendar-alt"></i>
            </a>
        </li>
        <li class="nav-item mx-1">
            <a class="nav-link" href="tasks.php" title="Tareas asignadas">
                <i class="fas fa-tasks"></i>
            </a>
        </li>
        <li class="nav-item mx-1">
            <a class="nav-link" href="reports.php" title="Reportes">
                <i class="fas fa-chart-line"></i>
            </a>
        </li>

        <!-- Selector de idioma -->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="langDropdown" role="button" data-toggle="dropdown" title="Idioma">
                <i class="fas fa-globe"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="langDropdown">
                <a class="dropdown-item" href="#">Español</a>
                <a class="dropdown-item" href="#">English</a>
                <a class="dropdown-item" href="#">Creol Haitiano</a>
            </div>
        </li>

        <!-- Alertas -->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" title="Alertas">
                <i class="fas fa-bell fa-fw"></i>
                <span class="badge badge-danger badge-counter" id="alertCounter">3</span>
            </a>
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">Alertas recientes</h6>
                <div id="alertsContainer"></div>
                <a class="dropdown-item text-center small text-primary">Ver todas</a>
            </div>
        </li>

        <!-- Mensajes -->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" title="Mensajes">
                <i class="fas fa-envelope fa-fw"></i>
                <span class="badge badge-danger badge-counter" id="messageCounter">7</span>
            </a>
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                <h6 class="dropdown-header">Mensajes</h6>
                <div id="messagesContainer"></div>
                <a class="dropdown-item text-center small text-primary" href="#">Ver todos</a>
            </div>
        </li>

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Usuario -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" title="Mi cuenta">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small font-weight-bold">
                    <?php echo get_user('nom_cliente'); ?>
                </span>
                <img class="img-profile rounded-circle" src="<?php echo !empty(get_user('avatar_usuario')) ? get_user('avatar_usuario') : FAVICON . 'avatars/' . get_user('rol') . '.jpeg'; ?>" alt="Avatar">
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <div class="dropdown-header text-center">
                    <img class="rounded-circle mb-2" src="<?php echo !empty(get_user('avatar_usuario')) ? get_user('avatar_usuario') : FAVICON . 'avatars/' . get_user('rol') . '.jpeg'; ?>" width="50">
                    <div class="font-weight-bold"><?php echo get_user('nom_cliente'); ?></div>
                    <div class="small text-gray-500"><?php echo ucfirst(get_user('rol')); ?></div>
                </div>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i> Perfil
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i> Configuración
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i> Actividad
                </a>

                <div class="dropdown-divider"></div>

                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> 
                    Cerrar sesión
                </a>
            </div>
        </li>
    </ul>
</nav>
