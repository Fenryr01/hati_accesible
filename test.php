<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test de Discapacidad</title>
</head>
<body>
    <form action="php/test.php" method="POST">
            <!-- GRUPO FAMILIAR -->
            <label for="grupo_familiar">Número de Grupo Familiar:</label>
            <input type="number" id="grupo_familiar" name="grupo_familiar" required min="1" oninput="mostrarIntegrantes(this.value)">

            <div id="contenedorIntegrantes"></div>
        <input type="submit" value="Enviar">
    </form>
    <script src="js/formulario.js"></script>
</body>
</html>
