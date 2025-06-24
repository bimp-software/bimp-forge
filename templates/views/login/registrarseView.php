<?php require_once INCLUDES . 'inc_hheader.php'; ?>

<style>
  /* Estilos mejorados */
  body, html {
    height: 100%;
    overflow: hidden;
  }
  
  .register-container {
    background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
    display: flex;
    align-items: center;
    min-height: 100vh;
    padding: 2rem 0;
  }
  
  .register-card {
    background: rgba(30, 30, 30, 0.95);
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(251, 166, 12, 0.2);
    max-width: 800px;
    margin: 0 auto;
    overflow: hidden;
  }
  
  .register-header {
    border-bottom: 1px solid rgba(251, 166, 12, 0.3);
    position: relative;
    padding-bottom: 1rem;
  }
  
  .register-header::after {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 0;
    width: 100px;
    height: 3px;
    background: #fba60c;
  }
  
  .form-label {
    color: #fba60c;
    font-weight: 500;
    margin-bottom: 0.5rem;
    font-size: 0.9rem;
  }
  
  .form-control {
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    color: #fff;
    transition: all 0.3s;
    padding: 0.5rem 0.75rem;
    font-size: 0.9rem;
  }
  
  .form-control:focus {
    background: rgba(255, 255, 255, 0.1);
    border-color: #fba60c;
    box-shadow: 0 0 0 0.25rem rgba(251, 166, 12, 0.25);
    color: #fff;
  }
  
  .input-group-text {
    background: rgba(251, 166, 12, 0.1);
    border: 1px solid rgba(251, 166, 12, 0.3);
    color: #fba60c;
    font-size: 0.9rem;
  }
  
  .progress {
    height: 4px;
    background: rgba(255, 255, 255, 0.1);
    margin-top: 0.3rem;
  }
  
  .step-indicator {
    display: flex;
    justify-content: center;
    margin-bottom: 2rem;
    position: relative;
  }
  
  .step {
    width: 35px;
    height: 35px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.1);
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    position: relative;
    z-index: 2;
    margin: 0 1.5rem;
  }
  
  .step.active {
    background: #fba60c;
    color: #1a1a1a;
    transform: scale(1.1);
  }
  
  .step.completed {
    background: #28a745;
    color: white;
  }
  
  .step-connector {
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    height: 2px;
    background: rgba(255, 255, 255, 0.2);
    transform: translateY(-50%);
    z-index: 1;
  }
  
  .form-section {
    display: none;
    padding: 0 1rem;
  }
  
  .form-section.active {
    display: block;
    animation: fadeIn 0.4s ease;
  }
  
  @keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
  }
  
  .terms-content {
    max-height: 120px;
    overflow-y: auto;
    font-size: 0.85rem;
    padding-right: 0.5rem;
  }
  
  .terms-content::-webkit-scrollbar {
    width: 5px;
  }
  
  .terms-content::-webkit-scrollbar-thumb {
    background-color: rgba(251, 166, 12, 0.5);
    border-radius: 10px;
  }
  
  .btn-outline-warning {
    border-color: #fba60c;
    color: #fba60c;
  }
  
  .btn-outline-warning:hover {
    background: #fba60c;
    color: #1a1a1a;
  }
  
  .btn-warning {
    background: #fba60c;
    color: #1a1a1a;
    font-weight: 600;
  }
  
  .btn-warning:hover {
    background: #e6950b;
    color: #1a1a1a;
  }
</style>

