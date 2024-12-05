<?php include("navbar.php"); ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilos.css"> 
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

    <title>Registro</title>
</head>
<body>
    

    <div class="container_registro">
        <p class="info-obligatorios">Los campos con <span class="obligatorio">*</span> son obligatorios.</p>

        
        <form class="form_registro" action="php/registro_discapacidad.php" method="post">
            <label for="nombre">Nombre:<span class="obligatorio">*</span></label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="apellido">Apellido:<span class="obligatorio">*</span></label>
            <input type="text" id="apellido" name="apellido" required>

            <label for="dni">DNI:<span class="obligatorio">*</span></label>
            <input 
                type="text" 
                id="dni" 
                name="dni" 
                required 
                pattern="^\d{7,9}$" 
                title="El DNI debe tener entre 7 y 9 números." 
            >

            <label>¿Hay una persona con discapacidad?<span class="obligatorio">*</span></label>
            <select id="persona_discapacidad" name="persona_discapacidad" required onchange="mostrarCampos()">
                <option value="" disabled selected>Seleccione una opción</option>
                <option value="No">No</option>
                <option value="Si">Si</option>
            </select>

            <!-- Estos son los campos adicionales que solo se mostrarán si se selecciona "Si" -->
            <div id="extra-fields" style="display:none;">
                <label>¿Quién es la persona con discapacidad?</label>
                <div class="checkboxs">
                    <div class="checkbox-container">
                        <label for="quien_padre">Padre/Madre</label>
                        <input type="checkbox" name="quien_es[]" value="Padre/Madre" id="quien_padre">
                    </div>
                    <div class="checkbox-container">
                        <label for="quien_hijo">Hijo/a</label>
                        <input type="checkbox" name="quien_es[]" value="Hijo/a" id="quien_hijo">
                    </div>
                    <div class="checkbox-container">
                        <label for="quien_abuelo">Abuelo/a</label>
                        <input type="checkbox" name="quien_es[]" value="Abuelo/a" id="quien_abuelo">
                    </div>
                    <div class="checkbox-container">
                        <label for="quien_otros">Otros</label>
                        <input type="checkbox" name="quien_es[]" value="Otros" id="quien_otros">
                    </div>
                </div>


                <!-- Campo que se muestra solo si selecciona 'Otros' -->
                <input type="text" name="otros_parentesco" id="otros_parentesco" placeholder="Especificar parentesco" style="display:none;">

                <label for="direccion">Dirección:<span class="obligatorio">*</span></label>
                <input type="text" id="direccion" name="direccion" required>

                <label for="telefono">Teléfono/Celular:</label>
                <input type="text" id="telefono" name="telefono">

                <label for="correo">Correo Electrónico:</label>
                <input 
                    type="email" 
                    id="correo" 
                    name="correo" 
                    pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" 
                    title="Por favor, ingresa una dirección de correo válida."
                >

                <label>¿Tiene Certificado Único de Discapacidad (CUD)?<span class="obligatorio">*</span></label>
                <select id="certificado_discapacidad" name="certificado_discapacidad" required>
                    <option value="" disabled selected>Seleccione una opción</option>
                    <option value="No">No</option>
                    <option value="Si">Si</option>
                </select>
            </div>

            <input type="submit" value="Registrar">
        </form>
    </div>

    <?php include("footer.html"); ?>
    <script src="js/registro.js"></script>
    <script src="js/navbar.js"></script>
    <script src="js/footer.js"></script>
</body>
</html>
