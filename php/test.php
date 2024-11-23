<?php
include("db.php"); // Conexión a la base de datos

$persona_id = 1; // Obtener el ID de la persona insertada

    if (isset($_POST['quien']) && is_array($_POST['quien'])) {
        // Obtener el número de integrantes
        $numero_integrantes = count($_POST['quien']);

        $sql_grupo = "INSERT INTO grupo_familiar (persona_id, quien, edad, escolaridad, trabajo, donde) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt_grupo = $conexion->prepare($sql_grupo);

        if ($stmt_grupo === false) {
            die("Error al preparar la consulta: " . $conexion->error);
        }

        for ($i = 0; $i < $numero_integrantes; $i++) {
            // Validar que todos los campos estén presentes
            if (!empty($_POST['quien'][$i]) && !empty($_POST['edad'][$i]) && !empty($_POST['escolaridad'][$i]) && isset($_POST['trabaja'][$i]) && !empty($_POST['donde'][$i])) {
                $quien = $_POST['quien'][$i]; // Obtener nombre del integrante
                $edad = $_POST['edad'][$i]; // Obtener edad
                $escolaridad = $_POST['escolaridad'][$i]; // Obtener escolaridad
                $trabajo = $_POST['trabaja'][$i]; // Obtener estado de trabajo (0 o 1)
                $donde = $_POST['donde'][$i]; // Obtener dónde trabaja

                // Insertar los datos del integrante en la tabla grupo_familiar
                $stmt_grupo->bind_param("isssis", $persona_id, $quien, $edad, $escolaridad, $trabajo, $donde);
                $stmt_grupo->execute();
            } else {
                die("Error: Todos los campos del grupo familiar son obligatorios.");
            }
        }
    } else {
        die("Error: no se recibieron datos del grupo familiar.");
    }



echo "Registro exitoso";

$conexion->close();
?>

