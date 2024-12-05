<?php
session_start();
include("db.php");

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Preparar la consulta para buscar el hash de la contraseña
    $stmt = $conexion->prepare("SELECT u.id, u.nombre, u.password,
                                   p.ver_tablas, 
                                   p.graficos, 
                                   p.roles, 
                                   p.editar_tablas, 
                                   p.noticias,
                                   p.formulario_discapacidad,
                                   p.eliminar  
                            FROM usuarios u
                            JOIN permisos p ON u.permisos_id = p.id
                            WHERE u.nombre = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verificar la contraseña usando password_verify
        if (password_verify($password, $user['password'])) {
            // Guardar la información del usuario y permisos en la sesión
            $_SESSION['user_id'] = $user['id']; // Almacena el ID del usuario
            $_SESSION['username'] = $user['nombre'];
            $_SESSION['permisos'] = [
                'ver_tablas' => $user['ver_tablas'],
                'graficos' => $user['graficos'],
                'roles' => $user['roles'],
                'editar_tablas' => $user['editar_tablas'],
                'noticias' => $user['noticias'],
                'formulario_discapacidad' => $user['formulario_discapacidad'],
                'eliminar' => $user['eliminar']
            ];

            echo json_encode(['success' => true]);
        } else {
            // Contraseña incorrecta
            echo json_encode(['success' => false, 'message' => 'Contraseña incorrecta']);
        }
    } else {
        // Usuario no encontrado
        echo json_encode(['success' => false, 'message' => 'Usuario no encontrado']);
    }

    $stmt->close();
}

$conexion->close();
?>
