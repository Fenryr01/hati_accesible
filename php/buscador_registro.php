<?php
include("db.php");

// Variables para filtros, búsqueda y paginación
$search = isset($_GET['search']) ? $_GET['search'] : '';
$cud_filter = isset($_GET['cud_filter']) ? $_GET['cud_filter'] : '';
$visitado_filter = isset($_GET['visitado_filter']) ? $_GET['visitado_filter'] : '';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Página actual
$limite = 20; // Resultados por página
$offset = ($page - 1) * $limite; // Calcular el desplazamiento
$orderColumn = isset($_GET['orderColumn']) ? $_GET['orderColumn'] : 'apellido'; // Columna por la que se ordena
$orderDirection = isset($_GET['orderDirection']) ? $_GET['orderDirection'] : 'asc'; // Dirección del orden

// Query base
$query = "SELECT id, nombre, apellido, dni, direccion, visitado FROM registro_discapacidad WHERE 1=1";

// Agregar condiciones de búsqueda solo si existen
if (!empty($search)) {
    $query .= " AND (nombre LIKE '%$search%' OR apellido LIKE '%$search%' OR direccion LIKE '%$search%' OR dni LIKE '%$search%')";
}

// Filtrar por certificado de discapacidad (CUD)
if ($cud_filter !== '') {
    $query .= " AND certificado_discapacidad = $cud_filter";
}

// Filtrar por estado de "visitado"
if ($visitado_filter !== '') {
    $query .= " AND visitado = $visitado_filter";
}

// Ordenar los resultados, usando CAST(dni AS UNSIGNED) para orden numérico
if ($orderColumn == 'dni') {
    $query .= " ORDER BY CAST(dni AS UNSIGNED) $orderDirection";
} else {
    $query .= " ORDER BY $orderColumn $orderDirection";
}

// Contar el número total de resultados
$total_query = str_replace("SELECT id, nombre, apellido, dni, direccion, visitado", "SELECT COUNT(*) as total", $query);
$total_resultado = mysqli_query($conexion, $total_query);
$total_filas = mysqli_fetch_assoc($total_resultado)['total'];
$total_paginas = ceil($total_filas / $limite); // Calcular el total de páginas

// Ajustar el límite de la consulta
$query .= " LIMIT $offset, $limite";
$resultado = mysqli_query($conexion, $query);

// Construir el HTML de la tabla
$dataHtml = '';
while ($fila = mysqli_fetch_assoc($resultado)) {
    $checked = $fila['visitado'] ? 'checked' : '';
    $dataHtml .= "<tr class='data-row'>";
    $dataHtml .= "<td><div class='nombre-apellido-wrapper' data-id='" . $fila['id'] . "' onclick=\"window.location.href='persona_registro.php?id=" . $fila['id'] . "';\" style='cursor: pointer;'>" . htmlspecialchars($fila['dni']) . "</div></td>";
    $dataHtml .= "<td><div class='nombre-apellido-wrapper' data-id='" . $fila['id'] . "' onclick=\"window.location.href='persona_registro.php?id=" . $fila['id'] . "';\" style='cursor: pointer;'>" . htmlspecialchars($fila['apellido']) . "</div></td>";
    $dataHtml .= "<td><div class='nombre-apellido-wrapper' data-id='" . $fila['id'] . "' onclick=\"window.location.href='persona_registro.php?id=" . $fila['id'] . "';\" style='cursor: pointer;'>" . htmlspecialchars($fila['nombre']) . "</div></td>";
    $dataHtml .= "<td><div class='nombre-apellido-wrapper' data-id='" . $fila['id'] . "' onclick=\"window.location.href='persona_registro.php?id=" . $fila['id'] . "';\" style='cursor: pointer;'>" . htmlspecialchars($fila['direccion']) . "</div></td>";
    $dataHtml .= "<td><label class='switch'><input type='checkbox' class='visitado-checkbox' data-id='" . $fila['id'] . "' $checked /><span class='slider'></span><span class='knob'></span></label></td>";
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
