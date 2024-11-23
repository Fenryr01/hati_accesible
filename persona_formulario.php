<?php 
    // Definir el permiso requerido para esta página
    $requiredPermission = 'editar_tablas';

    include("navbar.php"); 

    include("php/db.php"); // Incluir la conexión a la base de datos
    if (!$conexion) {
        die("Error de conexión: " . mysqli_connect_error());
    }
    
    // Inicializar variables para los datos
    $nombre = $apellido = $dni = $nacimiento = $contacto = $domicilio = $zona = $tipo_tenencia = $procedencia_agua = $cantidad_camas = $ventilacion = $iluminacion = $higiene = $orden = $existencia_sanitaria = $letrina = $barreras_arquitectonicas = $cobertura = $cud = $lugar_atencion = $necesita_asistencia = $quien_brinda_asistencia = $cobra_pension = $observacion_salud = $observacion_vivienda = $observacion_datos_personales = $miembros_grupo_familiar = $cantidad_ambientes = $numero_confort = $numero_discapacidades = $tipo_pension = $fecha_formulario = "";

    // Verificar si se ha pasado un ID
    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);
        $query = "SELECT * FROM personas WHERE id = $id";
        $resultado = mysqli_query($conexion, $query);

        if ($fila = mysqli_fetch_assoc($resultado)) {
            // Obtener los datos del registro
            $nombre = htmlspecialchars($fila['nombre']);
            $apellido = htmlspecialchars($fila['apellido']);
            $dni = htmlspecialchars($fila['dni']);
            $nacimiento = htmlspecialchars($fila['nacimiento'] ?? '');
            $contacto = htmlspecialchars($fila['contacto'] ?? '');
            $domicilio = htmlspecialchars($fila['domicilio']);
            $zona = htmlspecialchars($fila['zona']);
            $tipo_tenencia = htmlspecialchars($fila['tipo_tenencia']);
            $procedencia_agua = htmlspecialchars($fila['procedencia_agua']);
            $cantidad_camas = htmlspecialchars($fila['cantidad_camas']);
            $ventilacion = htmlspecialchars($fila['ventilacion']);
            $iluminacion = htmlspecialchars($fila['iluminacion']);
            $higiene = htmlspecialchars($fila['higiene']);
            $orden = htmlspecialchars($fila['orden']);
            $existencia_sanitaria = htmlspecialchars($fila['existencia_sanitaria']);
            $letrina = htmlspecialchars($fila['letrina']);
            $barreras_arquitectonicas = htmlspecialchars($fila['barreras_arquitectonicas']);
            $cobertura = htmlspecialchars($fila['cobertura']);
            $cud = htmlspecialchars($fila['cud']);
            $lugar_atencion = htmlspecialchars($fila['lugar_atencion'] ?? '');
            $necesita_asistencia = htmlspecialchars($fila['necesita_asistencia']);
            $quien_brinda_asistencia = htmlspecialchars($fila['quien_brinda_asistencia'] ?? '');
            $cobra_pension = htmlspecialchars($fila['cobra_pension']);
            $observacion_salud = htmlspecialchars($fila['observacion_salud'] ?? '');
            $observacion_vivienda = htmlspecialchars($fila['observacion_vivienda'] ?? '');
            $observacion_datos_personales = htmlspecialchars($fila['observacion_datos_personales'] ?? '');
            $miembros_grupo_familiar = htmlspecialchars($fila['miembros_grupo_familiar']);
            $cantidad_ambientes = htmlspecialchars($fila['cantidad_ambientes']);
            $numero_confort = htmlspecialchars($fila['numero_confort']);
            $numero_discapacidades = htmlspecialchars($fila['numero_discapacidades']);
            $tipo_pension = htmlspecialchars($fila['tipo_pension'] ?? '');
            $fecha_formulario = htmlspecialchars($fila['fecha_formulario']);

            // Obtener datos del grupo familiar asociado a la persona
            $query_grupo_familiar = "SELECT * FROM grupo_familiar WHERE persona_id = $id";
            $resultado_grupo_familiar = mysqli_query($conexion, $query_grupo_familiar);
            $grupo_familiar = [];
            
            // Guardamos los miembros en un array
            while ($miembro = mysqli_fetch_assoc($resultado_grupo_familiar)) {
                $grupo_familiar[] = $miembro;
            }
            
            // Pasamos los datos a JavaScript
            echo "<script>const miembrosFamiliares = " . json_encode($grupo_familiar) . ";</script>";

            // Obtener datos del uso ambiente asociado a la persona
            $query_uso_ambiente = "SELECT * FROM uso_ambiente WHERE persona_id = $id";
            $resultado_uso_ambiente = mysqli_query($conexion, $query_uso_ambiente);
            $uso_ambiente = [];

            // Guardamos los valores en un array
            while ($miembro = mysqli_fetch_assoc($resultado_uso_ambiente)) {
                $uso_ambiente[] = $miembro['uso']; // Cambia 'uso' por el nombre real de la columna
            }

            // Pasamos los datos a JavaScript
            echo "<script>const UsoAmbientes = " . json_encode($uso_ambiente) . ";</script>";

            // Obtener datos de elementos confort asociado a la persona
            $query_elementos = "SELECT elemento FROM elementos_confort WHERE persona_id = $id";
            $resultado_elementos = mysqli_query($conexion, $query_elementos);
            $elementos = [];

            // Guardamos los elementos en un array
            while ($miembro = mysqli_fetch_assoc($resultado_elementos)) {
                $elementos[] = $miembro['elemento'];
            }

            // Pasamos los datos a JavaScript
            echo "<script>const elementos_confort = " . json_encode($elementos) . ";</script>";

            // Obtener los tipos de pared asociados a la persona
            $query_paredes = "SELECT tipo_pared FROM pared WHERE persona_id = $id";
            $resultado_paredes = mysqli_query($conexion, $query_paredes);

            $paredesSeleccionadas = [];
            while ($pared = mysqli_fetch_assoc($resultado_paredes)) {
                $paredesSeleccionadas[] = $pared['tipo_pared']; // Guardamos los valores seleccionados
            }

            // Obtener los tipos de piso asociados a la persona
            $query_pisos = "SELECT tipo_piso FROM piso WHERE persona_id = $id";
            $resultado_pisos = mysqli_query($conexion, $query_pisos);

            $pisosSeleccionadas = [];
            while ($piso = mysqli_fetch_assoc($resultado_pisos)) {
                $pisosSeleccionadas[] = $piso['tipo_piso']; // Guardamos los valores seleccionados
            }

            // Obtener los tipos de techo asociados a la persona
            $query_techos = "SELECT tipo_techo FROM techo WHERE persona_id = $id";
            $resultado_techos = mysqli_query($conexion, $query_techos);

            $techosSeleccionadas = [];
            while ($techo = mysqli_fetch_assoc($resultado_techos)) {
                $techosSeleccionadas[] = $techo['tipo_techo']; // Guardamos los valores seleccionados
            }

            // Obtener datos de discapacidad asociado a la persona
            $query_discapacidades = "SELECT tipo_discapacidad, discapacidad FROM discapacidades WHERE persona_id = $id";
            $resultado_discapacidades = mysqli_query($conexion, $query_discapacidades);
            $discapacidades = [];

            // Guardamos los datos en un array
            while ($discapacidad = mysqli_fetch_assoc($resultado_discapacidades)) {
                $discapacidades[] = $discapacidad; // Asegúrate de que contiene las claves tipo_discapacidad y discapacidad
            }

            // Pasar los datos al frontend en formato JSON
            echo "<script>const discapacidadesSeleccionadas = " . json_encode($discapacidades) . ";</script>";


        } else {
            echo "No se encontraron detalles.";
            exit;
        }

        mysqli_free_result($resultado);
    }

    


