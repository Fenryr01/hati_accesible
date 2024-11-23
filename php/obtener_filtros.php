<?php
include("db.php");

// Consulta para obtener las zonas
$zonaQuery = "SELECT id, zona FROM zonas";
$zonaResultado = mysqli_query($conexion, $zonaQuery);

if (!$zonaResultado) {
    echo json_encode(['error' => mysqli_error($conexion)]);
    exit;
}

$zonas = [];
while ($filaZona = mysqli_fetch_assoc($zonaResultado)) {
    $zonas[] = $filaZona;
}
mysqli_free_result($zonaResultado);

// Consulta para obtener los tipos de discapacidad
$discapacidadQuery = "SELECT id, cual_discapacidad FROM que_discapacidad";
$discapacidadResultado = mysqli_query($conexion, $discapacidadQuery);

if (!$discapacidadResultado) {
    echo json_encode(['error' => mysqli_error($conexion)]);
    exit;
}

$tiposDiscapacidad = [];
while ($filaDiscapacidad = mysqli_fetch_assoc($discapacidadResultado)) {
    $tiposDiscapacidad[] = [
        'id' => $filaDiscapacidad['id'],
        'discapacidad' => $filaDiscapacidad['cual_discapacidad']
    ];
    
}
mysqli_free_result($discapacidadResultado);

// Consulta para obtener los valores de la tabla 'valores'
$valoresQuery = "SELECT id, valor FROM valores"; // Ajusta los nombres de las columnas según tu tabla
$valoresResultado = mysqli_query($conexion, $valoresQuery);

if (!$valoresResultado) {
    echo json_encode(['error' => mysqli_error($conexion)]);
    exit;
}

$valores = [];
while ($filaValores = mysqli_fetch_assoc($valoresResultado)) {
    $valores[] = [
        'id' => $filaValores['id'],
        'valor' => $filaValores['valor'],
    ];
}
mysqli_free_result($valoresResultado);

// Consulta para obtener los años disponibles (en orden ascendente)
$años_query = "SELECT DISTINCT YEAR(fecha_formulario) AS año FROM personas ORDER BY año ASC";
$años_resultado = mysqli_query($conexion, $años_query);
$años_disponibles = [];
while ($año = mysqli_fetch_assoc($años_resultado)) {
    $años_disponibles[] = $año['año'];
}
mysqli_free_result($años_resultado);

// Devolver los resultados en formato JSON
header('Content-Type: application/json');
echo json_encode([
    'zonas' => $zonas,
    'tipos_discapacidad' => $tiposDiscapacidad,
    'valores' => $valores,
    'años_disponibles' => $años_disponibles,
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
?>
