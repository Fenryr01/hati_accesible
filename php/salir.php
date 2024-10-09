<?php
session_start();

// Destruir todas las variables de sesión
$_SESSION = [];

// Si se desea destruir la sesión completamente, borra también la cookie de sesión.
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Destruir la sesión
session_destroy();

// Redirigir al usuario a la página de login o inicio
header("Location: ../index.php"); // Cambia esto a la página de inicio deseada
exit();
?>
