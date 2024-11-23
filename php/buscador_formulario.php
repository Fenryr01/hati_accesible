<?php
include("db.php");

// Variables para filtros, búsqueda y paginación
$search = isset($_GET['search']) ? $_GET['search'] : '';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Página actual
$limite = 20; // Resultados por página
$offset = ($page - 1) * $limite; // Calcular el desplazamiento
$orderColumn = isset($_GET['orderColumn']) ? $_GET['orderColumn'] : 'apellido'; // Columna por la que se ordena
$orderDirection = isset($_GET['orderDirection']) ? $_GET['orderDirection'] : 'asc'; // Dirección del orden
// filtros
$cud_filter = isset($_GET['cud_filter']) ? $_GET['cud_filter'] : '';
$asistencia_filter = isset($_GET['asistencia_filter']) ? $_GET['asistencia_filter'] : '';
$discapacidad_filter = isset($_GET['discapacidad_filter']) ? $_GET['discapacidad_filter'] : '';
$zona_filter = isset($_GET['zona_filter']) ? $_GET['zona_filter'] : '';
$edad_filter = isset($_GET['edad_filter']) ? $_GET['edad_filter'] : '';
$tenencia_filter = isset($_GET['tenencia_filter']) ? $_GET['tenencia_filter'] : '';
$iluminacion_filter = isset($_GET['iluminacion_filter']) ? $_GET['iluminacion_filter'] : '';
$ventilacion_filter = isset($_GET['ventilacion_filter']) ? $_GET['ventilacion_filter'] : '';
$higiene_filter = isset($_GET['higiene_filter']) ? $_GET['higiene_filter'] : '';
$orden_filter = isset($_GET['orden_filter']) ? $_GET['orden_filter'] : '';
$barreras_filter = isset($_GET['barreras_filter']) ? $_GET['barreras_filter'] : '';
$año_filter = isset($_GET['año_filter']) ? $_GET['año_filter'] : '';
$mes_filter = isset($_GET['mes_filter']) ? $_GET['mes_filter'] : '';



// Query base para seleccionar solo las columnas de la tabla personas, sin duplicados
$query = "SELECT DISTINCT p.id, p.nombre, p.apellido, p.dni, p.domicilio, p.nacimiento, p.tipo_tenencia, p.ventilacion, p.iluminacion, p.higiene, p.orden, p.barreras_arquitectonicas, p.fecha_formulario
          FROM personas p
          LEFT JOIN discapacidades d ON d.persona_id = p.id
          WHERE 1=1";

// Agregar condiciones de búsqueda solo si existen
if (!empty($search)) {
    $query .= " AND (p.nombre LIKE '%$search%' 
                     OR p.apellido LIKE '%$search%' 
                     OR p.domicilio LIKE '%$search%' 
                     OR p.dni LIKE '%$search%' 
                     OR EXISTS (
                         SELECT 1 FROM discapacidades d 
                         WHERE d.persona_id = p.id AND d.discapacidad LIKE '%$search%'
                     ))";
}

// Filtrar por certificado de discapacidad (CUD)
if ($cud_filter !== '') {
    $query .= " AND p.cud = $cud_filter";
}

// Filtrar por asistencia
if ($asistencia_filter !== '') {
    $query .= " AND p.necesita_asistencia = $asistencia_filter";
}

// Filtrar por discapacidad 
if ($discapacidad_filter !== '') {
    $query .= " AND d.tipo_discapacidad = $discapacidad_filter"; 
}

// Filtrar por zona
if ($zona_filter !== '') {
    $query .= " AND p.zona = $zona_filter";
}

// Filtrar por edad
if ($edad_filter !== '') {
    switch ($edad_filter) {
        case '1': // Menores de 18 años
            $query .= " AND TIMESTAMPDIFF(YEAR, p.nacimiento, CURDATE()) < 18";
            break;
        case '2': // Entre 18 y 50 años
            $query .= " AND TIMESTAMPDIFF(YEAR, p.nacimiento, CURDATE()) BETWEEN 18 AND 50";
            break;
        case '3': // Mayores de 50 años
            $query .= " AND TIMESTAMPDIFF(YEAR, p.nacimiento, CURDATE()) > 50";
            break;
    }
}

