<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("db.php");

if (isset($_POST['id']) && isset($_POST['visitado'])) {
    $id = $_POST['id'];
    $visitado = $_POST['visitado'];

    $query = "UPDATE registro_discapacidad SET visitado = $visitado WHERE id = $id";
    if (mysqli_query($conexion, $query)) {
        echo "Actualización exitosa";
    } else {
        echo "Error al actualizar: " . mysqli_error($conexion);
    }
}

mysqli_close($conexion);
?>