?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilos.css"> 
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <title>Formulario Discapacidad</title>

</head>
<body>

    <a href="tabla_formulario.php" class="btn-back">
        <span class="material-icons" style="font-size: 50px;">arrow_back</span>
    </a>
    <div class="container_registro">
        
        <p class="datos_tab">
            <span id="datos_personales">Datos Personales</span> /
            <span id="datos_vivienda">Datos Vivienda</span> /
            <span id="datos_salud">Datos Salud</span>
        </p>
        <form class="form_registro" action="php/actualizar_discapacidad.php" method="post" onsubmit="return validarFormulario()">
            <!-- Campo oculto para enviar el ID -->
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <h1>Registro de <?php echo $apellido," " , $nombre; ?> </h1>
                <div class="botones_row">
                    <!-- Botón para eliminar el registro -->
                    <button type="submit" name="eliminar_registro" class="btn-eliminar" onclick="return confirmarEliminacion('<?php echo $nombre; ?>', '<?php echo $apellido; ?>')">
                        <i class="material-icons" style="font-size: 30px;">delete</i>
                    </button>
                </div>

            <div class="pagina" id="pagina1">
                <h2>Datos Personales</h2>

                <label for="fecha_formulario">Fecha de visita:</label>
                <input type="date" name="fecha_formulario" id="fecha_formulario" value="<?php echo $fecha_formulario; ?>" required>

                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo $nombre; ?>" required>

                <label for="apellido">Apellido:</label>
                <input type="text" id="apellido" name="apellido" value="<?php echo $apellido; ?>" required>

                <label for="dni">DNI:</label>
                <input type="number" id="dni" name="dni" value="<?php echo $dni; ?>" required>

                <label for="nacimiento">Fecha de Nacimiento:</label>
                <input type="date" id="nacimiento" name="nacimiento" value="<?php echo $nacimiento; ?>" required>

                <label for="edad">Edad:</label>
                <input type="number" id="edad" name="edad" disabled>

                <label for="contacto">Contacto:</label>
                <input type="text" id="contacto" name="contacto" value="<?php echo $contacto; ?>">

                <label for="domicilio">Domicilio:</label>
                <input type="text" id="domicilio" name="domicilio" value="<?php echo $domicilio; ?>" required>

                <label for="zona">Zona:</label>
                <select id="zona" name="zona" value="<?php echo $zona; ?>" required>
                    <option value="" disabled selected>Seleccione una zona</option>
                    
                </select>
                <script>
                    // Pasamos la variable PHP $zona directamente a JavaScript
                    const zonaSeleccionada = "<?php echo $zona; ?>"; // PHP pasa el valor de $zona a JavaScript
                </script>

                <!-- GRUPO FAMILIAR -->
                <label for="miembros_grupo_familiar">Número de miembros del grupo familiar:</label>
                <input type="number" id="miembros_grupo_familiar" name="miembros_grupo_familiar" min="0" value="<?php echo $miembros_grupo_familiar; ?>" required>
                
                <div id="grupo_familiar_container">
                    <!-- Aquí se generarán los inputs dinámicos -->
                </div>

                <label for="observacion_datos_personales">Observaciones de Datos Personales:</label>
                <textarea id="observacion_datos_personales" name="observacion_datos_personales" placeholder="Ingrese observaciones sobre los datos personales" rows="5" cols="50"><?php echo $observacion_datos_personales; ?></textarea>

                
                <div class="buton_ant_sig1">
                    <button class="ant_sig1" type="button" onclick="cambiarPagina(2)">
                        Siguiente
                        <i class="material-icons" style="font-size: 30px; font-weight: bold; padding-bottom: 1px">keyboard_double_arrow_right</i>
                    </button>
                </div>
            </div>
            
            <div class="pagina" id="pagina2">
                <h2>Vivienda</h2>

                <label for="tipo_tenencia">Tipo de Tenencia:</label>
                <select id="tipo_tenencia" name="tipo_tenencia" required>
                    <option value="" disabled selected>Seleccione una opción</option>
                    <option value="propia" <?php echo ($tipo_tenencia == "propia") ? "selected" : ""; ?>>Propia</option>
                    <option value="alquila" <?php echo ($tipo_tenencia == "alquila") ? "selected" : ""; ?>>Alquila</option>
                    <option value="cedida" <?php echo ($tipo_tenencia == "cedida") ? "selected" : ""; ?>>Cedido</option>
                    <option value="prestada" <?php echo ($tipo_tenencia == "prestada") ? "selected" : ""; ?>>Prestada</option>
                    <option value="usurpada" <?php echo ($tipo_tenencia == "usurpada") ? "selected" : ""; ?>>Usurpada</option>
                </select>

                <label for="piso">Piso:</label>
                <div class="checkboxs">
                    <div class="checkbox-container">
                        <label for="piso_ceramica">Cerámica</label>
                        <input type="checkbox" id="piso_ceramica" name="piso[]" value="Cerámica"
                        <?php echo in_array("Cerámica", $pisosSeleccionadas) ? 'checked' : ''; ?>>
                    </div>
                    <div class="checkbox-container">
                        <label for="piso_concreto">Concreto</label>
                        <input type="checkbox" id="piso_concreto" name="piso[]" value="Concreto"
                        <?php echo in_array("Concreto", $pisosSeleccionadas) ? 'checked' : ''; ?>>
                    </div>
                    <div class="checkbox-container">
                        <label for="piso_tierra">Tierra</label>
                        <input type="checkbox" id="piso_tierra" name="piso[]" value="Tierra"
                        <?php echo in_array("Tierra", $pisosSeleccionadas) ? 'checked' : ''; ?>>
                    </div>
                </div>

                <label for="pared">Pared:</label>
                    <div class="checkboxs">
                        <div class="checkbox-container">
                            <label for="pared_adobe">Adobe</label>
                            <input type="checkbox" id="pared_adobe" name="pared[]" value="Adobe" 
                            <?php echo in_array("Adobe", $paredesSeleccionadas) ? 'checked' : ''; ?>>
                        </div>
                        <div class="checkbox-container">
                            <label for="pared_ladrillo">Ladrillo</label>
                            <input type="checkbox" id="pared_ladrillo" name="pared[]" value="Ladrillo" 
                            <?php echo in_array("Ladrillo", $paredesSeleccionadas) ? 'checked' : ''; ?>>
                        </div>
                        <div class="checkbox-container">
                            <label for="pared_chapa">Chapa</label>
                            <input type="checkbox" id="pared_chapa" name="pared[]" value="Chapa" 
                            <?php echo in_array("Chapa", $paredesSeleccionadas) ? 'checked' : ''; ?>>
                        </div>
                        <div class="checkbox-container">
                            <label for="pared_revoque">Revoque</label>
                            <input type="checkbox" id="pared_revoque" name="pared[]" value="Revoque" 
                            <?php echo in_array("Revoque", $paredesSeleccionadas) ? 'checked' : ''; ?>>
                        </div>
                        <div class="checkbox-container">
                            <label for="pared_madera">Madera</label>
                            <input type="checkbox" id="pared_madera" name="pared[]" value="Madera" 
                            <?php echo in_array("Madera", $paredesSeleccionadas) ? 'checked' : ''; ?>>
                        </div>
                    </div>


                <label for="techo">Techo:</label>
                <div class="checkboxs">
                    <div class="checkbox-container">
                        <label for="techo_chapa">Chapa</label>
                        <input type="checkbox" id="techo_chapa" name="techo[]" value="Chapa"
                        <?php echo in_array("Chapa", $techosSeleccionadas) ? 'checked' : ''; ?>>
                    </div>
                    <div class="checkbox-container">
                        <label for="techo_madera">Madera</label>
                        <input type="checkbox" id="techo_madera" name="techo[]" value="Madera"
                        <?php echo in_array("Madera", $techosSeleccionadas) ? 'checked' : ''; ?>>
                    </div>
                    <div class="checkbox-container">
                        <label for="techo_adobe">Adobe</label>
                        <input type="checkbox" id="techo_adobe" name="techo[]" value="Adobe"
                        <?php echo in_array("Adobe", $techosSeleccionadas) ? 'checked' : ''; ?>>
                    </div>
                    <div class="checkbox-container">
                        <label for="techo_nylon">Nylon</label>
                        <input type="checkbox" id="techo_nylon" name="techo[]" value="Nylon"
                        <?php echo in_array("Nylon", $techosSeleccionadas) ? 'checked' : ''; ?>>
                    </div>
                </div>

                <!-- AMBIENTES -->
                <label for="cantidad_ambientes">Cantidad de Ambientes:</label>
                <input type="number" id="cantidad_ambientes" name="cantidad_ambientes" value="<?php echo $cantidad_ambientes; ?>" required min="0" oninput="mostrarUsoAmbientes(this.value)">

                <div id="contenedorUsoAmbientes"></div>
                <script>
                    const numeroAmbientes = <?php echo $cantidad_ambientes; ?>;
                </script>


                <label for="cantidad_camas">Cantidad de Camas:</label>
                <input type="number" id="cantidad_camas" name="cantidad_camas" value="<?php echo $cantidad_camas; ?>" required>

                <label for="ventilacion">Ventilación</label>
                <select id="ventilacion" name="ventilacion" required>
                    <option value="" disabled selected>Seleccione una opción</option>
                </select>
                <script>
                    // Pasamos la variable PHP $ventilacion directamente a JavaScript
                    const ventilacionSeleccionada = "<?php echo $ventilacion; ?>"; // 
                </script>

                <label for="iluminacion">Iluminación:</label>
                <select id="iluminacion" name="iluminacion" required>
                    <option value="" disabled selected>Seleccione una opción</option>
                </select>
                <script>
                    // Pasamos la variable PHP $iluminacion directamente a JavaScript
                    const iluminacionSeleccionada = "<?php echo $iluminacion; ?>"; // 
                </script>

                <label for="higiene">Higiene:</label>
                <select id="higiene" name="higiene" required>
                    <option value="" disabled selected>Seleccione una opción</option>
                </select>
                <script>
                    // Pasamos la variable PHP $higiene directamente a JavaScript
                    const higieneSeleccionada = "<?php echo $higiene; ?>"; // 
                </script>

                <label for="orden">Orden:</label>
                <select id="orden" name="orden" required>
                    <option value="" disabled selected>Seleccione una opción</option>
                </select>
                <script>
                    // Pasamos la variable PHP $orden directamente a JavaScript
                    const ordenSeleccionada = "<?php echo $orden; ?>"; // 
                </script>

                <label for="barreras_arquitectonicas">Barreras Arquitectónicas:</label>
                <select id="barreras_arquitectonicas" name="barreras_arquitectonicas" required>
                    <option value="" disabled selected>Seleccione una opción</option>
                </select>
                <script>
                    // Pasamos la variable PHP $barreras_arquitectonicas directamente a JavaScript
                    const barreras_arquitectonicasSeleccionada = "<?php echo $barreras_arquitectonicas; ?>"; // 
                </script>

                <label for="existencia_sanitaria">Existencia Sanitaria:</label>
                <select id="existencia_sanitaria" name="existencia_sanitaria" required>
                    <option value="" disabled selected>Seleccione una opción</option>
                    <option value="1" <?php echo ($existencia_sanitaria == "1") ? "selected" : ""; ?>>Si</option>
                    <option value="0" <?php echo ($existencia_sanitaria == "0") ? "selected" : ""; ?>>No</option>
                </select>

                <label for="letrina">Letrina:</label>
                <select id="letrina" name="letrina" required>
                    <option value="" disabled selected>Seleccione una opción</option>
                    <option value="dentro" <?php echo ($letrina == "dentro") ? "selected" : ""; ?>>Dentro</option>
                    <option value="fuera" <?php echo ($letrina == "fuera") ? "selected" : ""; ?>>Fuera</option>
                </select>

                <label for="procedencia_agua">Procedencia del Agua:</label>
                <select id="procedencia_agua" name="procedencia_agua" required>
                    <option value="" disabled selected>Seleccione una opción</option>
                    <option value="pozo" <?php echo ($procedencia_agua == "pozo") ? "selected" : ""; ?>>Pozo</option>
                    <option value="bomba" <?php echo ($procedencia_agua == "bomba") ? "selected" : ""; ?>>Bomba</option>
                    <option value="corriente" <?php echo ($procedencia_agua == "corriente") ? "selected" : ""; ?>>Corriente</option>
                    <option value="potable" <?php echo ($procedencia_agua == "potable") ? "selected" : ""; ?>>Potable</option>
                </select>

                <!-- CONFORT-->
                <label for="numero_confort">Número de Elementos de Confort:</label>
                <input type="number" id="numero_confort" name="numero_confort" required min="0"  value="<?php echo $numero_confort; ?>" oninput="mostrarElementosConfort(this.value)">

                <div id="contenedorElementosConfort"></div>
                <script>
                    const numeroConfort = <?php echo $numero_confort; ?>;
                </script>

                <label for="observacion_vivienda">Observaciones vivienda:</label>
                <textarea id="observacion_vivienda" name="observacion_vivienda" placeholder="Ingrese observaciones sobre la vivienda" rows="5" cols="50"><?php echo $observacion_vivienda; ?></textarea>
                
                <div class="buton_ant_sig2">
                    <button class="ant_sig2" type="button" onclick="cambiarPagina(1)"><i class="material-icons" style="font-size: 30px; font-weight: bold; padding-bottom: 2px">keyboard_double_arrow_left</i>Anterior</button>
                    <button class="ant_sig1" type="button" onclick="cambiarPagina(3)">Siguiente<i class="material-icons" style="font-size: 30px; font-weight: bold; padding-bottom: 2px">keyboard_double_arrow_right</i></button>
                </div>
            </div>


            <div class="pagina" id="pagina3">
                <h2>Salud</h2>

                <label for="numero_discapacidades">Número de discapacidades:</label>
                <input type="number" id="numero_discapacidades" name="numero_discapacidades" min="1"  value="<?php echo $numero_discapacidades; ?>" required  oninput="updateDiscapacidadInputs()">

                <div id="discapacidad_inputs"></div>
                <script>
                    const numeroDiscapacidades = <?php echo $numero_discapacidades; ?>;
                </script>

                <label for="cobertura">Cobertura:</label>
                <select id="cobertura" name="cobertura" required>
                    <option value="" disabled selected>Seleccione una opción</option>
                    <option value="1" <?php echo ($cobertura == "1") ? "selected" : ""; ?>>Si</option>
                    <option value="0" <?php echo ($cobertura == "0") ? "selected" : ""; ?>>No</option>
                </select>

                <label for="cud">CUD:</label>
                <select id="cud" name="cud" required>
                    <option value="" disabled selected>Seleccione una opción</option>
                    <option value="1" <?php echo ($cud == "1") ? "selected" : ""; ?>>Si</option>
                    <option value="0" <?php echo ($cud == "0") ? "selected" : ""; ?>>No</option>
                </select>

                <label for="lugar_atencion">¿Dónde se atiende?</label>
                <input type="text" id="lugar_atencion" name="lugar_atencion" value="<?php echo $lugar_atencion; ?>">

                <label for="necesita_asistencia">¿Necesita asistencia?</label>
                <select id="necesita_asistencia" name="necesita_asistencia" required>
                    <option value="" disabled selected>Seleccione una opción</option>
                    <option value="1" <?php echo ($necesita_asistencia == "1") ? "selected" : ""; ?>>Si</option>
                    <option value="0" <?php echo ($necesita_asistencia == "0") ? "selected" : ""; ?>>No</option>
                </select>

                <label for="quien_brinda_asistencia">¿Quién le brinda asistencia?</label>
                <input type="text" id="quien_brinda_asistencia" name="quien_brinda_asistencia" value="<?php echo $quien_brinda_asistencia; ?>">

                <label for="cobra_pension">¿Cobra pensión?</label>
                <select id="cobra_pension" name="cobra_pension" required>
                    <option value="" disabled selected>Seleccione una opción</option>
                    <option value="1" <?php echo ($cobra_pension == "1") ? "selected" : ""; ?>>Si</option>
                    <option value="0" <?php echo ($cobra_pension == "0") ? "selected" : ""; ?>>No</option>
                </select>

                <label for="tipo_pension">Tipo de pension:</label>
                <select id="tipo_pension" name="tipo_pension">
                    <option value="" disabled selected>Seleccione una opción</option>
                    <option value="IPS" <?php echo ($tipo_pension == "IPS") ? "selected" : ""; ?>>IPS</option>
                    <option value="ANSES" <?php echo ($tipo_pension == "ANSES") ? "selected" : ""; ?>>ANSES</option>
                </select>

                <label for="observacion_salud">Observaciones de Salud:</label>
                <textarea id="observacion_salud" name="observacion_salud" placeholder="Ingrese observaciones sobre la salud" rows="5" cols="50" style="resize: none;"><?php echo $observacion_salud; ?></textarea>
                
                <div class="buton_ant_sig3">
                    <button class="ant_sig2" type="button" onclick="cambiarPagina(2)"><i class="material-icons" style="font-size: 30px; font-weight: bold; padding-bottom: 2px">keyboard_double_arrow_left</i>Anterior</button>
                </div>
                <input type="submit" value="Actualizar">
            </div>

        </form>
    </div>

    <?php include("footer.html"); ?>
    <script src="js/confirmacion.js"></script>
    <script src="js/formulario.js"></script>
    <script src="js/navbar.js"></script>
    <script src="js/footer.js"></script>
</body>
</html>
