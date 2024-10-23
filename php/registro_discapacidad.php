<?php
include("db.php"); // Asegúrate de tener tu archivo de conexión a la base de datos

// Función para sanitizar entradas
function sanitize_input($data) {
    // Elimina caracteres no deseados
    $data = str_replace(array('<', '>', '&'), '', $data);
    return $data;
}

// Capturar los datos del formulario y sanitizarlos
$nombre = sanitize_input(trim($_POST['nombre']));
$apellido = sanitize_input(trim($_POST['apellido']));
$direccion = sanitize_input(trim($_POST['direccion']));
$telefono = !empty($_POST['telefono']) ? sanitize_input(trim($_POST['telefono'])) : NULL;
$correo = !empty($_POST['correo']) ? filter_var(trim($_POST['correo']), FILTER_SANITIZE_EMAIL) : NULL;
$dni = sanitize_input(trim($_POST['dni'])); // Sanitizar el DNI

// Verificar si el campo certificado_discapacidad está definido y establecer el valor
$certificado_discapacidad = (isset($_POST['certificado_discapacidad']) && $_POST['certificado_discapacidad'] == 'Si') ? 1 : 0;

// Verificar si ya existe un registro con el mismo DNI
$sql_check = "SELECT COUNT(*) FROM registro_discapacidad WHERE dni = ?";
$stmt_check = $conexion->prepare($sql_check);
$stmt_check->bind_param("s", $dni);
$stmt_check->execute();
$stmt_check->bind_result($count);
$stmt_check->fetch();
$stmt_check->close();

if ($count > 0) {
    // Si el DNI ya existe, mostrar un mensaje de error
    echo "<script>
            alert('DNI ya ingresado. Por favor, verifica los datos.');
            window.history.back(); // Regresa al formulario anterior
          </script>";
} else {
    // Verificar si hay una persona con discapacidad
    if (isset($_POST['persona_discapacidad']) && $_POST['persona_discapacidad'] === 'Si') {
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
                $quien_es[] = sanitize_input(trim($_POST['otros_parentesco'])); // Se añade el valor ingresado
            }
        }

        // Convertimos la lista de quienes a un string
        $quienes = implode(", ", $quien_es); // Une los valores con coma

        // Preparar la consulta SQL
        $sql = "INSERT INTO registro_discapacidad (nombre, apellido, dni, direccion, telefono, correo_electronico, certificado_discapacidad, quienes, fecha_registro) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, CURDATE())";

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
}

// Cerrar la conexión solo si se creó la consulta
if (isset($stmt)) {
    $stmt->close();
}

// Cerrar la conexión
$conexion->close();
?>
