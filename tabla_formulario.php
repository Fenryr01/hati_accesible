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
            <h1>Tabla Formulario</h1>
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
            <input type="text" id="search" placeholder="Buscar por nombre, apellido, domicilio, discapacidad o DNI">

            <h1>Filtros</h1>
            <button class="noselect" id="reiniciarFiltros">
                <span class="text">Reiniciar</span><span class="material-icons">restart_alt</span>
            </button>
            <button class="accordion">
                <span class="material-icons">person</span>    
                Persona
                <span class="material-icons">expand_more</span> 
            </button>
            <div class="panel">
                <div class="panel_colum">
                    <div>
                        <h1>año</h1>
                        <select id="año_filter"></select>
                    </div>
                    <div>            
                        <h1>mes</h1>
                        <select id="mes_filter">
                            <option value="">Todos</option>
                            <option value="1">Enero</option>
                            <option value="2">Febrero</option>
                            <option value="3">Marzo</option>
                            <option value="4">Abril</option>
                            <option value="5">Mayo</option>
                            <option value="6">Junio</option>
                            <option value="7">Julio</option>
                            <option value="8">Agosto</option>
                            <option value="9">Septiembre</option>
                            <option value="10">Octubre</option>
                            <option value="11">Noviembre</option>
                            <option value="12">Diciembre</option>
                        </select>
                    </div>
                </div>
                <div class="panel_colum">
                    <div>
                        <h1>edad</h1>
                        <select id="edad_filter">
                            <option value="">Todos</option>
                            <option value="1">Menores de 18</option>
                            <option value="2">Entre 18 y 50</option>
                            <option value="3">Mayores de 50</option>
                        </select>
                    </div>
                    <div>
                        <h1>zona</h1>
                        <select id="zona_filter"></select>
                    </div>
                </div>
            </div>

            <button class="accordion">
                <span class="material-icons">favorite</span>   
                Salud
                <span class="material-icons">expand_more</span> 
            </button>
            <div class="panel">
                <div class="panel_colum">
                    <div>
                        <h1>CUD</h1>
                        <select id="cud_filter">
                            <option value="">Todos</option>
                            <option value="1">Con CUD</option>
                            <option value="0">Sin CUD</option>
                        </select>
                    </div>
                    <div>
                        <h1>Necesita asistencia</h1>
                        <select id="asistencia_filter">
                            <option value="">Todos</option>
                            <option value="1">Si</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                </div>
                <div class="panel_colum">
                    <div>
                        <h1>Tipo de discapacidad</h1>
                        <select id="discapacidad_filter"></select>
                    </div>
                    <div>
                    </div>
                </div>
            </div>

            <button class="accordion">
                <span class="material-icons">house</span> 
                Vivienda
                <span class="material-icons">expand_more</span> 
            </button>
            <div class="panel">
                <div class="panel_colum">
                    <div>
                        <h1>tipo de tenencia</h1>
                        <select id="tenencia_filter">
                            <option value="">Todos</option>
                            <option value="Propia">Propia</option>
                            <option value="Alquila">Alquila</option>
                            <option value="Cedida">Cedido</option>
                            <option value="Prestada">Prestada</option>
                            <option value="Usurpada">Usurpada</option>
                        </select>
                    </div>
                    <div>            
                        <h1>barreras arquitectonicas</h1>
                        <select id="barreras_filter"></select>
                    </div>
                </div>
                <div class="panel_colum">
                    <div>
                        <h1>ventilacion</h1>
                        <select id="ventilacion_filter"></select>
                    </div>
                    <div>
                        <h1>higiene</h1>
                        <select id="higiene_filter"></select>
                    </div>
                </div>
                <div class="panel_colum">
                    <div>
                        <h1>orden</h1>
                        <select id="orden_filter"></select>
                    </div>
                    <div>
                        <h1>iluminacion</h1>
                        <select id="iluminacion_filter"></select>
                    </div>
                </div>
            </div>

        </section>
        <p id="resultado_texto">Resultados encontrados: 0</p>
        <section class="tabla_registro">
            <table class="tabla_registro_datos_formulario">
                <thead>
                    <tr>
                        <th class="sortable" data-column="dni" data-order="asc">DNI <span class="sort-indicator"></span></th>
                        <th class="sortable" data-column="apellido" data-order="asc">Apellido <span class="sort-indicator"></span></th>
                        <th class="sortable" data-column="nombre" data-order="asc">Nombre <span class="sort-indicator"></span></th>
                        <th class="sortable" data-column="domicilio" data-order="asc">Domicilio <span class="sort-indicator"></span></th>
                    </tr>
                </thead>
                <tbody id="tabla_registro">
                    <!-- Los registros se cargarán dinámicamente aquí -->
                </tbody>
            </table>
        </section>
        <!-- Paginación -->
        <div class="pagination">
            <button class="ant_sig2" id="prevPage" disabled><i class="material-icons" style="padding-bottom: 3px; font-weight: bold; font-size: 25px;">keyboard_double_arrow_left</i>Anterior</button>
            <input type="number" id="currentPage" value="1" min="1">
            <span id="totalPages"> / 1</span>
            <button class="ant_sig1" id="nextPage">Siguiente <i class="material-icons" style="padding-bottom: 3px; font-size: 25px; font-weight: bold">keyboard_double_arrow_right</i></button>
        </div>
    </main>

    <?php include("footer.html"); ?>
    <script src="js/buscador_formulario.js"></script>
    <script src="js/navbar.js"></script>
    <script src="js/footer.js"></script>
</body>
</html>
