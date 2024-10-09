<?php
include("db.php"); // Asegúrate de tener tu archivo de conexión a la base de datos

// Capturar los datos del formulario
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$direccion = $_POST['direccion']; // Este campo debe ser obligatorio
$telefono = !empty($_POST['telefono']) ? $_POST['telefono'] : NULL; // Campo opcional
$correo = !empty($_POST['correo']) ? $_POST['correo'] : NULL; // Campo opcional
$dni = $_POST['dni']; // Capturamos el DNI

// Verificar si el campo certificado_discapacidad está definido y establecer el valor
$certificado_discapacidad = (isset($_POST['certificado_discapacidad']) && $_POST['certificado_discapacidad'] == 'Sí') ? 1 : 0;

// Verificar si hay una persona con discapacidad
if (isset($_POST['persona_discapacidad']) && $_POST['persona_discapacidad'] === 'Sí') {
    // Inicializamos la variable $quienes
    $quienes = '';

    // Capturamos los valores de las personas con discapacidad
    $quien_es = isset($_POST['quien_es']) ? $_POST['quien_es'] : []; // Esta es la matriz de checkboxes

    // Manejar el caso de "Otros"
    if (in_array("Otros", $quien_es)) {
        if (empty($_POST['otros_parentesco'])) {
            die("El campo 'Especificar parentesco' no puede estar vacío."); // Detiene la ejecución si está vacío
        } else {
            // Solo se añade el valor ingresado y no "Otros"
            $quien_es = array_diff($quien_es, ["Otros"]); // Elimina "Otros" del array
            $quien_es[] = $_POST['otros_parentesco']; // Se añade el valor ingresado
        }
    }

    // Convertimos la lista de quienes a un string
    $quienes = implode(", ", $quien_es); // Une los valores con coma

    // Preparar la consulta SQL
    $sql = "INSERT INTO registro_discapacidad (nombre, apellido, dni, direccion, telefono, correo_electronico, certificado_discapacidad, quienes) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssssssss", $nombre, $apellido, $dni, $direccion, $telefono, $correo, $certificado_discapacidad, $quienes);
    
    // Ejecutar la consulta
    if ($stmt->execute()) {
        // Mensaje de éxito y redirección
        echo "<script>
                alert('Gracias por registrarse.');
                window.location.href = '../index.php';
              </script>";
    } else {
        echo "Error al guardar el registro: " . $stmt->error;
    }
} else {
    // Si no hay persona con discapacidad, solo mostramos el mensaje de agradecimiento
    echo "<script>
            alert('Gracias por registrarse.');
            window.location.href = '../index.php';
          </script>";
}

// Cerrar la conexión solo si se creó la consulta
if (isset($stmt)) {
    $stmt->close();
}

// Cerrar la conexión
$conexion->close();


?>
