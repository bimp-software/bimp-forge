<?php require_once INCLUDES.'inc_hheader.php'; ?>

<nav class="navbar navbar-expand-lg bg-dark border-bottom border-body py-3" data-bs-theme="dark">
    <div class="container">
        <a href="home" class="navbar-brand fw-semibold">
            <img src="<?= FAVICON.'icono-bimp.png'; ?>" alt="Logo" width="30" class="d-inline-block align-text-top">
            Bimp <span class="text-danger">Forge</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#forgeNav" aria-controls="forgeNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="home">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Documentación</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Crear</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container-sm py-5 px-3 border-start border-end border-2">
    <div class="row align-items-center">
        <div class="col-12 col-md-6 text-center text-md-start">
            <h1 class="fs-1 fw-bold text-dark border-start border-5 ps-3 border-danger">
                BIMP <span class="text-danger">FORGE</span>
            </h1>
            <p class="text-muted mt-3 fs-5">
                El framework PHP moderno, ligero y <strong>potente</strong> para tus proyectos profesionales.
            </p>
            <div class="mt-4 gap-3 ">
                <a href="documentacion" class="btn btn-danger m-2 px-4">
                    Ver documentación
                </a>
                <a href="#instalar" class="btn btn-outline-secondary me-2 px-4">
                    Comenzar ahora
                </a>
            </div>
            <div class="container-sm d-block py-3 p-0">
                <div class="row">
                    <div class="col">
                        <div class="figure">
                            <img src="https://placehold.co/100" alt="Bimp Forge">
                            <figcaption class="figure-caption">
                                <a href="http://localhost/bimp-forge/" target="_" class="text-muted text-decoration-none">Bimp Forge</a>
                            </figcaption>
                        </div>
                    </div>
                    <div class="col">
                        <div class="figure">
                            <img src="https://placehold.co/100" alt="Bimp Software SpA">
                            <figcaption class="figure-caption">
                                <a href="http://localhost/bimp-software/" class="text-muted text-decoration-none">Bimp Software</a>
                            </figcaption>
                        </div>
                    </div>
                    <div class="col">
                        <div class="figure">
                            <img src="https://placehold.co/100" alt="Bimp Fact">
                            <figcaption class="figure-caption">
                                <a href="" class="text-muted text-decoration-none">Bimp Fact</a>
                            </figcaption>
                        </div>
                    </div>
                    <div class="col">
                        <div class="figure">
                            <img src="https://placehold.co/100" alt="TiaJo Bank">
                            <figcaption class="figure-caption">
                                <a href="http://localhost/bimp-banco/" class="text-muted text-decoration-none">TiaJo Bank</a>
                            </figcaption>
                        </div>
                    </div>
                    <div class="col">
                        <div class="figure">
                            <img src="https://placehold.co/100" alt="EstuBien">
                            <figcaption class="figure-caption">
                                <a href="https://www.prueba.bimp-software.cl/" class="text-muted text-decoration-none">EstuBien</a>
                            </figcaption>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 mt-4 mt-md-0 d-none d-md-block">
            <img src="https://placehold.co/600x400" class="img-fluid rounded shadow" alt="Preview CLI Bimp Forge">
        </div>
    </div>
</div>

<section class="container-sm py-5 px-3 border-start border-end border-2">
    <div class="row">
        <div class="col-12 col-md-6 text-center text-md-start">
            <h6 class="fs-4 fw-bold text-dark border-start border-5 ps-3 border-danger justify-content-between">
                <span>Backend</span> <span class="fw-normal px-5 fs-5">Un codigo simple y facil de usar.</span>
            </h6>
            <p class="text-muted mt-3 fs-5">
                
            </p>
        </div>
    </div>
    <div class="d-flex align-items-start">
        <div class="col-3">
            <div class="nav flex-column nav-pills me-3" id="myTab" role="tablist" aria-orientation="vertical">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active " 
                            id="introduccion-tab" 
                            data-bs-toggle="tab" 
                            data-bs-target="#introduccion-tab-pane" 
                            type="button" 
                            role="tab" 
                            aria-controls="introduccion-tab-pane" 
                            aria-selected="true">Introducción</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" 
                            id="rutas-tab" 
                            data-bs-toggle="tab" 
                            data-bs-target="#rutas-tab-pane" 
                            type="button" 
                            role="tab" 
                            aria-controls="rutas-tab-pane" 
                            aria-selected="false">Rutas</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" 
                            id="estructura-tab" 
                            data-bs-toggle="tab" 
                            data-bs-target="#estructura-tab-pane" 
                            type="button" 
                            role="tab" 
                            aria-controls="estructura-tab-pane" 
                            aria-selected="false">Estructura</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" 
                            id="comandos-tab" 
                            data-bs-toggle="tab" 
                            data-bs-target="#comandos-tab-pane" 
                            type="button" 
                            role="tab" 
                            aria-controls="comandos-tab-pane" 
                            aria-selected="false">Comandos CLI</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" 
                            id="comandos-tab" 
                            data-bs-toggle="tab" 
                            data-bs-target="#comandos-tab-pane" 
                            type="button" 
                            role="tab" 
                            aria-controls="comandos-tab-pane" 
                            aria-selected="false">Helpers</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" 
                            id="comandos-tab" 
                            data-bs-toggle="tab" 
                            data-bs-target="#comandos-tab-pane" 
                            type="button" 
                            role="tab" 
                            aria-controls="comandos-tab-pane" 
                            aria-selected="false">Middlewares y Seguridad</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" 
                            id="comandos-tab" 
                            data-bs-toggle="tab" 
                            data-bs-target="#comandos-tab-pane" 
                            type="button" 
                            role="tab" 
                            aria-controls="basedatos-tab-pane" 
                            aria-selected="false">Base de Datos</button>
                </li>
            </div>
        </div>
        <div class="col-9 tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="introduccion-tab-pane" role="tabpanel" aria-labelledby="introduccion-tab" tabindex="0">
                <div class="container">
                    <h3 class="mt-3">¿Qué es Bimp Forge?</h3>
                    <p>
                        Es un framework creado desde cero en PHP que sigue una filosofia basada en convenciones, no configuración. 
                        Esto significa que no necesitas definir rutas ni estructuras complejas: solo crea controladores y metodos, 
                        y el framework se encargará del resto.
                    </p>
                    <h3 class="mt-3">Enrutamiento Automatico</h3>
                    <ul class="py-0 list-group">
                        <li class="list-group-item">
                            <pre>
                                <code>/home -> homeController</code> 
                            </pre>
                        </li>
                        <li class="list-group-item">
                            <pre class="py-0">
                                <code>/usuarios/perfil/5 -> usuariosController@perfil(5)</code> 
                            </pre>
                        </li>
                        <li class="list-group-item"> 
                            <pre>
                                <code>/productos/ver/1 -> productosController@ver(1)</code> 
                            </pre>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="tab-pane fade" id="rutas-tab-pane" role="tabpanel" aria-labelledby="rutas-tab" tabindex="0">
                
            </div>
            <div class="tab-pane fade" id="estructura-tab-pane" role="tabpanel" aria-labelledby="estructura-tab" tabindex="0">
                
            </div>
            <div class="tab-pane fade" id="comandos-tab-pane" role="tabpanel" aria-labelledby="comandos-tab" tabindex="0">

            </div>
        </div>
    </div>
</section>


<?php  ?>
    

<?php require_once INCLUDES.'inc_hfooter.php'; ?>