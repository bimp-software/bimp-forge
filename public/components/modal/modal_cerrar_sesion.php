<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document"> <!-- centrado -->
        <div class="modal-content border-0 shadow-lg">
            
            <!-- Encabezado con gradiente -->
            <div class="modal-header text-white" style="background: linear-gradient(90deg, #1cc88a 0%, #17a673 100%);">
                <h5 class="modal-title" id="logoutModalLabel">
                    <i class="fas fa-sign-out-alt fa-fw mr-2"></i> ¿Cerrar Sesión?
                </h5>
                <button class="close text-white" type="button" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <!-- Cuerpo del modal -->
            <div class="modal-body text-center">
                <div class="mb-3">
                    <i class="fas fa-question-circle fa-4x text-success mb-3"></i>
                    <p class="h5">¿Estás seguro de que deseas cerrar sesión?</p>
                    <p class="text-muted mb-0">Serás redirigido a la página de inicio de sesión.</p>
                </div>
            </div>
            
            <!-- Footer con botones -->
            <div class="modal-footer justify-content-center">
                <button class="btn btn-outline-secondary px-4" type="button" data-dismiss="modal">
                    <i class="fas fa-times mr-1"></i> Cancelar
                </button>
                <a class="btn btn-success px-4" href="logout">
                    <i class="fas fa-sign-out-alt mr-1"></i> Salir
                </a>
            </div>
        </div>
    </div>
</div>
