<?php
header("Content-Type: application/json");

include("db.php"); // Conexión a la base de datos

$graficos = [];

$abreviaturas = [
    "CEA (Condición del Espectro Autista)" => "CEA",
];


// 1. Consulta: Cantidad de personas por necesidades
$sql_necesidades = "
    SELECT 'Necesita asistencia' AS categoria, COUNT(*) AS cantidad 
    FROM personas 
    WHERE necesita_asistencia = 1
    UNION ALL
    SELECT 'Tiene CUD', COUNT(*) 
    FROM personas 
    WHERE cud = 1
    UNION ALL
    SELECT 'Cobra pensión', COUNT(*) 
    FROM personas 
    WHERE cobra_pension = 1;
";

$result_necesidades = $conexion->query($sql_necesidades);

if ($result_necesidades) {
    $necesidades = [];
    $categorias_necesidades = [];

    // Procesar los resultados
    while ($row = $result_necesidades->fetch_assoc()) {
        $categorias_necesidades[] = $row["categoria"];
        $necesidades[] = (int)$row["cantidad"];
    }

    // Crear el gráfico: Cantidad de personas por necesidad
    $graficos[] = [
        "titulo" => "Cantidad de personas por necesidad",
        "data" => $necesidades,
        "categories" => $categorias_necesidades
    ];
}

// 2. Consulta: Personas que necesitan asistencia por tipo de discapacidad
$sql_asistencia_discapacidad = "
    SELECT qd.cual_discapacidad AS tipo_discapacidad, COUNT(*) AS cantidad
    FROM discapacidades d
    JOIN personas p ON d.persona_id = p.id
    JOIN que_discapacidad qd ON d.tipo_discapacidad = qd.id
    WHERE p.necesita_asistencia = 1
    GROUP BY qd.cual_discapacidad
    ORDER BY cantidad DESC;
";

$result_asistencia_discapacidad = $conexion->query($sql_asistencia_discapacidad);

