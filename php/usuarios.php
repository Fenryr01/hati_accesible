<?php
include("db.php"); // Incluir la conexión a la base de datos

// Consulta para obtener los usuarios
$query = "SELECT id, nombre, password FROM usuarios"; // Ajustar según los nombres de las columnas
$resultado = $conexion->query($query);

if ($resultado->num_rows > 0) {
    echo '<table class="tablita">';
    echo '<tr><th>Nombre</th><th>Contraseña</th><th>Editar</th><th>Eliminar</th></tr>'; // Agregamos una columna para eliminar

    while ($usuario = $resultado->fetch_assoc()) {
        $id = $usuario['id'];
        $nombre = htmlspecialchars($usuario['nombre']);
        $password = htmlspecialchars($usuario['password']);
        
        // Mostrar cada usuario en una fila de la tabla
        echo '<tr>';
        echo '<td data-label="Nombre"><input type="text" name="nombre[' . $id . ']" value="' . $nombre . '" disabled /></td>';
        echo '<td data-label="Contraseña"><input type="text" name="password[' . $id . ']" class="password-input"  value="" disabled /></td>';
        echo '<td data-label="Editar">
            <label class="switch">
                <input type="checkbox" name="editar[' . $id . ']" onclick="toggleEdit(this, ' . $id . ')" />
                <span class="slider"></span>
                <span class="knob"></span>
            </label>
        </td>';  
        
        // Checkbox para eliminar usuario solo si no es el admin (id 1)
        if ($id != 1) {
            echo '<td data-label="Eliminar">
                <div class="check_delete">
                    <label class="container_delete">
                        <input type="checkbox" name="eliminar[]" value="' . $id . '" />
                        <div class="checkmark">X</div>
                    </label>
                </div>
            </td>'; 
        } else {
            echo '<td class="admin_delete" data-label="Eliminar"> No se puede eliminar</td>'; // Mensaje o vacío si prefieres
        }
        
        echo '</tr>';
    }

    echo '</table>';
} else {
    echo '<p>No hay usuarios registrados.</p>';
}

$conexion->close(); // Cerrar la conexión
?>