<div class="register-container">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-10">
        <div class="register-card p-4 p-lg-5">
          <!-- Encabezado -->
          <div class="register-header text-center mb-4">
            <a href="home" class="d-inline-block mb-3">
              <img src="<?php echo FAVICON ?>logo-bimp.png" alt="Logo Bimp Software" width="140">
            </a>
            <h2 class="text-white mb-2">Comienza tu aventura</h2>
            <p class="text-white-50 mb-0">Crea tu cuenta en simples pasos</p>
          </div>
          
          <!-- Indicador de pasos -->
          <div class="step-indicator">
            <div class="step active" data-step="1">1</div>
            <div class="step" data-step="2">2</div>
            <div class="step" data-step="3">3</div>
            <div class="step-connector"></div>
          </div>
          
          <!-- Mensajes flash -->
          <div class="mb-4">
            <?php echo Bimp\Forge\Flasher\Flasher::flash(5); ?>
          </div>
          
          <form action="login/crear_usuario" method="POST" class="needs-validation" novalidate id="userForm">
            <?= insert_inputs(); ?>
            
            <!-- Sección 1: Información personal -->
            <div class="form-section active" id="section-1">
              <h5 class="text-white mb-4"><i class="bi bi-person-circle me-2"></i> Información Personal</h5>
              
              <div class="row g-3">
                <div class="col-md-4">
                  <label class="form-label" for="nombre">Nombre <span class="text-danger">*</span></label>
                  <input type="text" name="nombre" id="nombre" class="form-control"  required oninput="generarNick()" autofocus>
                  <div class="invalid-feedback">Ingresa tu nombre</div>
                </div>
                
                <div class="col-md-4">
                  <label class="form-label" for="apellido_paterno">Apellido Paterno <span class="text-danger">*</span></label>
                  <input type="text" name="apellido_paterno" id="apellido_paterno" class="form-control" required oninput="generarNick()">
                  <div class="invalid-feedback">Ingresa tu apellido paterno</div>
                </div>
                
                <div class="col-md-4">
                  <label class="form-label" for="apellido_materno">Apellido Materno <span class="text-danger">*</span></label>
                  <input type="text" name="apellido_materno" id="apellido_materno" class="form-control" required>
                  <div class="invalid-feedback">Ingresa tu apellido materno</div>
                </div>
                
                <div class="col-12">
                  <label class="form-label" for="rut">RUT <span class="text-danger">*</span></label>
                  <input type="text" name="rut" id="rut" class="form-control" placeholder="12345678-9" maxlength="12" required pattern="^[0-9]{7,8}-[0-9kK]{1}$">
                  <div class="invalid-feedback">Ingresa un RUT válido</div>
                </div>
              </div>
              
              <div class="d-flex justify-content-end mt-4">
                <button type="button" class="btn btn-outline-warning next-step" data-next="2">
                  Siguiente <i class="bi bi-arrow-right ms-2"></i>
                </button>
              </div>
            </div>
            
            <!-- Sección 2: Credenciales -->
            <div class="form-section" id="section-2">
              <h5 class="text-white mb-4"><i class="bi bi-shield-lock me-2"></i> Credenciales de Acceso</h5>
              
              <div class="row g-3">
                <div class="col-md-6">
                  <label class="form-label" for="correo">Correo Electrónico <span class="text-danger">*</span></label>
                  <input type="email" name="correo" id="correo" class="form-control" required>
                  <div class="invalid-feedback">Ingresa un correo válido</div>
                </div>
                
                <div class="col-md-6">
                  <label class="form-label" for="nick">Usuario <span class="text-danger">*</span></label>
                  <div class="input-group">
                    <input type="text" name="nick" id="nick" class="form-control" required readonly>
                    <button class="btn btn-outline-secondary" type="button" onclick="document.getElementById('nick').readOnly = !document.getElementById('nick').readOnly">
                      <i class="bi bi-pencil"></i>
                    </button>
                  </div>
                  <div class="invalid-feedback">Ingresa un nombre de usuario</div>
                </div>
                
                <div class="col-12">
                  <label class="form-label" for="password">Contraseña <span class="text-danger">*</span></label>
                  <div class="input-group">
                    <input type="password" name="password" id="password" class="form-control" required minlength="8">
                    <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password')">
                      <i class="bi bi-eye" id="password-icon"></i>
                    </button>
                  </div>
                  <div class="progress mt-2">
                    <div class="progress-bar" id="passwordStrength" role="progressbar"></div>
                  </div>
                  <small class="text-muted">Mínimo 8 caracteres (usa mayúsculas, números y símbolos)</small>
                  <div class="invalid-feedback">La contraseña debe tener al menos 8 caracteres</div>
                </div>
              </div>
              
              <div class="d-flex justify-content-between mt-4">
                <button type="button" class="btn btn-outline-light prev-step" data-prev="1">
                  <i class="bi bi-arrow-left me-2"></i> Anterior
                </button>
                <button type="button" class="btn btn-outline-warning next-step" data-next="3">
                  Siguiente <i class="bi bi-arrow-right ms-2"></i>
                </button>
              </div>
            </div>
            
            <!-- Sección 3: Términos y Finalización -->
            <div class="form-section" id="section-3">
              <h5 class="text-white mb-4"><i class="bi bi-check-circle me-2"></i> Términos y Finalización</h5>
              
              <div class="form-check mb-4">
                <input type="checkbox" class="form-check-input" name="terminos" id="termsCheck" value="1" required>
                <label for="termsCheck" class="form-check-label text-white-50">
                  Acepto los <a href="#" class="text-warning">términos y condiciones</a> y la <a href="#" class="text-warning">política de privacidad</a>
                </label>
                <div class="invalid-feedback">Debes aceptar los términos y condiciones</div>
              </div>
              
              <div class="d-flex justify-content-between">
                <button type="button" class="btn btn-outline-light prev-step" data-prev="2">
                  <i class="bi bi-arrow-left me-2"></i> Anterior
                </button>
                <button type="submit" class="btn btn-warning">
                  <i class="bi bi-person-plus me-2"></i> Crear Cuenta
                </button>
              </div>
            </div>
          </form>
          
          <div class="text-center mt-4 pt-3 border-top border-secondary">
            <small class="text-white-50">
              ¿Ya tienes cuenta? <a href="login" class="text-warning fw-bold">Inicia sesión aquí</a>
            </small>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>

</script>

<?php require_once INCLUDES . 'inc_hfooter.php'; ?>