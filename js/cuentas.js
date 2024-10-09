function toggleEdit(checkbox, id) {
    // Obtiene los campos de nombre y contraseña de la fila correspondiente
    const nombreInput = document.querySelector(`input[name="nombre[${id}]"]`);
    const passwordInput = document.querySelector(`input[name="password[${id}]"]`);

    // Habilita o deshabilita los campos según el estado del checkbox
    nombreInput.disabled = !checkbox.checked;
    passwordInput.disabled = !checkbox.checked;

    // Manejo de la clase .password-input
    if (checkbox.checked) {
        passwordInput.classList.remove('password-input'); // Elimina la clase si se habilita
    } else {
        passwordInput.classList.add('password-input'); // Agrega la clase si se deshabilita
    }
}

// Función para habilitar todos los inputs antes de enviar el formulario
function enableAllInputs() {
    const inputs = document.querySelectorAll('input[type="text"], input[type="password"]');
    inputs.forEach(input => {
        input.disabled = false;
        input.classList.remove('password-input');
    });

    // Envía el formulario manualmente después de habilitar los inputs
    document.getElementById('form-usuarios-permisos').submit();
}

// Agregar un evento al botón de "Guardar Cambios" para habilitar todos los inputs antes de enviar
document.querySelector('button[type="submit"]').addEventListener('click', enableAllInputs);


