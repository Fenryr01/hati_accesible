<?php include("navbar.php"); 
    // Verificar si el usuario está autenticado
    if (!isset($_SESSION['username'])) {
        header("Location: index.php"); // Redirigir al inicio si no está autenticado
        exit;
    }

    // Verificar permisos específicos
    if (!isset($_SESSION['permisos']['formulario_discapacidad'])) {
        header("Location: index.php"); // Redirigir si no tiene permiso
        exit;
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


    <div class="container_registro">
        <form class="form_registro" action="php/insertar_discapacidad.php" method="post" onsubmit="return validarFormulario()">
            <div class="pagina" id="pagina1">
                <h2>Datos Personales</h2>

                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required>

                <label for="apellido">Apellido:</label>
                <input type="text" id="apellido" name="apellido" required>

                <label for="dni">DNI:</label>
                <input type="number" id="dni" name="dni" required>

                <label for="nacimiento">Fecha de Nacimiento:</label>
                <input type="date" id="nacimiento" name="nacimiento" required>

                <label for="edad">Edad:</label>
                <input type="number" id="edad" name="edad" required>

                <label for="contacto">Contacto:</label>
                <input type="text" id="contacto" name="contacto">

                <label for="domicilio">Domicilio:</label>
                <input type="text" id="domicilio" name="domicilio" required>

                <label for="barrio">Barrio:</label>
                <input type="text" id="barrio" name="barrio" required>

                <!-- GRUPO FAMILIAR -->
                <label for="miembros_grupo_familiar">Número de miembros del grupo familiar:</label>
                <input type="number" id="miembros_grupo_familiar" name="miembros_grupo_familiar" min="0" required>
                
                <div id="grupo_familiar_container">
                    <!-- Aquí se generarán los inputs dinámicos -->
                </div>

                <label for="observacion_datos_personales">Observaciones de Datos Personales:</label>
                <textarea id="observacion_datos_personales" name="observacion_datos_personales" placeholder="Ingrese observaciones sobre los datos personales" rows="5" cols="50"></textarea>
                
                <div class="buton_ant_sig1">
                    <button class="ant_sig1" type="button" onclick="cambiarPagina(2)">
                        Siguiente
                        <i class="material-icons" style="font-size: 30px;">double_arrow</i>
                    </button>
                </div>
            </div>
            
            <div class="pagina" id="pagina2">
                <h2>Vivienda</h2>

                <label for="tipo_tenencia">Tipo de Tenencia:</label>
                <select id="tipo_tenencia" name="tipo_tenencia" required>
                    <option value="" disabled selected>Seleccione una opción</option>
                    <option value="propia">Propia</option>
                    <option value="alquila">Alquila</option>
                    <option value="cedida">Cedido</option>
                    <option value="prestada">Prestada</option>
                    <option value="usurpada">Usurpada</option>
                </select>

                <label for="piso">Piso:</label>
                <div class="checkboxs">
                    <div class="checkbox-container">
                        <label for="piso_ceramica">Cerámica</label>
                        <input type="checkbox" id="piso_ceramica" name="piso[]" value="Cerámica">
                    </div>
                    <div class="checkbox-container">
                        <label for="piso_concreto">Concreto</label>
                        <input type="checkbox" id="piso_concreto" name="piso[]" value="Concreto">
                    </div>
                    <div class="checkbox-container">
                        <label for="piso_tierra">Tierra</label>
                        <input type="checkbox" id="piso_tierra" name="piso[]" value="Tierra">
                    </div>
                </div>

                <label for="pared">Pared:</label>
                <div class="checkboxs">
                    <div class="checkbox-container">
                        <label for="pared_adobe">Adobe</label>
                        <input type="checkbox" id="pared_adobe" name="pared[]" value="Adobe">
                    </div>
                    <div class="checkbox-container">
                        <label for="pared_ladrillo">Ladrillo</label>
                        <input type="checkbox" id="pared_ladrillo" name="pared[]" value="Ladrillo">
                    </div>
                    <div class="checkbox-container">
                        <label for="pared_chapa">Chapa</label>
                        <input type="checkbox" id="pared_chapa" name="pared[]" value="Chapa">
                    </div>
                    <div class="checkbox-container">
                        <label for="pared_revoque">Revoque</label>
                        <input type="checkbox" id="pared_revoque" name="pared[]" value="Revoque">
                    </div>
                    <div class="checkbox-container">
                        <label for="pared_madera">Madera</label>
                        <input type="checkbox" id="pared_madera" name="pared[]" value="Madera">
                    </div>
                </div>

                <label for="techo">Techo:</label>
                <div class="checkboxs">
                    <div class="checkbox-container">
                        <label for="techo_chapa">Chapa</label>
                        <input type="checkbox" id="techo_chapa" name="techo[]" value="Chapa">
                    </div>
                    <div class="checkbox-container">
                        <label for="techo_madera">Madera</label>
                        <input type="checkbox" id="techo_madera" name="techo[]" value="Madera">
                    </div>
                    <div class="checkbox-container">
                        <label for="techo_adobe">Adobe</label>
                        <input type="checkbox" id="techo_adobe" name="techo[]" value="Adobe">
                    </div>
                    <div class="checkbox-container">
                        <label for="techo_nylon">Nylon</label>
                        <input type="checkbox" id="techo_nylon" name="techo[]" value="Nylon">
                    </div>
                </div>

                <!-- AMBIENTES -->
                <label for="cantidad_ambientes">Cantidad de Ambientes:</label>
                <input type="number" id="cantidad_ambientes" name="cantidad_ambientes" required min="0" oninput="mostrarUsoAmbientes(this.value)">

                <div id="contenedorUsoAmbientes"></div>

                <label for="cantidad_camas">Cantidad de Camas:</label>
                <input type="number" id="cantidad_camas" name="cantidad_camas" required>

                <label for="ventilacion">Ventilación</label>
                <select id="ventilacion" name="ventilacion" required>
                    <option value="" disabled selected>Seleccione una opción</option>
                    <option value="1">Si</option>
                    <option value="0">No</option>
                </select>

                <label for="iluminacion">Iluminación:</label>
                <select id="iluminacion" name="iluminacion" required>
                    <option value="" disabled selected>Seleccione una opción</option>
                    <option value="1">Si</option>
                    <option value="0">No</option>
                </select>

                <label for="higiene">Higiene:</label>
                <select id="higiene" name="higiene" required>
                    <option value="" disabled selected>Seleccione una opción</option>
                    <option value="1">Si</option>
                    <option value="0">No</option>
                </select>

                <label for="orden">Orden:</label>
                <select id="orden" name="orden" required>
                    <option value="" disabled selected>Seleccione una opción</option>
                    <option value="1">Si</option>
                    <option value="0">No</option>
                </select>

                <label for="existencia_sanitaria">Existencia Sanitaria:</label>
                <select id="existencia_sanitaria" name="existencia_sanitaria" required>
                    <option value="" disabled selected>Seleccione una opción</option>
                    <option value="1">Si</option>
                    <option value="0">No</option>
                </select>

                <label for="letrina">Letrina:</label>
                <select id="letrina" name="letrina" required>
                    <option value="" disabled selected>Seleccione una opción</option>
                    <option value="dentro">Dentro</option>
                    <option value="fuera">Fuera</option>
                </select>

                <label for="procedencia_agua">Procedencia del Agua:</label>
                <select id="procedencia_agua" name="procedencia_agua" required>
                    <option value="" disabled selected>Seleccione una opción</option>
                    <option value="pozo">Pozo</option>
                    <option value="bomba">Bomba</option>
                    <option value="corriente">Corriente</option>
                    <option value="potable">Potable</option>
                </select>

                <!-- CONFORT-->
                <label for="numero_confort">Número de Elementos de Confort:</label>
                <input type="number" id="numero_confort" name="numero_confort" required min="0" oninput="mostrarElementosConfort(this.value)">

                <div id="contenedorElementosConfort"></div>

                <label for="barreras_arquitectonicas">Barreras Arquitectónicas:</label>
                <select id="barreras_arquitectonicas" name="barreras_arquitectonicas" required>
                    <option value="" disabled selected>Seleccione una opción</option>
                    <option value="1">Si</option>
                    <option value="0">No</option>
                </select>

                <label for="observacion_vivienda">Observaciones:</label>
                <textarea id="observacion_vivienda" name="observacion_vivienda" placeholder="Ingrese observaciones sobre la vivienda" rows="5" cols="50"></textarea>
                
                <div class="buton_ant_sig2">
                    <button class="ant_sig2" type="button" onclick="cambiarPagina(1)"><i class="material-icons" style="font-size: 30px;">keyboard_double_arrow_left</i>Anterior</button>
                    <button class="ant_sig1" type="button" onclick="cambiarPagina(3)">Siguiente<i class="material-icons" style="font-size: 30px;">double_arrow</i></button>
                </div>
            </div>


            <div class="pagina" id="pagina3">
                <h2>Salud</h2>

                <label for="numero_discapacidades">Número de discapacidades:</label>
                <input type="number" id="numero_discapacidades" name="numero_discapacidades" required min="1" oninput="updateDiscapacidadInputs()">

                <div id="discapacidad_inputs"></div>

                <label for="cobertura">Cobertura:</label>
                <select id="cobertura" name="cobertura" required>
                    <option value="" disabled selected>Seleccione una opción</option>
                    <option value="1">Si</option>
                    <option value="0">No</option>
                </select>

                <label for="cud">CUD:</label>
                <select id="cud" name="cud" required>
                    <option value="" disabled selected>Seleccione una opción</option>
                    <option value="1">Si</option>
                    <option value="0">No</option>
                </select>

                <label for="lugar_atencion">¿Dónde se atiende?</label>
                <input type="text" id="lugar_atencion" name="lugar_atencion">

                <label for="necesita_asistencia">¿Necesita asistencia?</label>
                <select id="necesita_asistencia" name="necesita_asistencia" required>
                    <option value="" disabled selected>Seleccione una opción</option>
                    <option value="1">Si</option>
                    <option value="0">No</option>
                </select>

                <label for="quien_brinda_asistencia">¿Quién brinda asistencia?</label>
                <input type="text" id="quien_brinda_asistencia" name="quien_brinda_asistencia">

                <label for="cobra_pension">¿Cobra pensión?</label>
                <select id="cobra_pension" name="cobra_pension" required>
                    <option value="" disabled selected>Seleccione una opción</option>
                    <option value="1">Si</option>
                    <option value="0">No</option>
                </select>

                <label for="observacion_salud">Observaciones de Salud:</label>
                <textarea id="observacion_salud" name="observacion_salud" placeholder="Ingrese observaciones sobre la salud" rows="5" cols="50" style="resize: none;"></textarea>
                
                <div class="buton_ant_sig3">
                    <button class="ant_sig2" type="button" onclick="cambiarPagina(2)"><i class="material-icons" style="font-size: 30px;">keyboard_double_arrow_left</i>Anterior</button>
                </div>
                <input type="submit" value="Enviar">
            </div>

        </form>
    </div>

    <?php include("footer.html"); ?>
    <script src="js/formulario.js"></script>
    <script src="js/navbar.js"></script>
    <script src="js/footer.js"></script>
</body>
</html>
