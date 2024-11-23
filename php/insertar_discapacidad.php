<?php
include("db.php"); // Conexión a la base de datos

// Capturar los datos del formulario para la tabla personas
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$dni = $_POST['dni'];
$nacimiento = $_POST['nacimiento'];
$contacto = !empty($_POST['contacto']) ? $_POST['contacto'] : NULL;
$domicilio = $_POST['domicilio'];
$zona_id = $_POST['zona'];
$tipo_tenencia = $_POST['tipo_tenencia'];
$procedencia_agua = $_POST['procedencia_agua'];
$cantidad_camas = $_POST['cantidad_camas'];
$ventilacion = $_POST['ventilacion'];
$iluminacion = $_POST['iluminacion'];
$higiene = $_POST['higiene'];
$orden = $_POST['orden'];
$existencia_sanitaria = $_POST['existencia_sanitaria'];
$letrina = $_POST['letrina'];
$barreras_arquitectonicas = $_POST['barreras_arquitectonicas'];
$cobertura = $_POST['cobertura'];
$cud = $_POST['cud'];
$lugar_atencion = $_POST['lugar_atencion'];
$necesita_asistencia = $_POST['necesita_asistencia'];
$quien_brinda_asistencia = $_POST['quien_brinda_asistencia'];
$cobra_pension = $_POST['cobra_pension'];
$tipo_pension = !empty($_POST['tipo_pension']) ? $_POST['tipo_pension'] : NULL;
$miembros_grupo_familiar = $_POST['miembros_grupo_familiar'];
$cantidad_ambientes = $_POST['cantidad_ambientes'];
$numero_confort = $_POST['numero_confort'];
$numero_discapacidades = $_POST['numero_discapacidades'];
$observacion_salud = !empty($_POST['observacion_salud']) ? $_POST['observacion_salud'] : NULL;
$observacion_vivienda = !empty($_POST['observacion_vivienda']) ? $_POST['observacion_vivienda'] : NULL;
$observacion_datos_personales = !empty($_POST['observacion_datos_personales']) ? $_POST['observacion_datos_personales'] : NULL;
$fecha_formulario = $_POST['fecha_formulario'];

// Verificar si el DNI ya existe en la base de datos
$sql_verificar_dni = "SELECT id FROM personas WHERE dni = ?";
$stmt_verificar_dni = $conexion->prepare($sql_verificar_dni);
$stmt_verificar_dni->bind_param("s", $dni);
$stmt_verificar_dni->execute();
$stmt_verificar_dni->store_result();

