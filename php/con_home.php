<?php
// Incluir el archivo de conexión a la base de datos
include("db.php");

// Consulta para obtener el registro con id 1
$query_id_1 = "SELECT titulo, descripcion, imgurl FROM home WHERE id = 1";
$result_id_1 = $conexion->query($query_id_1);

if ($result_id_1->num_rows > 0) {
    $registro_id_1 = $result_id_1->fetch_assoc();
} else {
    $registro_id_1 = null; // Establecer a null si no se encontró el registro
}

// Consulta para obtener los registros con id mayores a 1 (los otros 3 registros)
$query_otros = "SELECT titulo, descripcion, imgurl FROM home WHERE id > 1 LIMIT 3";
$result_otros = $conexion->query($query_otros);

// Cierra la conexión al final
$conexion->close();
?>
