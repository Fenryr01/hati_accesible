<?php include("navbar.php"); 
    // Verificar si el usuario está autenticado
    if (!isset($_SESSION['username'])) {
        header("Location: index.php"); // Redirigir al inicio si no está autenticado
        exit;
    }

    // Verificar permisos específicos
    if (!isset($_SESSION['permisos']['ver_tablas'])) {
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
    <title>Datos Registrados</title>
</head>
<body>
    <main class="main_general">
        <section class="buscador">
            <h1>Buscador</h1>
            <input type="text" id="search" placeholder="Buscar por nombre, apellido, dirección o DNI">
            <h1>Filtrar por CUD</h1>
            <select id="cud_filter">
                <option value="">Todos</option>
                <option value="1">Con CUD</option>
                <option value="0">Sin CUD</option>
            </select>
            <h1>Filtrar por Visitado</h1>
            <select id="visitado_filter"> 
                <option value="">Todos</option>
                <option value="1">Visitado</option>
                <option value="0">No Visitado</option>
            </select>
        </section>
        <p id="resultado_texto">Resultados encontrados: 0</p>
        <section class="tabla_registro">
            <table class="tabla_registro_datos">
                <thead>
                    <tr>
                    <th class="sortable" data-column="dni" data-order="asc">DNI <span class="sort-indicator"></span></th>
                    <th class="sortable" data-column="apellido" data-order="asc">Apellido <span class="sort-indicator"></span></th>
                    <th class="sortable" data-column="nombre" data-order="asc">Nombre <span class="sort-indicator"></span></th>
                    <th class="sortable" data-column="direccion" data-order="asc">Dirección <span class="sort-indicator"></span></th>
                        <th>Visitado</th>
                    </tr>
                </thead>
                <tbody id="tabla_registro">
                    <!-- Los registros se cargarán dinámicamente aquí -->
                </tbody>
            </table>
        </section>
    </main>

    <?php include("footer.html"); ?>
    <script src="js/buscador_registro.js"></script>
    <script src="js/navbar.js"></script>
    <script src="js/footer.js"></script>
</body>
</html>