if ($stmt_verificar_dni->num_rows > 0) {
    // Si el DNI ya existe, mostrar un mensaje de error y detener el proceso
    echo "<script>
            alert('DNI ya ingresado. Por favor, verifica los datos.');
            window.history.back(); // Regresa al formulario anterior
        </script>";
} else {
    // Inserción en la tabla personas si el DNI no existe
    $sql_persona = "INSERT INTO personas (nombre, apellido, dni, nacimiento, contacto, domicilio, zona, tipo_tenencia, procedencia_agua, cantidad_camas, ventilacion, iluminacion, higiene, orden, existencia_sanitaria, letrina, barreras_arquitectonicas, cobertura, cud, lugar_atencion, necesita_asistencia, quien_brinda_asistencia, cobra_pension, tipo_pension, observacion_salud, observacion_vivienda, observacion_datos_personales, miembros_grupo_familiar, cantidad_ambientes, numero_confort, numero_discapacidades, fecha_formulario)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt_persona = $conexion->prepare($sql_persona);
    if ($stmt_persona === false) {
        die("Error al preparar la consulta: " . $conexion->error);
    }
    
    $stmt_persona->bind_param("ssisssissiiiiiisiiisisissssiiiis", 
        $nombre, $apellido, $dni, $nacimiento, $contacto, $domicilio, $zona_id, $tipo_tenencia, $procedencia_agua, 
        $cantidad_camas, $ventilacion, $iluminacion, $higiene, $orden, $existencia_sanitaria, $letrina, 
        $barreras_arquitectonicas, $cobertura, $cud, $lugar_atencion, $necesita_asistencia, 
        $quien_brinda_asistencia, $cobra_pension, $tipo_pension, $observacion_salud, $observacion_vivienda, 
        $observacion_datos_personales, $miembros_grupo_familiar, $cantidad_ambientes, $numero_confort, $numero_discapacidades, $fecha_formulario);

    // Recibimos el número de miembros del grupo familiar
    $miembros_grupo_familiar = $_POST['miembros_grupo_familiar'];

    if ($stmt_persona->execute()) {
        $persona_id = $conexion->insert_id; // Obtener el ID de la persona insertada

        // Ahora insertamos en las otras tablas relacionadas, utilizando $persona_id
        // Insertar datos en la tabla grupo_familiar
        $sql_grupo_familiar = "INSERT INTO grupo_familiar (persona_id, quien, nacimiento, escolaridad, trabajo, donde) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt_grupo_familiar = $conexion->prepare($sql_grupo_familiar);

        // Recorremos los datos de cada miembro del grupo familiar y los insertamos
        for ($i = 1; $i <= $miembros_grupo_familiar; $i++) {
            $quien = $_POST["quien_$i"];
            $nacimiento = $_POST["nacimiento_$i"];
            $escolaridad = $_POST["escolaridad_$i"];
            $trabajo = $_POST["trabajo_$i"];  // Este valor será 1 o 0 según lo seleccionado en el formulario
            $donde = $_POST["donde_$i"];

            // Asociamos los valores a los placeholders
            $stmt_grupo_familiar->bind_param("isssss", $persona_id, $quien, $nacimiento, $escolaridad, $trabajo, $donde);

            // Ejecutamos la consulta para cada miembro
            if (!$stmt_grupo_familiar->execute()) {
                echo "Error al insertar el miembro $i: " . $stmt_grupo_familiar->error;
            }
        }

        // Insertar datos en la tabla piso
        if (isset($_POST['piso']) && is_array($_POST['piso'])) {
            $pisoArray = $_POST['piso'];
            $sql_piso = "INSERT INTO piso (persona_id, tipo_piso) VALUES (?, ?)";
            $stmt_piso = $conexion->prepare($sql_piso);
        
            foreach ($pisoArray as $tipo_piso) {
                $stmt_piso->bind_param("is", $persona_id, $tipo_piso);
                $stmt_piso->execute();
            }
        }
        
        // Insertar datos en la tabla techo
        if (isset($_POST['techo']) && is_array($_POST['techo'])) {
            $techoArray = $_POST['techo'];
            $sql_techo = "INSERT INTO techo (persona_id, tipo_techo) VALUES (?, ?)";
            $stmt_techo = $conexion->prepare($sql_techo);
        
            foreach ($techoArray as $tipo_techo) {
                $stmt_techo->bind_param("is", $persona_id, $tipo_techo);
                $stmt_techo->execute();
            }
        }
        
        // Insertar datos en la tabla pared
        if (isset($_POST['pared']) && is_array($_POST['pared'])) {
            $paredArray = $_POST['pared'];
            $sql_pared = "INSERT INTO pared (persona_id, tipo_pared) VALUES (?, ?)";
            $stmt_pared = $conexion->prepare($sql_pared);
        
            foreach ($paredArray as $tipo_pared) {
                $stmt_pared->bind_param("is", $persona_id, $tipo_pared);
                $stmt_pared->execute();
            }
        }

        // Insertar datos en la tabla uso_ambiente
        if (isset($_POST['uso_ambiente']) && is_array($_POST['uso_ambiente'])) {
            $uso_ambiente = $_POST['uso_ambiente'];
            $sql_uso_ambiente = "INSERT INTO uso_ambiente (persona_id, uso) VALUES (?, ?)";
            $stmt_uso_ambiente = $conexion->prepare($sql_uso_ambiente); // Cambiado para usar la consulta SQL
        
            if ($stmt_uso_ambiente === false) {
                die("Error al preparar la consulta: " . $conexion->error);
            }
        
            foreach ($uso_ambiente as $uso) {
                $stmt_uso_ambiente->bind_param("is", $persona_id, $uso);
                $stmt_uso_ambiente->execute();
            }
        }


        // Insertar datos en la tabla elementos_confort
        if (isset($_POST['elementos_confort']) && is_array($_POST['elementos_confort'])) {
            $elementos_confort = $_POST['elementos_confort'];
            $sql_confort = "INSERT INTO elementos_confort (persona_id, elemento) VALUES (?, ?)";
            $stmt_confort = $conexion->prepare($sql_confort);
        
            if ($stmt_confort === false) {
                die("Error al preparar la consulta: " . $conexion->error);
            }
        
            // Recorrer los elementos de confort seleccionados y ejecutar la inserción
            foreach ($elementos_confort as $elemento) {
                if (!empty($elemento)) { // Verificar que el valor no esté vacío
                    $stmt_confort->bind_param("is", $persona_id, $elemento);
                    $stmt_confort->execute();
                }
            }
        }
    

        // Insertar datos en la tabla discapacidades
        if (isset($_POST['tipo_discapacidad']) && is_array($_POST['tipo_discapacidad']) && !empty($_POST['tipo_discapacidad']) &&
            isset($_POST['discapacidad']) && is_array($_POST['discapacidad']) && !empty($_POST['discapacidad'])) {
            
            // Asegúrate de que ambas matrices tengan la misma longitud
            $cantidad = count($_POST['tipo_discapacidad']);
            if ($cantidad === count($_POST['discapacidad'])) {
                $sql_discapacidad = "INSERT INTO discapacidades (persona_id, tipo_discapacidad, discapacidad) VALUES (?, ?, ?)";
                $stmt_discapacidad = $conexion->prepare($sql_discapacidad);
            
                if ($stmt_discapacidad === false) {
                    die("Error al preparar la consulta: " . $conexion->error);
                }
            
                for ($i = 0; $i < $cantidad; $i++) {
                    $tipo = $_POST['tipo_discapacidad'][$i];
                    $discapacidad = $_POST['discapacidad'][$i];

                    if (!empty($tipo) && !empty($discapacidad)) { // Verificar que ambos valores no estén vacíos
                        $stmt_discapacidad->bind_param("iis", $persona_id, $tipo, $discapacidad);
                        $stmt_discapacidad->execute();
                    }
                }
            }
        }
    } 

    header("Location: ../index.php"); // Redireccionar a la página de agradecimiento
    exit();
} 

$conexion->close();
?>
