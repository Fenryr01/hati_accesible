<?php
header('Content-Type: application/json'); // Asegúrate de que la respuesta sea JSON
error_reporting(E_ALL);
ini_set('display_errors', 1); // Habilitar la visualización de errores

// Incluir la conexión a la base de datos
include("db.php");

// Verificar si se recibe una petición POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $password = $_POST['password'];
    //$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $permisos = isset($_POST['permisos']) ? $_POST['permisos'] : [];

    // Validar que el nombre no esté vacío
    if (empty($nombre)) {
        echo json_encode(['message' => 'El nombre es obligatorio.']);
        exit;
    }

    // Insertar permisos en la tabla permisos
    $permisos_id = null;

    if (!empty($permisos)) {
        // Preparar la consulta para insertar permisos
        $query = "INSERT INTO permisos (noticias, ver_tablas, editar_tablas, graficos, roles, formulario_discapacidad) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conexion->prepare($query);

        // Convertir permisos a '1' o '0'
        $permisos_array = [
            in_array('noticias', $permisos) ? '1' : '0',
            in_array('ver_tablas', $permisos) ? '1' : '0',
            in_array('editar_tablas', $permisos) ? '1' : '0',
            in_array('graficos', $permisos) ? '1' : '0',
            in_array('roles', $permisos) ? '1' : '0',
            in_array('formulario_discapacidad', $permisos) ? '1' : '0'
        ];

        $stmt->bind_param("ssssss", ...$permisos_array);

        // Ejecutar la consulta de permisos
        if ($stmt->execute()) {
            $permisos_id = $stmt->insert_id; // Obtener el ID de permisos insertado
        } else {
            echo json_encode(['message' => 'Error al insertar permisos: ' . $stmt->error]);
            exit;
        }
    }

    // Insertar el nuevo usuario
    if ($permisos_id !== null) {
        $query = "INSERT INTO usuarios (nombre, password, permisos_id) VALUES (?, ?, ?)";
        $stmt = $conexion->prepare($query);
        $stmt->bind_param("ssi", $nombre, $password, $permisos_id);

        // Ejecutar la consulta de usuarios
        if ($stmt->execute()) {
            echo json_encode(['message' => 'Usuario agregado exitosamente.']);
            exit;
        } else {
            echo json_encode(['message' => 'Error al agregar usuario: ' . $stmt->error]);
        }
    } else {
        echo json_encode(['message' => 'No se pudieron insertar los permisos.']);
    }

    // Cerrar la declaración y la conexión
    $stmt->close();
    $conexion->close();
}
?>