if ($result_asistencia_discapacidad) {
    $categorias_discapacidad = [];
    $cantidades_discapacidad = [];
    $labels_discapacidad = [];

    // Procesar resultados
    while ($row = $result_asistencia_discapacidad->fetch_assoc()) {
        $nombre_original = $row["tipo_discapacidad"];
        
        // Verificar si hay una abreviatura para el nombre
        $nombre_abreviado = isset($abreviaturas[$nombre_original]) ? $abreviaturas[$nombre_original] : $nombre_original;

        // Guardar datos para leyenda y label
        $categorias_discapacidad[] = $nombre_original; // Para la leyenda
        $labels_discapacidad[] = $nombre_abreviado;    // Para el label
        $cantidades_discapacidad[] = (int)$row["cantidad"];
    }

    // Crear el gráfico: Personas que necesitan asistencia por tipo de discapacidad
    $graficos[] = [
        "titulo" => "Necesitan asistencia por tipo de discapacidad",
        "data" => $cantidades_discapacidad,
        "categories" => $categorias_discapacidad,
        "labels" => $labels_discapacidad
    ];

    // 3. Consulta: Comparar tipos de discapacidad con rango de edades
    $sql_discapacidad_edades = "
    SELECT 
        qd.cual_discapacidad AS tipo_discapacidad,
        CASE
            WHEN (YEAR(CURDATE()) - YEAR(p.nacimiento)) < 10 THEN '0-9'
            WHEN (YEAR(CURDATE()) - YEAR(p.nacimiento)) BETWEEN 10 AND 19 THEN '10-19'
            WHEN (YEAR(CURDATE()) - YEAR(p.nacimiento)) BETWEEN 20 AND 29 THEN '20-29'
            WHEN (YEAR(CURDATE()) - YEAR(p.nacimiento)) BETWEEN 30 AND 39 THEN '30-39'
            WHEN (YEAR(CURDATE()) - YEAR(p.nacimiento)) BETWEEN 40 AND 49 THEN '40-49'
            WHEN (YEAR(CURDATE()) - YEAR(p.nacimiento)) BETWEEN 50 AND 59 THEN '50-59'
            WHEN (YEAR(CURDATE()) - YEAR(p.nacimiento)) BETWEEN 60 AND 69 THEN '60-69'
            WHEN (YEAR(CURDATE()) - YEAR(p.nacimiento)) BETWEEN 70 AND 79 THEN '70-79'
            ELSE '80+'
        END AS rango_edad,
        COUNT(*) AS cantidad
    FROM discapacidades d
    JOIN personas p ON d.persona_id = p.id
    JOIN que_discapacidad qd ON d.tipo_discapacidad = qd.id
    GROUP BY qd.cual_discapacidad, rango_edad
    ORDER BY qd.cual_discapacidad, rango_edad;
    ";

    $result_discapacidad_edades = $conexion->query($sql_discapacidad_edades);

    if ($result_discapacidad_edades) {
    $datos_discapacidad_edades = [];

    // Procesar resultados
    while ($row = $result_discapacidad_edades->fetch_assoc()) {
        $tipo_discapacidad = $row["tipo_discapacidad"];
        $rango_edad = $row["rango_edad"];
        $cantidad = (int)$row["cantidad"];

        if (!isset($datos_discapacidad_edades[$tipo_discapacidad])) {
            $datos_discapacidad_edades[$tipo_discapacidad] = [];
        }

        $datos_discapacidad_edades[$tipo_discapacidad][$rango_edad] = $cantidad;
    }

    // Reorganizar datos para el gráfico
    $rango_edades = ['0-9', '10-19', '20-29', '30-39', '40-49', '50-59', '60-69', '70-79', '80+'];
    $series = [];
    foreach ($datos_discapacidad_edades as $tipo_discapacidad => $data) {
        $serie = [
            "name" => $tipo_discapacidad,
            "data" => []
        ];

        // Asegurarse de que todos los rangos de edad estén presentes
        foreach ($rango_edades as $rango) {
            $serie["data"][] = $data[$rango] ?? 0; // Si no hay datos para el rango, usar 0
        }

        $series[] = $serie;
    }

    $graficos[] = [
        "titulo" => "Tipos de discapacidad por rango de edades",
        "series" => $series,
        "categories" => $rango_edades
    ];
    }

    // 4. Consulta: Tipos de discapacidad por zonas
    $sql_discapacidad_zonas = "
    SELECT 
        z.zona AS nombre_zona,
        qd.cual_discapacidad AS tipo_discapacidad,
        COUNT(*) AS cantidad
    FROM personas p
    JOIN zonas z ON p.zona = z.id
    JOIN discapacidades d ON p.id = d.persona_id
    JOIN que_discapacidad qd ON d.tipo_discapacidad = qd.id
    GROUP BY z.zona, qd.cual_discapacidad
    ORDER BY z.zona, qd.cual_discapacidad;
    ";

    $result_discapacidad_zonas = $conexion->query($sql_discapacidad_zonas);

    if ($result_discapacidad_zonas) {
    $datos_zonas = [];
    $categorias_zonas = [];
    $series_zonas = [];

    // Procesar resultados
    while ($row = $result_discapacidad_zonas->fetch_assoc()) {
        $zona = $row["nombre_zona"];
        $tipo_discapacidad = $row["tipo_discapacidad"];
        $cantidad = (int)$row["cantidad"];

        if (!isset($datos_zonas[$tipo_discapacidad])) {
            $datos_zonas[$tipo_discapacidad] = [];
        }

        $datos_zonas[$tipo_discapacidad][$zona] = $cantidad;

        if (!in_array($zona, $categorias_zonas)) {
            $categorias_zonas[] = $zona;
        }
    }

    // Reorganizar datos para el gráfico
    foreach ($datos_zonas as $tipo_discapacidad => $data) {
        $serie = [
            "name" => $tipo_discapacidad,
            "data" => []
        ];

        // Asegurarse de que todas las zonas estén presentes
        foreach ($categorias_zonas as $zona) {
            $serie["data"][] = $data[$zona] ?? 0; // Si no hay datos para la zona, usar 0
        }

        $series_zonas[] = $serie;
    }

    $graficos[] = [
        "titulo" => "Tipos de discapacidad por zonas",
        "series" => $series_zonas,
        "categories" => $categorias_zonas
    ];
    } else {
    $graficos[] = ["error" => "Error al obtener datos de discapacidad por zonas"];
    }




} else {
    // En caso de error en la consulta
    $graficos[] = ["error" => "Error al obtener datos de asistencia y discapacidad"];
}

// Devolver los datos en formato JSON
echo json_encode($graficos);

$conexion->close();
?>