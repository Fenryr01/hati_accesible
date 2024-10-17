// Obtener elementos del DOM
var modal = document.getElementById("loginModal");
var btn = document.getElementById("loginBtn");
var span = document.getElementsByClassName("close")[0];

// Abrir el modal al hacer clic en el favicon
btn.onclick = function() {
    modal.style.visibility = "visible";
}

// Cerrar el modal al hacer clic en la "X"
span.onclick = function() {
    modal.style.visibility = "hidden";
}

document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Evitar que el formulario se envíe de la forma habitual

    const formData = new FormData(this); // Obtener los datos del formulario

    fetch('php/login.php', { // Cambia la ruta según sea necesario
        method: 'POST',
        body: formData,
    })
    .then(response => response.json())
    .then(data => {
        const errorMessage = document.getElementById('errorMessage');
        if (data.success) {
            // Redirigir o cerrar el modal
            window.location.href = 'index.php'; // Cambia según tu necesidad
        } else {
            // Mostrar mensaje de error
            errorMessage.style.display = 'block';
        }
    })
    .catch(error => console.error('Error:', error));
});
