<?php
session_start();
include("db.php");

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Preparar la consulta para prevenir inyecciones SQL
    $stmt = $conexion->prepare("SELECT u.id, u.nombre, 
                                   p.ver_tablas, 
                                   p.graficos, 
                                   p.roles, 
                                   p.editar_tablas, 
                                   p.noticias,
                                   p.formulario_discapacidad  
                            FROM usuarios u
                            JOIN permisos p ON u.permisos_id = p.id
                            WHERE u.nombre = ? AND u.password = ?");

    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

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
        ];

        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }

    $stmt->close();
}

$conexion->close();
?>
