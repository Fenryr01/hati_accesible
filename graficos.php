<?php 
// Definir el permiso requerido para esta página
$requiredPermission = 'graficos';

include("navbar.php"); 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilos.css"> 
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <title>Datos Registrados</title>
</head>
<body>
    <section class="graficos_body">
        <div class="content-menu">
            <li data-grafico="general"><span class="material-icons icon-general">person</span><h4 class="text1">Persona</h4></li>
            <li data-grafico="salud"><span class="material-icons icon-salud">favorite</span><h4 class="text2">Salud</h4></li>
            <li data-grafico="vivienda"><span class="material-icons icon-vivienda">house</span><h4 class="text3">Vivienda</h4></li>
            <li data-grafico="todos"><span class="material-icons icon-todos">dashboard</span><h4 class="text4">Todos</h4></li>
        </div>

        <main class="graficos_contenedor">
            <div class="buton_grafico"></div>
            <div class="main_general_grafico"></div>
        </main>
    </section>
    <?php include("footer.html"); ?>
    <script src="js/menu_graficos.js"></script>
    <script src="js/navbar.js"></script>
    <script src="js/footer.js"></script>
</body>
</html>
