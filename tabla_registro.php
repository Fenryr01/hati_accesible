<?php 
// Definir el permiso requerido para esta página
$requiredPermission = 'ver_tablas';

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
    <title>Datos Registrados</title>
</head>
<body>
    <main class="main_general">
    <div class="waves_div">
        <!--Content before waves-->
        <div class="inner-header flex">
            <h1>Tabla Registro</h1>
        </div>
        <!--Waves Container-->
        <div>
            <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
                <defs>
                    <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
                </defs>
                <g class="parallax">
                    <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(255,255,255,0.7" />
                    <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(255,255,255,0.5)" />
                    <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(255,255,255,0.3)" />
                    <use xlink:href="#gentle-wave" x="48" y="7" fill="#d1d1d1" />
                </g>
            </svg>
        </div>
        </div>
        <!--Waves end-->
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
            <div>
                <button class="noselect2" id="downloadPDF">
                    <span class="text">Descarga PDF</span><span class="material-icons">download</span>
                </button>
            </div>
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
        <!-- Paginación -->
        <div class="pagination">
            <button class="ant_sig2" id="prevPage" disabled>
                <i class="material-icons" style="padding-bottom: 3px; font-weight: bold; font-size: 25px;">keyboard_double_arrow_left</i>
                <span class="prev-text">Anterior</span>
            </button>
            <input type="number" id="currentPage" value="1" min="1">
            <span id="totalPages"> / 1</span>
            <button class="ant_sig1" id="nextPage">
                <span class="next-text">Siguiente</span>
                <i class="material-icons" style="padding-bottom: 3px; font-size: 25px; font-weight: bold">keyboard_double_arrow_right</i>
            </button>
        </div>
    </main>


    <?php include("footer.html"); ?>
    <script src="js/buscador_registro.js"></script>
    <script src="js/navbar.js"></script>
    <script src="js/footer.js"></script>
</body>
</html>
