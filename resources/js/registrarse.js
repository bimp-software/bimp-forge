// Función para mostrar errores con SweetAlert2
function showError(message) {
  Swal.fire({
    icon: 'error',
    title: 'Error',
    text: message,
    confirmButtonColor: '#fba60c',
    background: '#2d2d2d',
    color: 'white'
  });
}

// Validación del RUT
function validarRUT(rut) {
    if (!/^[0-9]{7,8}-[0-9kK]{1}$/.test(rut)) return false;
    
    const [numero, digitoVerificador] = rut.split('-');
    const dv = digitoVerificador.toLowerCase();
    const cuerpo = numero.split('').reverse().map(Number);
    
    let suma = 0;
    let multiplicador = 2;
    
    for (const numero of cuerpo) {
        suma += numero * multiplicador;
        multiplicador = multiplicador === 7 ? 2 : multiplicador + 1;
    }
    
    const dvEsperado = 11 - (suma % 11);
    const dvCalculado = dvEsperado === 11 ? '0' : dvEsperado === 10 ? 'k' : dvEsperado.toString();
    
    return dv === dvCalculado;
}

// Generar nick automático
function generarNick() {
    const nombre = document.getElementById('nombre').value.trim().toLowerCase();
    const apellido = document.getElementById('apellido_paterno').value.trim().toLowerCase();
    
    if (nombre && apellido && document.getElementById('nick').readOnly) {
        const primerNombre = nombre.split(' ')[0];
        let nick = (primerNombre + '.' + apellido)
        .normalize("NFD").replace(/[\u0300-\u036f]/g, "")
        .replace(/[^a-z0-9.]/g, "")
        .substring(0, 20);
        
        if (primerNombre.length > 10) {
        nick = (primerNombre.substring(0, 3) + '.' + apellido.substring(0, 15))
            .normalize("NFD").replace(/[\u0300-\u036f]/g, "")
            .replace(/[^a-z0-9.]/g, "")
            .substring(0, 20);
        }
        
        document.getElementById('nick').value = nick;
    }
}

// Mostrar/ocultar contraseña
function togglePassword(fieldId) {
    const password = document.getElementById(fieldId);
    const icon = document.getElementById(fieldId + '-icon');
    if (password.type === 'password') {
        password.type = 'text';
        icon.className = 'bi bi-eye-slash';
    } else {
        password.type = 'password';
        icon.className = 'bi bi-eye';
    }
}

// Medidor de fortaleza de contraseña
document.getElementById('password').addEventListener('input', function() {
    const strengthBar = document.getElementById('passwordStrength');
    let strength = 0;
    
    if (this.value.length >= 8) strength += 30;
    if (this.value.length >= 12) strength += 20;
    if (/[A-Z]/.test(this.value)) strength += 15;
    if (/[0-9]/.test(this.value)) strength += 15;
    if (/[^A-Za-z0-9]/.test(this.value)) strength += 20;
    
    strengthBar.style.width = Math.min(strength, 100) + '%';
    strengthBar.className = 'progress-bar ' + 
        (strength < 30 ? 'bg-danger' : 
        strength < 70 ? 'bg-warning' : 'bg-success');
});

// Navegación por pasos
document.querySelectorAll('.next-step').forEach(button => {
    button.addEventListener('click', function() {
        const currentSection = this.closest('.form-section');
        const nextSectionId = this.dataset.next;
        
        // Validación especial para RUT
        if (currentSection.id === 'section-1') {
            const rutInput = document.getElementById('rut');
            if (!validarRUT(rutInput.value)) {
                rutInput.classList.add('is-invalid');
                showError('Por favor ingresa un RUT válido');
                return;
            } else {
                rutInput.classList.remove('is-invalid');
            }
        }
        
        // Validar campos antes de avanzar
        const inputs = currentSection.querySelectorAll('input[required]');
        let isValid = true;
        let firstInvalid = null;
        
        inputs.forEach(input => {
            if (!input.value.trim() || (input.id === 'rut' && !validarRUT(input.value))) {
                input.classList.add('is-invalid');
                isValid = false;
                if (!firstInvalid) firstInvalid = input;
            } else {
                input.classList.remove('is-invalid');
            }
        });
        
        if (!isValid) {
            if (firstInvalid) firstInvalid.focus();
            showError('Por favor completa todos los campos requeridos');
            return;
        }
        
        // Avanzar al siguiente paso
        currentSection.classList.remove('active');
        document.getElementById(`section-${nextSectionId}`).classList.add('active');
        
        // Actualizar indicador de pasos
        document.querySelectorAll('.step').forEach(step => {
            step.classList.remove('active', 'completed');
            if (parseInt(step.dataset.step) < parseInt(nextSectionId)) {
                step.classList.add('completed');
            } else if (parseInt(step.dataset.step) === parseInt(nextSectionId)) {
                step.classList.add('active');
            }
        });
        
        // Enfocar el primer campo del siguiente paso
        const nextSection = document.getElementById(`section-${nextSectionId}`);
        const firstInput = nextSection.querySelector('input, select, textarea');
        if (firstInput) firstInput.focus();
    });
});

document.querySelectorAll('.prev-step').forEach(button => {
    button.addEventListener('click', function() {
        const currentSection = this.closest('.form-section');
        const prevSectionId = this.dataset.prev;
        
        currentSection.classList.remove('active');
        document.getElementById(`section-${prevSectionId}`).classList.add('active');
        
        // Actualizar indicador de pasos
        document.querySelectorAll('.step').forEach(step => {
            step.classList.remove('active', 'completed');
            if (parseInt(step.dataset.step) < parseInt(prevSectionId)) {
                step.classList.add('completed');
            } else if (parseInt(step.dataset.step) === parseInt(prevSectionId)) {
                step.classList.add('active');
            }
        });
        
        // Enfocar el primer campo del paso anterior
        const prevSection = document.getElementById(`section-${prevSectionId}`);
        const firstInput = prevSection.querySelector('input, select, textarea');
        if (firstInput) firstInput.focus();
    });
});

// Validación del formulario al enviar
document.getElementById('userForm').addEventListener('submit', function(e) {
    // Validar términos y condiciones
    if (!document.getElementById('termsCheck').checked) {
        e.preventDefault();
        showError('Debes aceptar los términos y condiciones');
        document.getElementById('termsCheck').focus();
        return;
    }
    
    // Validar RUT nuevamente por si acaso
    const rutInput = document.getElementById('rut');
    if (!validarRUT(rutInput.value)) {
        e.preventDefault();
        rutInput.classList.add('is-invalid');
        showError('Por favor ingresa un RUT válido');
        rutInput.focus();
        return;
    }
    
    // Mostrar mensaje de éxito
    e.preventDefault();
    Swal.fire({
        title: '¿Estás seguro?',
        text: '¿Deseas crear tu cuenta con los datos ingresados?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#fba60c',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Sí, crear cuenta',
        cancelButtonText: 'Revisar datos',
        background: '#2d2d2d',
        color: 'white'
    }).then((result) => {
        if (result.isConfirmed) {
            this.submit();
        }
    });
});

// Formatear RUT mientras se escribe
document.getElementById('rut').addEventListener('input', function(e) {
    let value = e.target.value.replace(/[^0-9kK]/g, '');
    if (value.length > 1) {
        value = value.slice(0, -1) + '-' + value.slice(-1);
    }
    e.target.value = value;
});