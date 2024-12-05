<?php 
// Definir el permiso requerido para esta página
$requiredPermission = 'editar_tablas';

include("navbar.php"); 

include("php/db.php"); // Incluir la conexión a la base de datos
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Inicializar variables para los datos
$nombre = $apellido = $dni = $direccion = $telefono = $correo_electronico = $certificado_discapacidad = $quienes = $visitado = "";

// Verificar si se ha pasado un ID
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = "SELECT * FROM registro_discapacidad WHERE id = $id";
    $resultado = mysqli_query($conexion, $query);

    if ($fila = mysqli_fetch_assoc($resultado)) {
        // Obtener los datos del registro
        $nombre = htmlspecialchars($fila['nombre']);
        $apellido = htmlspecialchars($fila['apellido']);
        $dni = htmlspecialchars($fila['dni']);
        $direccion = htmlspecialchars($fila['direccion']);
        $telefono = htmlspecialchars($fila['telefono'] ?? '');
        $correo_electronico = htmlspecialchars($fila['correo_electronico'] ?? '');
        $certificado_discapacidad = htmlspecialchars($fila['certificado_discapacidad']);
        // Obtener el valor de "quienes" de la base de datos
        $quienes = htmlspecialchars($fila['quienes']);
        $quienesArray = explode(", ", $quienes); // Separar los valores en un array

        // Comprobar si hay un valor que no está en las opciones predefinidas
        $opcionesPredefinidas = ['Padre/Madre', 'Hijo/a', 'Abuelo/a'];
        $otrosValor = '';

        foreach ($quienesArray as $quien) {
            if (!in_array($quien, $opcionesPredefinidas)) {
                $otrosValor = $quien; // Guardar el valor no predefinido
            }
        }

        $visitado = $fila['visitado'] ? 'checked' : '';
    } else {
        echo "No se encontraron detalles.";
        exit;
    }

    mysqli_free_result($resultado);
}

// Manejar la eliminación del registro
if (isset($_POST['eliminar_registro'])) {
    $id = intval($_POST['id']);

    $delete_query = "DELETE FROM registro_discapacidad WHERE id = ?";
    $stmt = $conexion->prepare($delete_query);
    $stmt->bind_param("i", $id);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "<script>window.location.href='tabla_registro.php';</script>";
    } else {
        echo "Error al eliminar el registro: " . $stmt->error;
    }

    // Cerrar la declaración
    $stmt->close();
}