// Filtrar por tenencia
if ($tenencia_filter !== '') {
    $query .= " AND p.tipo_tenencia = '" . mysqli_real_escape_string($conexion, $tenencia_filter) . "'";
}

// Filtrar por higiene
if ($higiene_filter !== '') {
    $query .= " AND p.higiene = $higiene_filter";
}

// Filtrar por ventilacion
if ($ventilacion_filter !== '') {
    $query .= " AND p.ventilacion = $ventilacion_filter";
}

// Filtrar por iluminacion
if ($iluminacion_filter !== '') {
    $query .= " AND p.iluminacion = $iluminacion_filter";
}

// Filtrar por orden
if ($orden_filter !== '') {
    $query .= " AND p.orden = $orden_filter";
}

// Filtrar por barreras
if ($barreras_filter !== '') {
    $query .= " AND p.barreras_arquitectonicas = $barreras_filter";
}

// Filtrar por año
if ($año_filter !== '') {
    $query .= " AND YEAR(p.fecha_formulario) = $año_filter";
}

// Filtrar por mes
if ($mes_filter !== '') {
    $query .= " AND MONTH(p.fecha_formulario) = $mes_filter";
}

// Ordenar los resultados, usando CAST(dni AS UNSIGNED) para orden numérico
if ($orderColumn == 'dni') {
    $query .= " ORDER BY CAST(dni AS UNSIGNED) $orderDirection";
} else {
    $query .= " ORDER BY $orderColumn $orderDirection";
}

// Contar el número total de resultados
$total_query = str_replace("SELECT DISTINCT p.id, p.nombre, p.apellido, p.dni, p.domicilio", "SELECT COUNT(DISTINCT p.id) as total", $query);
$total_resultado = mysqli_query($conexion, $total_query);
$total_filas = mysqli_fetch_assoc($total_resultado)['total'];
$total_paginas = ceil($total_filas / $limite); // Calcular el total de páginas

// Ajustar el límite de la consulta
$query .= " LIMIT $offset, $limite";
$resultado = mysqli_query($conexion, $query);

// Construir el HTML de la tabla
$dataHtml = '';
while ($fila = mysqli_fetch_assoc($resultado)) {
    $dataHtml .= "<tr class='data-row'>";
    $dataHtml .= "<td><div class='nombre-apellido-wrapper' data-id='" . $fila['id'] . "' onclick=\"window.location.href='persona_formulario.php?id=" . $fila['id'] . "';\" style='cursor: pointer;'>" . htmlspecialchars($fila['dni']) . "</div></td>";
    $dataHtml .= "<td><div class='nombre-apellido-wrapper' data-id='" . $fila['id'] . "' onclick=\"window.location.href='persona_formulario.php?id=" . $fila['id'] . "';\" style='cursor: pointer;'>" . htmlspecialchars($fila['apellido']) . "</div></td>";
    $dataHtml .= "<td><div class='nombre-apellido-wrapper' data-id='" . $fila['id'] . "' onclick=\"window.location.href='persona_formulario.php?id=" . $fila['id'] . "';\" style='cursor: pointer;'>" . htmlspecialchars($fila['nombre']) . "</div></td>";
    $dataHtml .= "<td><div class='nombre-apellido-wrapper' data-id='" . $fila['id'] . "' onclick=\"window.location.href='persona_formulario.php?id=" . $fila['id'] . "';\" style='cursor: pointer;'>" . htmlspecialchars($fila['domicilio']) . "</div></td>";
    $dataHtml .= "</tr>";
}

// Liberar el resultado y cerrar la conexión
mysqli_free_result($resultado);
mysqli_close($conexion);

// Limpiar espacios en blanco y saltos de línea
$dataHtml = preg_replace("/\s+/", " ", $dataHtml);

// Devolver los datos en formato JSON
echo json_encode([
    'data' => $dataHtml,
    'total_results' => $total_filas,
    'total_pages' => $total_paginas,
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
?>
