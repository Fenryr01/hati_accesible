<?php
// Incluir el archivo de conexión a la base de datos
include("db.php");

// Consulta para obtener el registro con id 1 (el banner)
$query_id_1 = "SELECT id, titulo, descripcion, imgurl FROM home WHERE id = 1";
$result_id_1 = $conexion->query($query_id_1);

$registro_id_1 = $result_id_1->fetch_assoc() ?: ['id' => null, 'titulo' => '', 'descripcion' => '', 'imgurl' => ''];

// Consulta para obtener los registros con id mayores a 1 (las otras noticias)
$query_otros = "SELECT id, titulo, descripcion, imgurl FROM home WHERE id > 1 LIMIT 3";
$result_otros = $conexion->query($query_otros);

// Verificar si se enviaron los datos del formulario para actualizar un registro
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id_noticia'];
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $imgurl = $_POST['imgurl'];

    // Consulta para actualizar el registro con el ID proporcionado
    $query = "UPDATE home SET titulo = '$titulo', descripcion = '$descripcion', imgurl = '$imgurl' WHERE id = $id";
    if ($conexion->query($query) === TRUE) {
        echo "<script>
                window.location.href = '../index.php';
            </script>";
    } else {
        echo "<script>
            alert('Error al actualizar: " . $conexion->error . "');
            window.location.href = 'index.php';
        </script>";
    }
}

// Cierra la conexión al final
$conexion->close();
?>