// Manejar la actualización de datos
if (isset($_POST['guardar_cambios'])) {
    $id = intval($_POST['id']);
    $campos = [];
    $valores = [];

    // Agregar campos a actualizar solo si no están vacíos
    if (!empty($_POST['nombre'])) {
        $campos[] = "nombre = ?";
        $valores[] = $_POST['nombre'];
    }

    if (!empty($_POST['apellido'])) {
        $campos[] = "apellido = ?";
        $valores[] = $_POST['apellido'];
    }

    if (!empty($_POST['dni'])) {
        $campos[] = "dni = ?";
        $valores[] = $_POST['dni'];
    }

    if (!empty($_POST['direccion'])) {
        $campos[] = "direccion = ?";
        $valores[] = $_POST['direccion'];
    }

    if (!empty($_POST['telefono'])) {
        $campos[] = "telefono = ?";
        $valores[] = $_POST['telefono'];
    }

    if (!empty($_POST['correo_electronico'])) {
        $campos[] = "correo_electronico = ?";
        $valores[] = $_POST['correo_electronico'];
    }

    $certificado_discapacidad = isset($_POST['certificado_discapacidad']) ? $_POST['certificado_discapacidad'] : 0;
    $campos[] = "certificado_discapacidad = ?";
    $valores[] = $certificado_discapacidad;

    // Manejo de quién es la persona con discapacidad
    if (!empty($_POST['quien_es'])) {
        $quienesArray = $_POST['quien_es'];
    
        // Verificar si se seleccionó "Otros"
        if (in_array('Otros', $quienesArray) && !empty(trim($_POST['otros_parentesco']))) {
            $otrosEspecificado = trim($_POST['otros_parentesco']);
            // Añadir el valor especificado al arreglo
            $quienesArray = array_diff($quienesArray, ['Otros']); // Eliminar "Otros" para no duplicarlo
            $quienesArray[] = $otrosEspecificado; // Añadir el valor específico
        }
    
        // Concatenar los valores seleccionados para la base de datos
        $quienes = implode(", ", $quienesArray);
        $campos[] = "quienes = ?";
        $valores[] = $quienes;
    } else {
        $quienes = ''; // o algún valor por defecto
    }

    $visitado = isset($_POST['visitado']) ? 1 : 0;
    $campos[] = "visitado = ?";
    $valores[] = $visitado;

    // Solo proceder si hay campos para actualizar
    if (count($campos) > 0) {
        // Crear la consulta de actualización
        $update_query = "UPDATE registro_discapacidad SET " . implode(", ", $campos) . " WHERE id = ?";
        $valores[] = $id; // Agregar el ID al final de los valores

        // Preparar la consulta
        $stmt = $conexion->prepare($update_query);
        // Crear una cadena de tipos de datos para el bind_param
        $tipos = str_repeat("s", count($valores) - 1) . "i"; // todos string excepto el último que es int
        $stmt->bind_param($tipos, ...$valores);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "<script>window.location.href='tabla_registro.php';</script>";
        } else {
            echo "Error al actualizar los datos: " . $stmt->error;
        }

        // Cerrar la declaración
        $stmt->close();
    }
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilos.css"> 
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <title>Modificar Datos del Registro</title>
</head>
<body>
    <main class="main_general">
        <a href="tabla_registro.php" class="btn-back">
            <span class="material-icons" style="font-size: 50px;">arrow_back</span>
        </a>
        <section class="container_registro"> 

            <form class="form_registro" method="POST" action="">
                <h1>Registro de <?php echo $apellido," " , $nombre; ?> </h1>
                <div class="botones_row">
                    <?php if (isset($_SESSION['permisos']['eliminar']) && $_SESSION['permisos']['eliminar']): ?>
                        <!-- Botón para eliminar el registro -->
                        <button type="submit" name="eliminar_registro" class="btn-eliminar" onclick="return confirmarEliminacion('<?php echo $nombre; ?>', '<?php echo $apellido; ?>')">
                            <i class="material-icons" style="font-size: 30px;">delete</i>
                        </button>
                    <?php endif; ?>
                    
                    <!-- Campo Visitado -->
                    <div class="visitado_registro">
                        <p><strong>Visitado:</strong></p>
                        <label class='switch'>
                            <input type='checkbox' class='visitado-checkbox' name='visitado' <?php echo $visitado; ?>>
                            <span class='slider'></span>
                            <span class='knob'></span>
                        </label>
                    </div>
                </div>
                <!-- Campos de datos del formulario -->
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo $nombre; ?>" required>

                <label for="apellido">Apellido:</label>
                <input type="text" id="apellido" name="apellido" value="<?php echo $apellido; ?>" required>

                <label for="dni">DNI:</label>
                <input 
                    type="text" 
                    id="dni" 
                    name="dni"
                    value="<?php echo $dni; ?>"  
                    required 
                    pattern="^\d{7,9}$" 
                    title="El DNI debe tener entre 7 y 9 números." 
                >

                <label for="direccion">Dirección:</label>
                <input type="text" id="direccion" name="direccion" value="<?php echo $direccion; ?>">

                <label for="telefono">Teléfono:</label>
                <input type="text" id="telefono" name="telefono" value="<?php echo $telefono; ?>">

                <label for="correo_electronico">Correo Electrónico:</label>
                <input 
                    type="email" 
                    id="correo_electronico" 
                    name="correo_electronico" 
                    value="<?php echo $correo_electronico; ?>"
                    pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" 
                    title="Por favor, ingresa una dirección de correo válida."
                >

                <!-- Certificado de discapacidad -->
                <label for="certificado_discapacidad">¿Tiene Certificado Único de Discapacidad (CUD)?</label>
                <select id="certificado_discapacidad" name="certificado_discapacidad">
                    <option value="0" <?php echo ($certificado_discapacidad == 0) ? 'selected' : ''; ?>>No</option>
                    <option value="1" <?php echo ($certificado_discapacidad == 1) ? 'selected' : ''; ?>>Sí</option>
                </select>

                <label>¿Quién es la persona con discapacidad?</label>
                <div class="checkboxs">
                    <div class="checkbox-container">
                        <label for="quien_padre">Padre/Madre</label>
                        <input type="checkbox" name="quien_es[]" value="Padre/Madre" id="quien_padre" <?php echo (strpos($quienes, 'Padre/Madre') !== false) ? 'checked' : ''; ?>>
                    </div>
                    <div class="checkbox-container">
                        <label for="quien_hijo">Hijo/a</label>
                        <input type="checkbox" name="quien_es[]" value="Hijo/a" id="quien_hijo" <?php echo (strpos($quienes, 'Hijo/a') !== false) ? 'checked' : ''; ?>>
                    </div>
                    <div class="checkbox-container">
                        <label for="quien_abuelo">Abuelo/a</label>
                        <input type="checkbox" name="quien_es[]" value="Abuelo/a" id="quien_abuelo" <?php echo (strpos($quienes, 'Abuelo/a') !== false) ? 'checked' : ''; ?>>
                    </div>
                    <div class="checkbox-container">
                        <label for="quien_otros">Otros</label>
                        <input type="checkbox" name="quien_es[]" value="Otros" id="quien_otros" <?php echo (empty($otrosValor)) ? '' : 'checked'; ?> onclick="toggleOtrosField(this)">
                    </div>
                </div>

                <!-- Campo que se muestra solo si selecciona 'Otros' -->
                <input type="text" name="otros_parentesco" id="otros_parentesco" placeholder="Especificar parentesco" 
                style="<?php echo (empty($otrosValor)) ? 'display:none;' : 'display:block;'; ?>" 
                value="<?php echo htmlspecialchars($otrosValor); ?>">

                <!-- Campo oculto para el ID -->
                <input type="hidden" name="id" value="<?php echo $id; ?>">

                <!-- Botón para guardar cambios -->
                <input type="submit" name="guardar_cambios" value="Guardar Cambios" class="btn-guardar">
            </form>

        </section>
    </main>

    <?php include("footer.html"); ?>
    <script src="js/confirmacion.js"></script>
    <script src="js/navbar.js"></script>
    <script src="js/footer.js"></script>
</body>
</html>
