<?php
include("db.php"); // Conexión a la base de datos

// Capturar los datos del formulario para la tabla personas
$persona_id  = $_POST['id']; // ID de la persona a actualizar
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
$letrina = !empty($_POST['letrina']) ? $_POST['letrina'] : NULL;
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


// Actualizar los datos en la tabla `personas`
$sql_persona = "UPDATE personas SET 
    nombre = ?, apellido = ?, dni = ?, nacimiento = ?, contacto = ?, domicilio = ?, zona = ?, 
    tipo_tenencia = ?, procedencia_agua = ?, cantidad_camas = ?, ventilacion = ?, iluminacion = ?, 
    higiene = ?, orden = ?, existencia_sanitaria = ?, letrina = ?, barreras_arquitectonicas = ?, 
    cobertura = ?, cud = ?, lugar_atencion = ?, necesita_asistencia = ?, quien_brinda_asistencia = ?, 
    cobra_pension = ?, tipo_pension = ?, observacion_salud = ?, observacion_vivienda = ?, 
    observacion_datos_personales = ?, miembros_grupo_familiar = ?, cantidad_ambientes = ?, 
    numero_confort = ?, numero_discapacidades = ?, fecha_formulario = ?
WHERE id = ?";

// Preparar y ejecutar la actualización
$stmt_persona = $conexion->prepare($sql_persona);
$stmt_persona->bind_param("ssisssissiiiiiisiiisisissssiiiisi", 
    $nombre, $apellido, $dni, $nacimiento, $contacto, $domicilio, $zona_id, $tipo_tenencia, $procedencia_agua, 
    $cantidad_camas, $ventilacion, $iluminacion, $higiene, $orden, $existencia_sanitaria, $letrina, 
    $barreras_arquitectonicas, $cobertura, $cud, $lugar_atencion, $necesita_asistencia, 
    $quien_brinda_asistencia, $cobra_pension, $tipo_pension, $observacion_salud, $observacion_vivienda, 
    $observacion_datos_personales, $miembros_grupo_familiar, $cantidad_ambientes, $numero_confort, $numero_discapacidades, $fecha_formulario, $persona_id);

// Ejecutar la actualización de persona
if (!$stmt_persona->execute()) {
    echo "Error al actualizar los datos de la persona: " . $stmt_persona->error;
    exit();
}

// Primero eliminar los registros existentes para el grupo_familiar (solo una vez)
$sql_delete_grupo_familiar = "DELETE FROM grupo_familiar WHERE persona_id = ?";
$stmt_delete_grupo_familiar = $conexion->prepare($sql_delete_grupo_familiar);
$stmt_delete_grupo_familiar->bind_param("i", $persona_id);  // Solo pasamos persona_id
$stmt_delete_grupo_familiar->execute();

// Ahora insertar los nuevos registros para el grupo familiar (dentro del ciclo)
for ($i = 1; $i <= $miembros_grupo_familiar; $i++) {
    $quien = $_POST["quien_$i"];
    $nacimiento = $_POST["nacimiento_$i"];
    $escolaridad = $_POST["escolaridad_$i"];
    $trabajo = $_POST["trabajo_$i"]; 
    $donde = $_POST["donde_$i"];
    
    // Insertar los nuevos registros con persona_id
    $sql_insert_grupo_familiar = "INSERT INTO grupo_familiar (persona_id, quien, nacimiento, escolaridad, trabajo, donde) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt_insert_grupo_familiar = $conexion->prepare($sql_insert_grupo_familiar);
    $stmt_insert_grupo_familiar->bind_param("isssss", $persona_id, $quien, $nacimiento, $escolaridad, $trabajo, $donde);
    $stmt_insert_grupo_familiar->execute();
}


// Actualizar las tablas de piso, techo, pared, uso_ambiente y elementos_confort

// Eliminar y actualizar para 'piso'
if (isset($_POST['piso']) && is_array($_POST['piso'])) {
    $pisoArray = $_POST['piso'];
    
    // Eliminar los registros anteriores
    $sql_delete_piso = "DELETE FROM piso WHERE persona_id = ?";
    $stmt_delete_piso = $conexion->prepare($sql_delete_piso);
    $stmt_delete_piso->bind_param("i", $persona_id);
    $stmt_delete_piso->execute();
    
    // Insertar los nuevos registros
    $sql_insert_piso = "INSERT INTO piso (persona_id, tipo_piso) VALUES (?, ?)";
    $stmt_insert_piso = $conexion->prepare($sql_insert_piso);
    
    foreach ($pisoArray as $tipo_piso) {
        $stmt_insert_piso->bind_param("is", $persona_id, $tipo_piso);
        $stmt_insert_piso->execute();
    }
}

// Eliminar y actualizar para 'techo'
if (isset($_POST['techo']) && is_array($_POST['techo'])) {
    $techoArray = $_POST['techo'];
    
    // Eliminar los registros anteriores
    $sql_delete_techo = "DELETE FROM techo WHERE persona_id = ?";
    $stmt_delete_techo = $conexion->prepare($sql_delete_techo);
    $stmt_delete_techo->bind_param("i", $persona_id);
    $stmt_delete_techo->execute();
    
    // Insertar los nuevos registros
    $sql_insert_techo = "INSERT INTO techo (persona_id, tipo_techo) VALUES (?, ?)";
    $stmt_insert_techo = $conexion->prepare($sql_insert_techo);
    
    foreach ($techoArray as $tipo_techo) {
        $stmt_insert_techo->bind_param("is", $persona_id, $tipo_techo);
        $stmt_insert_techo->execute();
    }
}

