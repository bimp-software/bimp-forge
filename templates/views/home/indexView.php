<?php require_once INCLUDES.'inc_hheader.php'; ?>

    <?php require_once INCLUDES.'inc_hnavbar.php'; ?>

    <!-- Hero -->
    <section class="container-fluid position-relative overflow-hidden d-flex align-items-center" style="background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.5)), url(<?= IMG.'img.svg'; ?>); background-size: cover; background-position: center; height: 90vh;">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-lg-8 col-md-10" data-aos="fade-up">
                    <h1 class="text-white fw-bold display-3 mb-4">
                        Soluciones Informáticas <span class="d-block">que <span class="text-danger">Transforman</span> tu Negocio</span>
                    </h1>
                    <p class="text-white mb-4 lead fs-4" style="text-shadow: 0 2px 4px rgba(0,0,0,0.5);">
                        Desde desarrollo web hasta sistemas empresariales, creamos soluciones innovadoras a medida.
                    </p>
                    <div class="d-flex flex-wrap gap-3 mt-4">
                        <a href="#proyectos" class="btn btn-danger btn-lg px-4 py-3 fw-bold me-2 shadow hover-scale">
                            <i class="fas fa-cubes me-2"></i> Ver Proyectos
                        </a>
                        <a href="#contacto" class="btn btn-outline-light btn-lg px-4 py-3 fw-bold shadow hover-scale">
                            <i class="fas fa-phone-alt me-2"></i> Contactar Ahora
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sobre Bimp -->
    <section class="container-fluid py-5 bg-dark text-white">
        <div class="container p-2">
            <div class="row align-items-center gy-5 gx-4">
                <!-- Columna de imágenes -->
                <div class="col-lg-5 d-none d-lg-block"> <!-- Añadí d-none d-lg-block -->
                    <div class="founders-container">
                        <img data-aos="zoom-out-up" src="<?= IMG.'mi foto.jpg'; ?>" alt="Benjamin Eáseres" class="founder-img founder-1">
                        <img data-aos="zoom-out-down" src="<?= IMG.'maykol.jpg'; ?>" alt="Isabel Salazar" class="founder-img founder-2">
                    </div>
                </div>
                
                <!-- Columna de texto -->
                <div class="col-12 col-lg-7" data-aos="fade-left">
                    <h1 class="mb-4 title-with-circle fw-semibold"><span class="corner-circle"></span>Sobre <span class="text-danger">Bimp Software</span></h1>
                    <p>Benjamín Cáceres comenzó desarrollando soluciones informáticas por su cuenta hasta que Isabel Salazar se unió a la iniciativa, dando origen a <strong class="text-warning">Ibinformatica</strong>.</p>
                    <p>Durante años, la empresa se especializó en software de escritorio, pero tras enfrentar un problema, decidieron mantenerse en segundo plano por un tiempo.</p>
                    <p>
                        De esta reinverción nació <strong class="text-warning">Bimp Software</strong>, con un enfoque renovado en el desarrollo 
                        web y soluciones a medida. Hoy, la empresa ofrece herramientas innovadoras, 
                        permitiendo a los clientes seguir en tiempo real el progreso de sus proyectos y garantizando transparencia y eficiencia en 
                        cada desarrollo.
                    </p>
                    <a data-aos="fade-left" href="" class="btn btn-danger rounded-0 border border-0 px-5 py-3 fw-bold fs-5 mb-5"> <!-- Añadí mb-5 -->
                        Sobre Nosotros
                    </a>
                </div>
            </div>
        </div>
        <div class="container-fluid mt-md-n3 mt-lg-0 px-0 d-none d-md-block">
            <div class="d-flex pb-4 overflow-auto">
                <div class="d-flex flex-nowrap gap-2 gap-md-3 mx-auto px-3 align-items-center">
                    <!-- Logos de clientes  -->
                    <div class="client-logo" data-aos="flip-left">
                        <img src="<?= IMG.'bimp-software.jpg'; ?>" alt="Cliente 1" class="img-fluid">
                    </div>
                    <div class="client-logo" data-aos="flip-left">
                        <img src="<?= IMG.'bimp-software.jpg'; ?>" alt="Cliente 2" class="img-fluid">
                    </div>
                    <div class="client-logo" data-aos="flip-left">
                        <img src="<?= IMG.'bimp-software.jpg'; ?>" alt="Cliente 3" class="img-fluid">
                    </div>
                    <div class="client-logo" data-aos="flip-left">
                        <img src="<?= IMG.'bimp-software.jpg'; ?>" alt="Cliente 4" class="img-fluid">
                    </div>
                    <div class="client-logo" data-aos="flip-left">
                        <img src="<?= IMG.'bimp-software.jpg'; ?>" alt="Cliente 5" class="img-fluid">
                    </div>
                    <div class="client-logo" data-aos="flip-left">
                        <img src="<?= IMG.'bimp-software.jpg'; ?>" alt="Cliente 6" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Nuestro Servicio -->
    <section class="container-fluid bg-white p-3 p-md-5">
        <div class="container py-3">
            <div class="row g-4 g-md-5 align-items-start">
                <div class="col-12 col-lg-6">
                    <h4 class="mb-3 title-with-circle fw-semibold" data-aos="fade-up-right">
                        <span class="corner-circle"></span>Nuestros <span class="text-danger">Servicios</span>
                    </h4>
                    <h2 class="mb-3 fs-1 fs-md-2 fw-bold" data-aos="fade-up-right"> <!-- Tamaño responsive -->
                        Soluciones <span class="text-danger">Tecnológicas</span> a tu medida...
                    </h2>
                    <div class="d-flex aling-items-center gap-2" data-aos="fade-down-right">
                        <div class="w-25 bg-danger rounded-pill barra"></div>
                        <div class="bg-danger rounded-pill circulo"></div>
                        <div class="bg-danger rounded-pill circulo"></div>
                    </div>
                    <p class="text-muted py-2" data-aos="fade-down">
                        En Bimp Software, ofrecemos una amplia gama de servicios diseñados para optimizar y potenciar tu negocio a travéz
                        de la tecnología. Desde el desarrollo de software hasta consultoría especializada, brindamos soluciones innovadoras 
                        y adaptadas a tus necesidades.
                    </p>
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <ul class="list-bimp fw-bold" data-aos="fade-down">
                                    <li>Desarrollo de Software a Medida.</li>
                                    <li>Consultoriá Tecnológica.</li>
                                    <li>Infraestructura y Soporte Técnico.</li>
                                </ul>
                            </div>
                            <div class="col-12 col-md-6">
                                <ul class="list-bimp fw-bold" data-aos="fade-down">
                                    <li>Automatización y Optimización de Procesos.</li>
                                    <li>Sistemas Empresariales.</li>
                                </ul>
                            </div>
                        </div>
                        <a data-aos="fade-down" href="" class="btn btn-danger rounded-4 w-100 w-md-auto px-4 py-3 fw-bold">
                            Póngase en contacto
                        </a>                    
                    </div>
                </div>

                <div class="col-12 col-lg-6 mb-4 mb-lg-0">
                    <div class="row g-3">

                        <div class="col-12 col-md-6" data-aos="fade-right">
                            <div class="card p-3 h-100">
                                <div class="d-flex flex-column flex-md-row align-items-start gap-3">
                                    <div class="icon-box">
                                        <i class="fas fa-mobile-alt fa-2x"></i>
                                    </div>
                                    <div class="text-content">
                                        <h6 class="fs-5 fw-bold">Desarrollo de App</h6>
                                        <p>Creamos app moviles y de escritorio a medida optimizadas para rendimiento, seguridad y escalabilidad.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-6" data-aos="fade-right">
                            <div class="card p-3 h-100">
                                <div class="d-flex flex-column flex-md-row align-items-start gap-3">
                                    <div class="icon-box">
                                        <i class="fas fa-globe fa-2x"></i>
                                    </div>
                                    <div class="text-content">
                                        <h6 class="fs-5 fw-bold">Desarrollo Web</h6>
                                        <p>Construimos sitios y sistemas con Bimp-Forge, nuestro propio entorno optimizado para crear soluciones rápidas, seguras y escalable.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-6" data-aos="fade-right">
                            <div class="card p-3 h-100">
                                <div class="d-flex flex-column flex-md-row align-items-start gap-3">
                                    <div class="icon-box">
                                        <i class="fas fa-search fa-2x"></i>
                                    </div>
                                    <div class="text-content">
                                        <h6 class="fs-5 fw-bold">Especialista en SEO</h6>
                                        <p>Optimizamos tu sitio para aumentar su visibilidad y atraer más tráfico en los motores de búsqueda.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Equipo -->
    <section class="container-fluid bg-white p-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="text-center text-dark fw-bold mb-4">Conoce al equipo detrás de <strong class="text-danger">Bimp Software</strong></h4>
                </div>
                <div class="container">
                    <div id="equipo" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">

                            <div class="carousel-item active">
                                <div class="row justify-content-center">

                                    <div class="col-md-3 p-2">
                                        <div class="card">
                                            <img class="img-fluid rounded mb-2" src="<?= IMG.'mi foto.jpg'; ?>" alt="Benjamin Patricio R." style="height: 250px; object-fit: cover;">
                                            <div class="d-flex justify-content-center gap-3 py-1">
                                                <a href="https://www.instagram.com/_b3nj4min.23_/" class="icon-circle"><i class="fab fa-instagram"></i></a>
                                                <a href="" class="icon-circle"><i class="fab fa-facebook-f"></i></a>
                                                <a href="" class="icon-circle"><i class="fab fa-linkedin-in"></i></a>
                                                <a href="" class="icon-circle"><i class="fab fa-github"></i></a>
                                                <a href="ruta/al/cv/benjamin_cv.pdf" 
                                                    class="icon-circle bg-danger text-white" 
                                                    data-bs-toggle="tooltip" 
                                                    title="Descargar CV"
                                                    download>
                                                    <i class="fas fa-file-pdf"></i>
                                                </a>
                                            </div>
                                            <h5 class="fw-bold mb-1">Benjamín Patricio R.</h5>
                                            <p class="text-danger small mb-3">CEO y Fundador</p>
                                            
                                        </div>
                                    </div>

                                    <div class="col-md-3 p-2">
                                        <div class="card">
                                            <img class="img-fluid rounded mb-2" src="<?= IMG.'mi foto.jpg'; ?>" alt="Isabel Salazar" style="height: 250px; object-fit: cover;">
                                            <div class="d-flex justify-content-center gap-3 py-1">
                                                <a href="" class="icon-circle"><i class="fab fa-instagram"></i></a>
                                                <a href="" class="icon-circle"><i class="fab fa-linkedin-in"></i></a>
                                            </div>
                                            <h5 class="fw-bold mb-1">Isabel Salazar </h5>
                                            <p class="text-danger small mb-3">Cofundadora</p>
                                        </div>
                                    </div>

                                    <div class="col-md-3 p-2">
                                        <div class="card">
                                            <img class="img-fluid rounded mb-2" src="<?= IMG.'maykol.jpg'; ?>" alt="Maykol Ariel Aedo" style="height: 250px; object-fit: cover;">
                                            <div class="d-flex justify-content-center gap-3 py-1">
                                                <a href="" class="icon-circle"><i class="fab fa-instagram"></i></a>
                                                <a href="" class="icon-circle"><i class="fab fa-facebook-f"></i></a>
                                                <a href="" class="icon-circle"><i class="fab fa-linkedin-in"></i></a>
                                            </div>
                                            <h5 class="fw-bold mb-1">Maykol Ariel Aedo Díaz</h5>
                                            <p class="text-danger small mb-3">Programador .NET</p>
                                        </div>
                                    </div>

                                    
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Plan -->
    <section class="container-fluid bg-dark text-white">
        <div class="container p-3 p-md-5">
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="text-center fs-2 text-white fw-bold mb-4 mb-md-5">Nuestros Planes</h4>
                </div>

                <div class="container py-2 py-md-3">
                    <div class="row justify-content-center g-3 g-md-4">

                        <div class="col-12 col-sm-10 col-md-6 col-lg-4" data-aos="zoom-in">
                            <div class="card plan-card bg-black rounded-5 h-100 plan-base">
                                <div class="card-body p-3 p-md-4">
                                    <h5 class="card-title text-white fw-bold fs-4 fs-md-3 text-start">BASE</h5>
                                    <div class="card-subtitle mb-2 my-3 my-md-4 fs-4 text-start">
                                        <span class="display-5 display-md-4 fw-bold text-danger">$15</span>
                                        <span class="fs-6 fs-md-5 text-white">.000/mes</span>
                                    </div>
                                    <ul class="plan-features list-unstyled px-2 px-md-3">
                                        <li class="mb-2 mb-md-3 d-flex align-items-start">
                                            <i class="fas fa-check text-success mt-1 me-2"></i>
                                            1000 MB de espacio
                                        </li>
                                        <li class="mb-2 mb-md-3 d-flex align-items-start">
                                            <i class="fas fa-check text-success mt-1 me-2"></i>
                                            1000 MB de espacio
                                        </li>
                                        <li class="mb-2 mb-md-3 d-flex align-items-start">
                                            <i class="fas fa-check text-success mt-1 me-2"></i>
                                            1000 MB de espacio
                                        </li>
                                    </ul>
                                    <button class="btn btn-light border-0 fw-bold fs-5 fs-md-4 rounded-pill w-100 mt-3 mt-md-4 py-2 btn-plan">
                                        Elegir Plan
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-sm-10 col-md-6 col-lg-4" data-aos="zoom-in">
                            <div class="card plan-card bg-black rounded-5 h-100 plan-estandar">
                                <div class="ribbon">Más Popular</div>
                                <div class="card-body p-3 p-md-4">
                                    <h5 class="card-title text-white fw-bold fs-4 fs-md-3 text-start">ESTANDAR</h5>
                                    <div class="card-subtitle mb-2 my-3 my-md-4 fs-4 text-start">
                                        <span class="display-5 display-md-4 fw-bold text-danger">$45</span>
                                        <span class="fs-6 fs-md-5 text-white">.000/mes</span>
                                    </div>
                                    <ul class="plan-features list-unstyled px-2 px-md-3">
                                        <li class="mb-2 mb-md-3 d-flex align-items-start">
                                            <i class="fas fa-check text-success mt-1 me-2"></i>
                                            1000 MB de espacio
                                        </li>
                                        <li class="mb-2 mb-md-3 d-flex align-items-start">
                                            <i class="fas fa-check text-success mt-1 me-2"></i>
                                            1000 MB de espacio
                                        </li>
                                        <li class="mb-2 mb-md-3 d-flex align-items-start">
                                            <i class="fas fa-check text-success mt-1 me-2"></i>
                                            1000 MB de espacio
                                        </li>
                                    </ul>
                                    <button class="btn btn-light border-0 fw-bold fs-5 fs-md-4 rounded-pill w-100 mt-3 mt-md-4 py-2 btn-plan">
                                        Elegir Plan
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-sm-10 col-md-6 col-lg-4" data-aos="zoom-in">
                            <div class="card plan-card bg-black rounded-5 h-100 plan-experto">
                                <div class="card-body p-3 p-md-4">
                                    <h5 class="card-title text-white fw-bold fs-4 fs-md-3 text-start">EXPERTO</h5>
                                    <div class="card-subtitle mb-2 my-3 my-md-4 fs-4 text-start">
                                        <span class="display-5 display-md-4 fw-bold text-danger">$65</span>
                                        <span class="fs-6 fs-md-5 text-white">.000/mes</span>
                                    </div>
                                    <ul class="plan-features list-unstyled px-2 px-md-3">
                                        <li class="mb-2 mb-md-3 d-flex align-items-start">
                                            <i class="fas fa-check text-success mt-1 me-2"></i>
                                            1000 MB de espacio
                                        </li>
                                        <li class="mb-2 mb-md-3 d-flex align-items-start">
                                            <i class="fas fa-check text-success mt-1 me-2"></i>
                                            1000 MB de espacio
                                        </li>
                                        <li class="mb-2 mb-md-3 d-flex align-items-start">
                                            <i class="fas fa-check text-success mt-1 me-2"></i>
                                            1000 MB de espacio
                                        </li>
                                    </ul>
                                    <button class="btn btn-light border-0 fw-bold fs-5 fs-md-4 rounded-pill w-100 mt-3 mt-md-4 py-2 btn-plan">
                                        Elegir Plan
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row py-5 justify-content-center">
                        <a href="#" class="text-dark fw-semibold p-3 rounded-pill btn btn-danger w-75 w-md-25 btn-fixed-mobile text-center">MOSTRAR PRODUCTOS</a>
                    </div>
                </div>
                
            </div>
        </div>
    </section>

    <!-- Portafolio -->
    <section class="container-fluid bg-dark text-white py-5">
        <div class="container">
            <div class="row">
                <!-- Lado Izquierdo  -->
                <div class="col-md-4 mb-4 mb-md-0">
                    <h3 class="mb-4 title-with-circle fw-semibold"><span class="corner-circle"></span>Nuestro Portafolio</h3>
                    <p class="small">Explora los diferentes ipos de software que desarrollamos:</p>
                    <div class="nav flex-column nav-pills me-5" id="portafolio-tab" role="tablist" aria-orientation="vertical">
                        <button class="nav-link mb-1 active" 
                                id="web-tab" 
                                data-bs-toggle="pill" 
                                data-bs-target="#web"
                                type="button"
                                role="tab"
                                aria-controls="web"
                                aria-selected="true">Webs</button>
                        <button class="nav-link mb-1" 
                                id="app-tab" 
                                data-bs-toggle="pill" 
                                data-bs-target="#app"
                                type="button"
                                role="tab"
                                aria-controls="app"
                                aria-selected="true">Aplicaciones Escritorios</button>
                        <button class="nav-link mb-1" 
                                id="otros-tab" 
                                data-bs-toggle="pill" 
                                data-bs-target="#otros"
                                type="button"
                                role="tab"
                                aria-controls="otros"
                                aria-selected="true">Otros</button>
                        
                    </div>
                </div>

                <!-- Lado Derecho -->
                <div class="col-md-8">
                    <div class="tab-content" id="portafolio-tabContent">

                        <div class="tab-pane fade show active" id="web" role="tabpanel" aria-labelledby="web-tab">
                            <div class="row g-2">
                                <div class="col-6 col-md-4">
                                    <img src="https://placehold.co/600x400" class="img-fluid rounded grid-img" alt="">                                
                                </div>
                                <div class="col-6 col-md-4">
                                    <img src="https://placehold.co/600x400" class="img-fluid rounded grid-img" alt="">                                
                                </div>
                                <div class="col-6 col-md-4">
                                    <img src="https://placehold.co/600x400" class="img-fluid rounded grid-img" alt="">                                
                                </div>
                                <div class="col-6 col-md-4">
                                    <img src="https://placehold.co/600x400" class="img-fluid rounded grid-img" alt="">                                
                                </div>
                                <div class="col-6 col-md-4">
                                    <img src="https://placehold.co/600x400" class="img-fluid rounded grid-img" alt="">                                
                                </div>
                                <div class="col-6 col-md-4">
                                    <img src="https://placehold.co/600x400" class="img-fluid rounded grid-img" alt="">                                
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Proceso de trabajo -->
    <section class="container-fluid bg-light text-dark">
        <div class="container p-5">
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="text-center fs-2 text-dark fw-bold mb-4">Nuestros Proceso de trabajo</h4>
                    <h6 class="small fs-3 text-center">Estrategias efectivas para hacer crecer tu negocio.</h6>
                </div>

                <div class="row row-cols-1 row-cols-lg-5 g-2 g-lg-3 justify-content-center py-3">

                    <!-- Paso 1 -->
                    <div class="col-md-3 mb-4" data-aos="fade-up">
                        <div class="card border-0 bg-white shadow-sm h-100">
                            <div class="card-body text-center p-4">
                                <div class="bg-danger text-white px-3 py-2 rounded-circle d-inline-flex align-items-center justify-content-center mb-2">
                                    1
                                </div>
                                <h5 class="fw-bold">Análisis y Planificación</h5>
                                <p class="text-muted">
                                    Definimos los objetivos y la estrategia para un desarrollo exitoso.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 mb-4" data-aos="fade-up">
                        <div class="card border-0 bg-white shadow-sm h-100">
                            <div class="card-body text-center p-4">
                                <div class="bg-danger text-white px-3 py-2 rounded-circle d-inline-flex align-items-center justify-content-center mb-2">
                                    2
                                </div>
                                <h5 class="fw-bold">Diseño y Prototipado</h5>
                                <p class="text-muted">
                                    Creamos la estructura visual y funcional antes del desarrollo.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 mb-4" data-aos="fade-up">
                        <div class="card border-0 bg-white shadow-sm h-100">
                            <div class="card-body text-center p-4">
                                <div class="bg-danger text-white px-3 py-2 rounded-circle d-inline-flex align-items-center justify-content-center mb-2">
                                    3
                                </div>
                                <h5 class="fw-bold">Desarrollo</h5>
                                <p class="text-muted">
                                    Construimos la solución con código optimizado y escalable.    
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 mb-4" data-aos="fade-up">
                        <div class="card border-0 bg-white shadow-sm h-100">
                            <div class="card-body text-center p-4">
                                <div class="bg-danger text-white px-3 py-2 rounded-circle d-inline-flex align-items-center justify-content-center mb-2">
                                    4
                                </div>
                                <h5 class="fw-bold">Pruebas y Ajustes</h5>
                                <p class="text-muted">
                                    Evaluamos, corregimos errores y optimizamos el rendimiento.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 mb-4" data-aos="fade-up">
                        <div class="card border-0 bg-white shadow-sm h-100">
                            <div class="card-body text-center p-4">
                                <div class="bg-danger text-white px-3 py-2 rounded-circle d-inline-flex align-items-center justify-content-center mb-2">
                                    5
                                </div>
                                <h5 class="fw-bold">Lanzamiento</h5>
                                <p class="text-muted">
                                    Desplegamos el proyecto y aseguramos su mantenimiento continuo.
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- Tecnologia -->
    <section class="container-fluid bg-white py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center mb-5">
                    <h2 class="fw-bold title-with-circle"><span class="corner-circle"></span>Tecnologías que <span class="text-danger">Dominamos</span></h2>
                    <p class="text-white">Utilizamos lo último en herramientas para garantizar calidad y rendimiento.</p>
                </div>
            </div>
            <div class="row justify-content-center g-4">
                <!-- Tecnología 1 -->
                <div class="col-4 col-md-2 text-center">
                    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/html5/html5-original.svg" width="60" alt="HTML5" class="img-fluid mb-2">
                    <p class="fw-bold small">HTML5</p>
                </div>
                <!-- Tecnología 2 -->
                <div class="col-4 col-md-2 text-center">
                    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/javascript/javascript-original.svg" width="60" alt="JavaScript" class="img-fluid mb-2">
                    <p class="fw-bold small">JavaScript</p>
                </div>
                <!-- Tecnología 3 -->
                <div class="col-4 col-md-2 text-center">
                    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/php/php-original.svg" width="60" alt="PHP" class="img-fluid mb-2">
                    <p class="fw-bold small">PHP</p>
                </div>
                <div class="col-4 col-md-2 text-center">
                    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/csharp/csharp-original.svg" width="60" alt="CSharp" class="img-fluid mb-2">
                    <p class="fw-bold small">C#</p>
                </div>
                <div class="col-4 col-md-2 text-center">
                    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/laravel/laravel-original.svg" width="60" alt="Laravel" class="img-fluid mb-2">
                    <p class="fw-bold small">Laravel</p>
                </div>
                <div class="col-4 col-md-2 text-center">
                    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/opengl/opengl-original.svg" width="60" alt="OpenGL" class="img-fluid mb-2">
                    <p class="fw-bold small">OpenGL</p>
                </div>
                <div class="col-4 col-md-2 text-center">
                    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/python/python-original.svg" width="60" alt="Python" class="img-fluid mb-2">
                    <p class="fw-bold small">Python</p>
                </div>
                <div class="col-4 col-md-2 text-center">
                    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/sqldeveloper/sqldeveloper-original.svg" width="60" alt="Sql" class="img-fluid mb-2">
                    <p class="fw-bold small">Sql Developer</p>
                </div>
                <div class="col-4 col-md-2 text-center">
                    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/unity/unity-original.svg" width="60" alt="Unity" class="img-fluid mb-2">
                    <p class="fw-bold small">Unity</p>
                </div>
                <div class="col-4 col-md-2 text-center">
                    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/unrealengine/unrealengine-original.svg" width="60" alt="Unreal" class="img-fluid mb-2">
                    <p class="fw-bold small">Unreal Engine</p>
                </div>
                <div class="col-4 col-md-2 text-center">
                    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/xamarin/xamarin-original.svg" width="60" alt="Xamarin" class="img-fluid mb-2">
                    <p class="fw-bold small">Xamarin</p>
                </div>
                <div class="col-4 col-md-2 text-center">
                    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/angular/angular-original.svg" width="60" alt="Angular" class="img-fluid mb-2">
                    <p class="fw-bold small">Angular</p>
                </div>
                <div class="col-4 col-md-2 text-center">
                    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/bootstrap/bootstrap-original.svg" width="60" alt="Bootstrap" class="img-fluid mb-2">
                    <p class="fw-bold small">Bootstrap</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Nuestros Clientes -->
    <section class="container-fluid bg-dark text-white py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center mb-5">
                    <h2 class="fw-bold title-with-circle"><span class="corner-circle"></span>Lo que dicen <span class="text-danger">nuestros clientes</span></h2>
                </div>
            </div>
            <div class="row">
                <!-- Testimonio 1 -->
                <div class="col-md-4 mb-4" data-aos="zoom-in">
                    <div class="card bg-black border-0 h-100">
                        <div class="card-body p-4 text-white">
                            <div class="d-flex align-items-center mb-3">
                                <img src="https://randomuser.me/api/portraits/women/43.jpg" alt="Cliente" class="rounded-circle me-3" width="60">
                                <div>
                                    <h5 class="fw-bold mb-0">Ana Torres</h5>
                                    <p class="text-warning small mb-0 ">CEO de Empresa X</p>
                                </div>
                            </div>
                            <p class="mb-0">"Bimp Software transformó nuestro sistema de inventario con una solución personalizada. ¡Excelente servicio!"</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4" data-aos="zoom-in">
                    <div class="card bg-black border-0 h-100">
                        <div class="card-body p-4 text-white">
                            <div class="d-flex align-items-center mb-3">
                                <img src="https://randomuser.me/api/portraits/women/43.jpg" alt="Cliente" class="rounded-circle me-3" width="60">
                                <div>
                                    <h5 class="fw-bold mb-0">Maria Ramirez Diaz</h5>
                                    <p class="text-warning small mb-0 ">Independiente</p>
                                </div>
                            </div>
                            <p class="mb-0">"Bimp Software transformó nuestro sistema de inventario con una solución personalizada. ¡Excelente servicio!"</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4" data-aos="zoom-in">
                    <div class="card bg-black border-0 h-100">
                        <div class="card-body p-4 text-white">
                            <div class="d-flex align-items-center mb-3">
                                <img src="https://randomuser.me/api/portraits/women/43.jpg" alt="Cliente" class="rounded-circle me-3" width="60">
                                <div>
                                    <h5 class="fw-bold mb-0">Joselyn Tamara Caceres</h5>
                                    <p class="text-warning small mb-0 ">Independiente</p>
                                </div>
                            </div>
                            <p class="mb-0">"Bimp Software transformó nuestro sistema de inventario con una solución personalizada. ¡Excelente servicio!"</p>
                        </div>
                    </div>
                </div>
                <!-- Más testimonios... -->
            </div>
        </div>
    </section>

    <!-- Preguntas Frecuentes -->
    <section class="container-fluid bg-white py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center mb-5">
                    <h2 class="fw-bold">Preguntas <span class="text-danger">Frecuentes</span></h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="accordion" id="faqAccordion">
                        <!-- Pregunta 1 -->
                        <div class="accordion-item border-0 mb-3 shadow-sm">
                            <h3 class="accordion-header" id="headingOne">
                                <button class="accordion-button bg-white text-dark fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                                    ¿Cuánto tiempo toma desarrollar un software a medida?
                                </button>
                            </h3>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne">
                                <div class="accordion-body text-muted">
                                    El tiempo varía según la complejidad del proyecto, pero trabajamos con sprints de 2 semanas para entregar avances incrementales.
                                </div>
                            </div>
                        </div>
                        <!-- Más preguntas... -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="container-fluid bg-danger text-white py-5">
        <div class="container text-center py-4">
            <h2 class="fw-bold display-5 mb-4">¿Listo para transformar tu negocio?</h2>
            <p class="fs-5 mb-4">Contáctanos hoy mismo para una consulta gratuita.</p>
            <a href="home/contacto" class="btn btn-light btn-lg px-5 fw-bold">Hablar con un experto</a>
        </div>
    </section>

    <?php require_once INCLUDES.'inc_hfooter_home.php'; ?>


<?php require_once INCLUDES.'inc_hfooter.php'; ?>

