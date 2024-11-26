<?php
// Incluir el archivo de conexión a la base de datos
include("db.php");

// Consulta para obtener el registro con id = 5
$query_id_5 = "SELECT id, titulo, descripcion, imgurl FROM home WHERE id = 5";
$result_id_5 = $conexion->query($query_id_5);

// Verificar si se obtuvo un resultado válido
if ($result_id_5 && $result_id_5->num_rows > 0) {
    $registro_id_5 = $result_id_5->fetch_assoc();
} else {
    $registro_id_5 = ['id' => null, 'titulo' => '', 'descripcion' => '', 'imgurl' => ''];
}

// Consulta para obtener los registros con id mayores a 5 (otros registros opcionales)
$query_otros = "SELECT id, titulo, descripcion, imgurl FROM home WHERE id > 5 LIMIT 3";
$result_otros = $conexion->query($query_otros);

// Verificar si se enviaron los datos del formulario para actualizar un registro
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = intval($_POST['id_noticia']); // Convertir a entero para mayor seguridad
    $titulo = $conexion->real_escape_string($_POST['titulo']); // Escapar entrada del usuario
    $descripcion = $conexion->real_escape_string($_POST['descripcion']); // Escapar entrada del usuario
    $imgurl = $conexion->real_escape_string($_POST['imgurl']); // Escapar entrada del usuario

    // Consulta para actualizar el registro con el ID proporcionado
    $query_update = "UPDATE home SET titulo = '$titulo', descripcion = '$descripcion', imgurl = '$imgurl' WHERE id = $id";
    if ($conexion->query($query_update) === TRUE) {
        echo "<script>
                window.location.href = '../about.php';
            </script>";
    } else {
        echo "<script>
                alert('Error al actualizar: " . $conexion->error . "');
                window.location.href = 'about.php';
            </script>";
    }
}

// Cierra la conexión al final
$conexion->close();
?>
