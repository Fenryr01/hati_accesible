<?php
// Conexión a la base de datos
include("db.php"); // Asegúrate de que esta conexión funcione

// TIPO DISCAPACIDAD
$sql_tipos_discapacidad = "SELECT id, cual_discapacidad FROM que_discapacidad"; 
$resultado_tipos_discapacidad = $conexion->query($sql_tipos_discapacidad);


if (!$resultado_tipos_discapacidad) {
    die("Error en la consulta: " . $conexion->error);
}


$tipos_discapacidad = [];
while ($tipo = $resultado_tipos_discapacidad->fetch_assoc()) {
    $tipos_discapacidad[] = $tipo; // Agregar cada tipo al array
}

// ELEMENTOS CONFOR
$sql_elementos_confort = "SELECT id, cual_elemento FROM que_elemento"; 
$resultado_elementos_confort = $conexion->query($sql_elementos_confort);


if (!$resultado_elementos_confort) {
    die("Error en la consulta: " . $conexion->error);
}

// Crear un array para almacenar los elementos de confort
$elementos_confort = [];
while ($elemento = $resultado_elementos_confort->fetch_assoc()) {
    $elementos_confort[] = $elemento; // Agregar cada elemento al array
}

// ZONAS
$sql_zonas = "SELECT id, zona FROM zonas"; 
$resultado_zonas = $conexion->query($sql_zonas);


if (!$resultado_zonas) {
    die("Error en la consulta: " . $conexion->error);
}

// Crear un array para almacenar las zonas
$zonas = [];
while ($zona = $resultado_zonas->fetch_assoc()) {
    $zonas[] = $zona; // Agregar cada zona al array
}

// VALORES
$sql_valores = "SELECT id, valor FROM valores"; 
$resultado_valores = $conexion->query($sql_valores);

if (!$resultado_valores) {
    die("Error en la consulta: " . $conexion->error);
}

// Crear un array para almacenar los valores
$valores = [];
while ($valor = $resultado_valores->fetch_assoc()) {
    $valores[] = $valor; // Agregar cada valor al array
}

// JSON
header('Content-Type: application/json');
echo json_encode([
    'tipos_discapacidad' => $tipos_discapacidad,
    'elementos_confort' => $elementos_confort,
    'zonas' => $zonas,
    'valores' => $valores,
]);



// Cerrar la conexión
$conexion->close();
?>
