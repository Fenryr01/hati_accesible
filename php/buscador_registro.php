<?php
include("db.php");

// Variables para filtros y búsqueda
$search = isset($_GET['search']) ? $_GET['search'] : '';
$cud_filter = isset($_GET['cud_filter']) ? $_GET['cud_filter'] : '';
$visitado_filter = isset($_GET['visitado_filter']) ? $_GET['visitado_filter'] : '';
$sort_column = isset($_GET['sort_column']) ? $_GET['sort_column'] : 'apellido';
$sort_order = isset($_GET['sort_order']) && in_array($_GET['sort_order'], ['asc', 'desc']) ? $_GET['sort_order'] : 'asc';

// Query base
$query = "SELECT id, nombre, apellido, visitado FROM registro_discapacidad WHERE 1=1";

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

// Agregar la cláusula ORDER BY para ordenar los resultados
$query .= " ORDER BY $sort_column $sort_order";

// Ejecutar la consulta
$resultado = mysqli_query($conexion, $query);

// Contar el número de resultados
$total_resultados = mysqli_num_rows($resultado);



// Mostrar todos los registros si no hay filtros aplicados
while ($fila = mysqli_fetch_assoc($resultado)) {
    $checked = $fila['visitado'] ? 'checked' : '';
    echo "<tr class='data-row'>";
    echo "<td>" . htmlspecialchars($fila['apellido']) . "</td>";
    echo "<td>" . htmlspecialchars($fila['nombre']) . "</td>";
    echo "<td>
            <label class='switch'>
                <input type='checkbox' class='visitado-checkbox' data-id='" . $fila['id'] . "' $checked />
                <span class='slider'></span>
                <span class='knob'></span>
            </label>
        </td>";
    echo "</tr>";
}



// Liberar el resultado y cerrar la conexión
mysqli_free_result($resultado);
mysqli_close($conexion);
?>