// Eliminar y actualizar para 'pared'
if (isset($_POST['pared']) && is_array($_POST['pared'])) {
    $paredArray = $_POST['pared'];
    
    // Eliminar los registros anteriores
    $sql_delete_pared = "DELETE FROM pared WHERE persona_id = ?";
    $stmt_delete_pared = $conexion->prepare($sql_delete_pared);
    $stmt_delete_pared->bind_param("i", $persona_id);
    $stmt_delete_pared->execute();
    
    // Insertar los nuevos registros
    $sql_insert_pared = "INSERT INTO pared (persona_id, tipo_pared) VALUES (?, ?)";
    $stmt_insert_pared = $conexion->prepare($sql_insert_pared);
    
    foreach ($paredArray as $tipo_pared) {
        $stmt_insert_pared->bind_param("is", $persona_id, $tipo_pared);
        $stmt_insert_pared->execute();
    }
}

// Eliminar y actualizar para 'uso_ambiente'
if (isset($_POST['uso_ambiente']) && is_array($_POST['uso_ambiente'])) {
    $uso_ambiente = $_POST['uso_ambiente'];
    
    // Eliminar los registros anteriores
    $sql_delete_uso_ambiente = "DELETE FROM uso_ambiente WHERE persona_id = ?";
    $stmt_delete_uso_ambiente = $conexion->prepare($sql_delete_uso_ambiente);
    $stmt_delete_uso_ambiente->bind_param("i", $persona_id);
    $stmt_delete_uso_ambiente->execute();
    
    // Insertar los nuevos registros
    $sql_insert_uso_ambiente = "INSERT INTO uso_ambiente (persona_id, uso) VALUES (?, ?)";
    $stmt_insert_uso_ambiente = $conexion->prepare($sql_insert_uso_ambiente);
    
    foreach ($uso_ambiente as $uso) {
        $stmt_insert_uso_ambiente->bind_param("is", $persona_id, $uso);
        $stmt_insert_uso_ambiente->execute();
    }
}

// Eliminar y actualizar para 'elementos_confort'
if (isset($_POST['elementos_confort']) && is_array($_POST['elementos_confort'])) {
    $elementos_confort = $_POST['elementos_confort'];
    
    // Eliminar los registros anteriores
    $sql_delete_confort = "DELETE FROM elementos_confort WHERE persona_id = ?";
    $stmt_delete_confort = $conexion->prepare($sql_delete_confort);
    $stmt_delete_confort->bind_param("i", $persona_id);
    $stmt_delete_confort->execute();
    
    // Insertar los nuevos registros
    $sql_insert_confort = "INSERT INTO elementos_confort (persona_id, elemento) VALUES (?, ?)";
    $stmt_insert_confort = $conexion->prepare($sql_insert_confort);
    
    foreach ($elementos_confort as $elemento) {
        if (!empty($elemento)) {
            $stmt_insert_confort->bind_param("is", $persona_id, $elemento);
            $stmt_insert_confort->execute();
        }
    }
}

// Primero eliminar los registros existentes para la persona
if (isset($_POST['tipo_discapacidad']) && is_array($_POST['tipo_discapacidad']) && !empty($_POST['tipo_discapacidad']) &&
    isset($_POST['discapacidad']) && is_array($_POST['discapacidad']) && !empty($_POST['discapacidad'])) {

    // Asegúrate de que ambas matrices tengan la misma longitud
    $cantidad = count($_POST['tipo_discapacidad']);
    if ($cantidad === count($_POST['discapacidad'])) {
        
        // Eliminar los registros de discapacidades previos para la persona
        $sql_delete = "DELETE FROM discapacidades WHERE persona_id = ?";
        $stmt_delete = $conexion->prepare($sql_delete);
        
        if ($stmt_delete === false) {
            die("Error al preparar la consulta de eliminación: " . $conexion->error);
        }

        // Eliminar los registros antes de insertar los nuevos
        $stmt_delete->bind_param("i", $persona_id);
        $stmt_delete->execute();

        // Ahora insertar los nuevos registros
        $sql_insert = "INSERT INTO discapacidades (persona_id, tipo_discapacidad, discapacidad) VALUES (?, ?, ?)";
        $stmt_insert = $conexion->prepare($sql_insert);

        if ($stmt_insert === false) {
            die("Error al preparar la consulta de inserción: " . $conexion->error);
        }

        // Insertar cada uno de los nuevos registros
        for ($i = 0; $i < $cantidad; $i++) {
            $tipo = $_POST['tipo_discapacidad'][$i];
            $discapacidad = $_POST['discapacidad'][$i];

            if (!empty($tipo) && !empty($discapacidad)) { // Verificar que ambos valores no estén vacíos
                $stmt_insert->bind_param("iis", $persona_id, $tipo, $discapacidad);
                $stmt_insert->execute();
            }
        }
    }
}

// Manejar la eliminación del registro
if (isset($_POST['eliminar_registro'])) {
    $id = intval($_POST['id']);

    $delete_query = "DELETE FROM personas WHERE id = ?";
    $stmt = $conexion->prepare($delete_query);
    $stmt->bind_param("i", $id);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "<script>window.location.href='../tabla_formulario.php';</script>";
    } else {
        echo "Error al eliminar el registro: " . $stmt->error;
    }

    // Cerrar la declaración
    $stmt->close();
}

echo "<script>window.location.href='../tabla_formulario.php';</script>";


$conexion->close();

?>