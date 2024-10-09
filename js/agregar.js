// Función para abrir el pop-up de agregar usuario
document.getElementById('btn-agregar-usuario').addEventListener('click', function() {
    const popup = document.createElement('div');
    popup.className = 'popup';
    popup.innerHTML = `
        <div class="popup-content">
            <span class="close">&times;</span>
            <h2>Agregar Usuario</h2>
            <form class="form-agregar-usuario" id="form-agregar-usuario">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required>
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
                
                <h3>Permisos:</h3>
                <label><input type="checkbox" name="permisos[]" value="noticias"> Noticias</label><br>
                <label><input type="checkbox" name="permisos[]" value="ver_tablas"> Ver Tablas</label><br>
                <label><input type="checkbox" name="permisos[]" value="editar_tablas"> Editar Tablas</label><br>
                <label><input type="checkbox" name="permisos[]" value="graficos"> Gráficos</label><br>
                <label><input type="checkbox" name="permisos[]" value="roles"> Roles</label><br>
                <label><input type="checkbox" name="permisos[]" value="usuarios"> Usuarios</label><br>
                <label><input type="checkbox" name="permisos[]" value="formulario_discapacidad"> Formulario de Discapacidad</label><br>
                
                <button type="submit">Agregar Usuario</button>
            </form>
        </div>
    `;
    document.body.appendChild(popup);

    // Cerrar el pop-up
    popup.querySelector('.close').onclick = function() {
        document.body.removeChild(popup);
    };

    // Manejar la sumisión del formulario
    const agregarUsuarioForm = popup.querySelector('#form-agregar-usuario'); // Referencia correcta
    agregarUsuarioForm.addEventListener('submit', function(e) {
        e.preventDefault(); // Prevenir el envío normal del formulario

        const formData = new FormData(this); // Obtener los datos del formulario
        fetch('php/agregar_usuarios.php', {
            method: 'POST',
            body: formData // Enviar los datos al servidor
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la respuesta del servidor: ' + response.status);
            }
            return response.json(); // Parsear la respuesta JSON
        })
        .then(data => {
            // Recargar la página después de un agregado exitoso
            location.reload();
        })
        .catch(error => {
            console.error('Error:', error); // Manejar errores
        });
    });
});
