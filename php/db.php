<?php
// Conexión a la base de datos porque manuel tiene razon y asi no hay q escribirlo cada vez, ademas quien usa contrasena? mas confuso esto
$host = "localhost";
$usuario = "root";
$contrasena = "";
$base_de_datos = "accesibilidad";
$puerto = 3308; // PUERTO CAMBIARLO

$conexion = new mysqli($host, $usuario, $contrasena, $base_de_datos, $puerto);

// Verificar si la conexión es exitosa
if ($conexion->connect_error) {
    die("Error de conexión a la base de datos: " . $conexion->connect_error);
}
?>
