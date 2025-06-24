<?php require_once INCLUDES . 'inc_hheader.php'; ?>

<section class="min-vh-100 d-flex">
    <!-- Columna izquierda - Imagen y contenido -->
    <div class="col-lg-8 d-none d-lg-flex position-relative overflow-hidden">
        <div class="w-100 position-relative">
            <!-- Imagen de fondo -->
            <img src="https://i.ibb.co/Y7kngmXs/backgraund-login.png" 
                 alt="Equipo de bimp software" 
                 class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover">
            
            <!-- Overlay gradient -->
            <div class="position-absolute top-0 start-0 w-100 h-100 bg-gradiente bg-dark opacity-75"></div>
            
            <!-- Contenido -->
            <div class="position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-center p-5">
                <div class="text-white">
                    <div class="mb-5">
                        <h1 class="display-4 fw-bold mb-4" style="text-shadow: 2px 2px 8px rgba(0,0,0,0.7);">
                            Bienvenido a<br>
                            <span class="text-white">Bimp <span class="text-danger">Software</span></span>
                        </h1>
                        <p class="fs-5 mb-5 opacity-90">
                            Soluciones informáticas a medida para potenciar tu negocio
                        </p>
                    </div>
                    
                    <!-- Features -->
                    <div class="row g-4">
                        <div class="col-12">
                            <div class="d-flex align-items-center p-3 rounded-2" 
                                 style="background: rgba(255,255,255,0.1); backdrop-filter: blur(10px);">
                                <div class="bg-primary rounded-circle py-2 px-3 me-3">
                                    <i class="bi bi-code-slash text-white fs-5"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1 fw-semibold">Desarrollo Web Profesional</h6>
                                    <small class="opacity-75">Páginas web modernas y responsivas</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex align-items-center p-3 rounded-2" 
                                 style="background: rgba(255,255,255,0.1); backdrop-filter: blur(10px);">
                                <div class="bg-primary rounded-circle py-2 px-3 me-3">
                                    <i class="bi bi-gear-fill text-white fs-5"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1 fw-semibold">Sistemas CMS Personalizados</h6>
                                    <small class="opacity-75">Gestión de contenido a medida</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex align-items-center p-3 rounded-2" 
                                 style="background: rgba(255,255,255,0.1); backdrop-filter: blur(10px);">
                                <div class="bg-primary rounded-circle py-2 px-3 me-3">
                                    <i class="bi bi-shield-check text-white fs-5"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1 fw-semibold">Soporte Técnico 24/7</h6>
                                    <small class="opacity-75">Asistencia continua para tu proyecto</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Columna derecha - Formulario -->
    <div class="col-lg-4 col-12 d-flex align-items-center" 
         style="background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);">
        <div class="w-100 p-4 p-lg-5">
            <!-- Header del formulario -->
            <div class="text-center mb-5">
                <a href="home" class="d-inline-block mb-4">
                    <img src="<?php echo FAVICON ?>logo-bimp.png" 
                         alt="Logo Bimp Software" 
                         width="140" 
                         class="img-fluid">
                </a>
                <h2 class="text-white fw-bold mb-2">Iniciar Sesión</h2>
                <p class="text-white-50 mb-0">Ingresa tus credenciales para continuar</p>
            </div>

            <!-- Mensajes flash -->
            <div class="mb-4">
                <?php echo Bimp\Forge\Flasher\Flasher::flash(5); ?>
            </div>

            <!-- Formulario -->
            <form id="frm_login" action="login/post_login" method="POST" class="needs-validation" novalidate>
                <?= insert_inputs(); ?>

                <!-- Campo Usuario -->
                <div class="mb-4">
                    <label for="inputUsuario" class="form-label text-white fw-semibold mb-2">
                        <i class="bi bi-person-circle me-2"></i>Run o Email
                    </label>
                    <div class="input-group input-group-lg">
                        <span class="input-group-text border-0 bg-warning text-dark">
                            <i class="bi bi-envelope-fill"></i>
                        </span>
                        <input type="text" 
                               class="form-control border-0 text-white" 
                               style="background: rgba(255,255,255,0.1); "
                               id="inputUsuario" 
                               name="usuario" 
                               placeholder="ejemplo@correo.com" 
                               required>
                        <div class="invalid-feedback">Por favor ingresa tu usuario o email</div>
                    </div>
                </div>

                <!-- Campo Contraseña -->
                <div class="mb-4">
                    <label for="inputPassword" class="form-label text-white fw-semibold mb-2">
                        <i class="bi bi-shield-lock me-2"></i>Contraseña
                    </label>
                    <div class="input-group input-group-lg">
                        <span class="input-group-text border-0 bg-warning text-dark">
                            <i class="bi bi-key-fill"></i>
                        </span>
                        <input type="password" 
                               class="form-control border-0 text-white" 
                               style="background: rgba(255,255,255,0.1);"
                               id="inputPassword" 
                               name="password" 
                               placeholder="••••••••" 
                               required>
                        <button class="btn border-0" 
                                type="button" 
                                id="togglePassword"
                                style="background: rgba(255,255,255,0.1); color: rgba(255,255,255,0.7);">
                            <i class="bi bi-eye-fill" id="eyeIcon"></i>
                        </button>
                        <div class="invalid-feedback">Por favor ingresa tu contraseña</div>
                    </div>
                    <div class="text-end mt-2">
                        <a href="login/olvidar" 
                           class="text-decoration-none text-white-50 small fw-semibold">
                            ¿Olvidaste tu contraseña?
                        </a>
                    </div>
                </div>

                <!-- Recordar sesión -->
                <div class="form-check mb-4">
                    <input class="form-check-input" type="checkbox" id="rememberMe" name="remember">
                    <label class="form-check-label text-white-50" for="rememberMe">
                        <i class="bi bi-bookmark-check me-1"></i>Recordar mi sesión
                    </label>
                </div>

                <!-- Botón de envío -->
                <div class="d-grid mb-4">
                    <button type="submit" 
                            class="btn btn-primary btn-lg fw-bold py-3 shadow-lg position-relative overflow-hidden">
                        <span class="position-relative z-1">
                            <i class="bi bi-box-arrow-in-right me-2"></i>Ingresar al Sistema
                        </span>
                    </button>
                </div>

                <!-- Información adicional -->
                <div class="text-center">
                    <small class="text-white-50">
                        <i class="bi bi-shield-check me-1"></i>
                        Conexión segura SSL
                    </small>
                </div>
            </form>
        </div>
    </div>
</section>


<?php require_once INCLUDES . 'inc_hfooter.php'; ?>