<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("db.php");

// Leer el cuerpo de la solicitud como JSON
$data = json_decode(file_get_contents("php://input"), true);

// Validar que los datos sean correctos
if (isset($data['id']) && isset($data['visitado'])) {
    $id = intval($data['id']); // Asegurar que sea un número entero
    $visitado = intval($data['visitado']); // Asegurar que sea un número entero (0 o 1)

    // Prepara la consulta
    $query = "UPDATE registro_discapacidad SET visitado = ? WHERE id = ?";
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, "ii", $visitado, $id);

    // Ejecuta la consulta y responde con JSON
    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => mysqli_error($conexion)]);
    }

    mysqli_stmt_close($stmt);
} else {
    echo json_encode(["success" => false, "message" => "Datos inválidos"]);
}

mysqli_close($conexion);
