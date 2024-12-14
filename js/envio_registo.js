document.getElementById('form_registro').addEventListener('submit', function(event) {
    event.preventDefault(); // Evita el envío tradicional del formulario

    var formData = new FormData(this); // Captura todos los datos del formulario

    // Enviar los datos a registro_discapacidad.php usando AJAX
    fetch('php/registro_discapacidad.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json()) // Esperamos un JSON de respuesta
    .then(data => {
        if (data.success) {
            // Si la respuesta es exitosa, mostramos el mensaje de éxito
            Swal.fire({
                title: 'Gracias por registrarse',
                text: data.message,
                icon: 'success',
                confirmButtonText: 'Aceptar'
            }).then(() => {
                window.location.href = 'index.php'; // Redirigir después de aceptar
            });
        } else {
            // Si hubo un error, mostramos un mensaje de error
            Swal.fire({
                title: 'Error',
                text: data.message,
                icon: 'error',
                confirmButtonText: 'Aceptar'
            });
        }
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire({
            title: 'Error',
            text: 'DNI duplicado.',
            icon: 'error',
            confirmButtonText: 'Aceptar'
        });
    });
});

