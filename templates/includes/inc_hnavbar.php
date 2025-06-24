<?php require_once INCLUDES.'inc_htopbar.php'; ?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow-sm">
    <div class="container">
        <a href="home" class="navbar-brand d-flex align-items-center">
            <img src="<?php echo FAVICON.'icono-bimp.png'; ?>" width="40" height="40" alt="Bimp Software" class="me-2 rounded-circle">
            <span class="fw-bold text-white">BIMP <span class="text-danger">SOFTWARE</span></span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#bimpsoftware">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="bimpsoftware">
            <ul class="navbar-nav align-items-center gap-2">
                <li class="nav-item">
                    <a class="nav-link position-relative px-2 <?= $slug === 'home' ? 'active text-danger fw-bold' : 'text-white-50 hover-text-white' ?>" href="home">
                        <i class="bi bi-house-door d-lg-none me-2"></i> Inicio
                        <?= $slug === 'home' ? '<span class="position-absolute bottom-0 start-0 w-100 bg-danger" style="height: 2px;"></span>' : '' ?>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link position-relative px-2 <?= $slug === 'servicios' ? 'active text-danger fw-bold' : 'text-white-50 hover-text-white' ?>" href="home/servicios">
                        <i class="bi bi-code-slash d-lg-none me-2"></i> Servicios
                        <?= $slug === 'servicios' ? '<span class="position-absolute bottom-0 start-0 w-100 bg-danger" style="height: 2px;"></span>' : '' ?>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link position-relative px-2 <?= $slug === 'webs' ? 'active text-danger fw-bold' : 'text-white-50 hover-text-white' ?>" href="home/webs">
                        <i class="bi bi-globe d-lg-none me-2"></i> Webs
                        <?= $slug === 'webs' ? '<span class="position-absolute bottom-0 start-0 w-100 bg-danger" style="height: 2px;"></span>' : '' ?>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link position-relative px-2 <?= $slug === 'cursos' ? 'active text-danger fw-bold' : 'text-white-50 hover-text-white' ?>" href="home/juega">
                        <i class="bi bi-book d-lg-none me-2"></i> Cursos
                        <?= $slug === 'cursos' ? '<span class="position-absolute bottom-0 start-0 w-100 bg-danger" style="height: 2px;"></span>' : '' ?>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link position-relative px-2 <?= $slug === 'blogs' ? 'active text-danger fw-bold' : 'text-white-50 hover-text-white' ?>" href="home/beneficios">
                        <i class="bi bi-newspaper d-lg-none me-2"></i> Blog
                        <?= $slug === 'blogs' ? '<span class="position-absolute bottom-0 start-0 w-100 bg-danger" style="height: 2px;"></span>' : '' ?>
                    </a>
                </li>
                <li class="nav-item d-none d-lg-block">
                    <a class="nav-link px-2 border border-2 rounded-pill shadow-sm" href="">
                        <i class="fa-regular fa-address-book"></i>
                        Ponte en contacto
                    </a>
                </li>
                <li class="nav-item d-lg-none">
                    <a class="nav-link px-2 border border-2 rounded-pill shadow-sm text-white bg-danger" href="login">
                        <i class="fa-solid fa-user me-1"></i>
                        Iniciar sesión
                    </a>
                </li>
            </ul>
            
        </div>
    </div>
</nav>
