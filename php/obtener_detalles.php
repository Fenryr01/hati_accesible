<?php
include("db.php");

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = "SELECT * FROM registro_discapacidad WHERE id = $id";
    $resultado = mysqli_query($conexion, $query);

    if ($fila = mysqli_fetch_assoc($resultado)) {
        // Mostrar el formulario con los datos actuales
        echo "<form method='POST' action=''>"; // Asegúrate de que el action sea el mismo archivo o el archivo que maneja la actualización
        echo "<p><strong>Nombre:</strong> <input type='text' name='nombre' value='" . htmlspecialchars($fila['nombre']) . "'></p>";
        echo "<p><strong>Apellido:</strong> <input type='text' name='apellido' value='" . htmlspecialchars($fila['apellido']) . "'></p>";
        echo "<p><strong>DNI:</strong> <input type='text' name='dni' value='" . htmlspecialchars($fila['dni']) . "'></p>";
        echo "<p><strong>Dirección:</strong> <input type='text' name='direccion' value='" . htmlspecialchars($fila['direccion']) . "'></p>";
        echo "<p><strong>Teléfono:</strong> <input type='text' name='telefono' value='" . htmlspecialchars($fila['telefono']) . "'></p>";
        echo "<p><strong>Correo Electrónico:</strong> <input type='email' name='correo_electronico' value='" . htmlspecialchars($fila['correo_electronico']) . "'></p>";
        echo "<p><strong>Certificado de Discapacidad:</strong> <input type='checkbox' name='certificado_discapacidad' " . ($fila['certificado_discapacidad'] ? 'checked' : '') . "></p>";
        echo "<p><strong>Quienes:</strong> <input type='text' name='quienes' value='" . htmlspecialchars($fila['quienes']) . "'></p>";
        echo "<p><strong>Visitado:</strong> <input type='checkbox' name='visitado' " . ($fila['visitado'] ? 'checked' : '') . "></p>";
        echo "<input type='hidden' name='id' value='$id'>"; // Para enviar el ID del registro
        echo "<button type='submit' name='guardar_cambios'>Guardar cambios</button>";
        echo "</form>";
    } else {
        echo "No se encontraron detalles.";
    }

    mysqli_free_result($resultado);
}

// Manejar la actualización de datos
if (isset($_POST['guardar_cambios'])) {
    $id = intval($_POST['id']);
    $nombre = $_POST['nombre'] !== '' ? $_POST['nombre'] : null;
    $apellido = $_POST['apellido'] !== '' ? $_POST['apellido'] : null;
    $dni = $_POST['dni'] !== '' ? $_POST['dni'] : null;
    $direccion = $_POST['direccion'] !== '' ? $_POST['direccion'] : null;
    $telefono = $_POST['telefono'] !== '' ? $_POST['telefono'] : null;
    $correo_electronico = $_POST['correo_electronico'] !== '' ? $_POST['correo_electronico'] : null;
    $certificado_discapacidad = isset($_POST['certificado_discapacidad']) ? 1 : 0;
    $quienes = $_POST['quienes'] !== '' ? $_POST['quienes'] : null;
    $visitado = isset($_POST['visitado']) ? 1 : 0;

    // Crear la consulta de actualización
    $update_query = "UPDATE registro_discapacidad SET ";

    // Construir la consulta de actualización
    if ($nombre !== null) $update_query .= "nombre='$nombre', ";
    if ($apellido !== null) $update_query .= "apellido='$apellido', ";
    if ($dni !== null) $update_query .= "dni='$dni', ";
    if ($direccion !== null) $update_query .= "direccion='$direccion', ";
    if ($telefono !== null) $update_query .= "telefono='$telefono', ";
    if ($correo_electronico !== null) $update_query .= "correo_electronico='$correo_electronico', ";
    $update_query .= "certificado_discapacidad='$certificado_discapacidad', ";
    if ($quienes !== null) $update_query .= "quienes='$quienes', ";
    $update_query .= "visitado='$visitado' ";
    $update_query .= "WHERE id='$id'";

    // Eliminar la última coma y espacio
    $update_query = rtrim($update_query, ', ');

    // Ejecutar la consulta de actualización
    if (mysqli_query($conexion, $update_query)) {
        echo "Datos actualizados correctamente.";
    } else {
        echo "Error al actualizar los datos: " . mysqli_error($conexion);
    }
}

mysqli_close($conexion);
?>
