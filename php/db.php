<?php
// Obtener las variables de entorno
$host = getenv('DB_HOST');
$usuario = getenv('DB_USER');
$contrasena = getenv('DB_PASSWORD');
$base_de_datos = getenv('DB_DBNAME');
$puerto = 3306; // Cambia el puerto si es necesario

// Crear la conexión a la base de datos
$conexion = new mysqli($host, $usuario, $contrasena, $base_de_datos, $puerto);

// Verificar si la conexión es exitosa
if ($conexion->connect_error) {
    die("Error de conexión a la base de datos: " . $conexion->connect_error);
}
?>
