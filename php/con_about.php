<?php
// Incluir el archivo de conexión a la base de datos
include("db.php");

// Consulta para obtener el registro con id = 5 (Misión)
$query_id_5 = "SELECT id, titulo, descripcion FROM home WHERE id = 5";
$result_id_5 = $conexion->query($query_id_5);
// Verifica si la consulta devolvió resultados
if ($result_id_5 && $result_id_5->num_rows > 0) {
    $row_id_5 = $result_id_5->fetch_assoc();
    $titulo_id_5 = $row_id_5['titulo'];
    $descripcion_id_5 = $row_id_5['descripcion']; 
} else {
    echo "No se encontraron datos para el id 5.";
}

// Consulta para obtener el registro con id = 6 (Correo e Instagram)
$query_id_6 = "SELECT id, titulo, descripcion FROM home WHERE id = 6";
$result_id_6 = $conexion->query($query_id_6);
// Verifica si la consulta devolvió resultados
if ($result_id_6 && $result_id_6->num_rows > 0) {
    $row_id_6 = $result_id_6->fetch_assoc();
    $titulo_id_6 = $row_id_6['titulo'];
    $descripcion_id_6 = $row_id_6['descripcion']; 
} else {
    echo "No se encontraron datos para el id 6.";
}

// Consulta para obtener el registro con id = 7 (Teléfono, Dirección, Imagen)
$query_id_7 = "SELECT id, titulo, descripcion, imgurl FROM home WHERE id = 7";
$result_id_7 = $conexion->query($query_id_7);
// Verifica si la consulta devolvió resultados
if ($result_id_7 && $result_id_7->num_rows > 0) {
    $row_id_7 = $result_id_7->fetch_assoc();
    $titulo_id_7 = $row_id_7['titulo'];
    $descripcion_id_7 = $row_id_7['descripcion']; 
    $imgurl_id_7 = $row_id_7['imgurl']; 
} else {
    echo "No se encontraron datos para el id 7.";
}

// Verificar si se recibieron los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los valores enviados por el formulario
    $id_noticia = $_POST['id_noticia'];
    $titulo = isset($_POST['titulo']) ? $_POST['titulo'] : '';
    $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : '';
    $correo = isset($_POST['correo']) ? $_POST['correo'] : '';
    $instagram = isset($_POST['instagram']) ? $_POST['instagram'] : '';
    $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : '';
    $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : '';
    $imgurl = isset($_POST['imgurl']) ? $_POST['imgurl'] : '';

    // Realizar las actualizaciones dependiendo del id_noticia
    if ($id_noticia == 'mision') {
        // Actualizar la sección Misión (id=5)
        $query_update = "UPDATE home SET titulo = ?, descripcion = ? WHERE id = 5";
        $stmt = $conexion->prepare($query_update);
        if ($stmt === false) {
            die('Error al preparar la consulta: ' . $conexion->error);
        }
        $stmt->bind_param("ss", $titulo, $descripcion);
        $stmt->execute();
        // Verificar si se realizó la actualización
        if ($stmt->affected_rows > 0) {
            echo "<script>
                    window.location.href = '../about.php';
                </script>";
        }
        // Cerrar la conexión después de usarla
        $stmt->close();

    } elseif ($id_noticia == 'contacto') {
        // Actualizar la sección Contacto (id=6) - Correo e Instagram
        if ($correo !== '' && $instagram !== '') {
            $query_update_contacto = "UPDATE home SET titulo = ?, descripcion = ? WHERE id = 6";
            $stmt_contacto = $conexion->prepare($query_update_contacto);
            if ($stmt_contacto === false) {
                die('Error al preparar la consulta de contacto: ' . $conexion->error);
            }
            $stmt_contacto->bind_param("ss", $correo, $instagram);
            $stmt_contacto->execute();
            if ($stmt_contacto->affected_rows > 0) {
                echo "<script>
                    window.location.href = '../about.php';
                </script>";
            }
            $stmt_contacto->close();
        }

        // Actualizar la sección Contacto (id=7) - Teléfono, Dirección e Imagen
        if ($telefono !== '' && $direccion !== '' && $imgurl !== '') {
            $query_update_informacion = "UPDATE home SET titulo = ?, descripcion = ?, imgurl = ? WHERE id = 7";
            $stmt_informacion = $conexion->prepare($query_update_informacion);
            if ($stmt_informacion === false) {
                die('Error al preparar la consulta de información: ' . $conexion->error);
            }
            $stmt_informacion->bind_param("sss", $telefono, $direccion, $imgurl);
            $stmt_informacion->execute();
            if ($stmt_informacion->affected_rows > 0) {
                echo "<script>
                    window.location.href = '../about.php';
                </script>";
            }
            $stmt_informacion->close();
        }
    }

    // Cerrar la conexión al final
    $conexion->close();
}
?>
