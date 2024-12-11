<?php
header("Content-Type: application/json");

include("db.php"); // Conexión a la base de datos

$graficos = [];

// Consulta para calcular el promedio de cada categoría
$sql_promedios = "
    SELECT 'Ventilación' AS categoria, AVG(ventilacion) AS promedio FROM personas
    UNION ALL
    SELECT 'Iluminación', AVG(iluminacion) FROM personas
    UNION ALL
    SELECT 'Higiene', AVG(higiene) FROM personas
    UNION ALL
    SELECT 'Orden', AVG(orden) FROM personas
    UNION ALL
    SELECT 'Barreras Arquitectónicas', AVG(barreras_arquitectonicas) FROM personas
";

// Consulta para contar cuántas personas eligieron cada nivel (1-5) en cada categoría
$sql_cantidades = "
    SELECT 'Ventilación' AS categoria, ventilacion AS nivel, COUNT(*) AS cantidad 
    FROM personas 
    GROUP BY ventilacion
    UNION ALL
    SELECT 'Iluminación', iluminacion, COUNT(*) 
    FROM personas 
    GROUP BY iluminacion
    UNION ALL
    SELECT 'Higiene', higiene, COUNT(*) 
    FROM personas 
    GROUP BY higiene
    UNION ALL
    SELECT 'Orden', orden, COUNT(*) 
    FROM personas 
    GROUP BY orden
    UNION ALL
    SELECT 'Barreras Arquitectónicas', barreras_arquitectonicas, COUNT(*) 
    FROM personas 
    GROUP BY barreras_arquitectonicas
";

// Consulta para obtener el porcentaje de personas según procedencia de agua
$sql_procedencia_agua = "
    SELECT procedencia_agua, COUNT(*) AS cantidad
    FROM personas
    GROUP BY procedencia_agua
";

$result_promedios = $conexion->query($sql_promedios);
$result_cantidades = $conexion->query($sql_cantidades);
$result_procedencia_agua = $conexion->query($sql_procedencia_agua);


if ($result_promedios && $result_cantidades) {
    $promedios = [];
    $categorias = [];
    $cantidades = [];
    $niveles = [1, 2, 3, 4, 5]; // Definir los niveles (1-5)

    // Procesar los promedios
    while ($row = $result_promedios->fetch_assoc()) {
        // Cambiar "Barreras Arquitectónicas" por "B.A."
        $categoria = $row["categoria"];
        $categorias[] = $categoria;
        $promedios[] = (float)$row["promedio"];
    }

    // Procesar las cantidades para cada nivel (1-5)
    $cantidades_por_categoria = [];
    foreach ($niveles as $nivel) {
        $cantidades_por_categoria[$nivel] = [];
    }

    while ($row = $result_cantidades->fetch_assoc()) {
        // Cambiar "Barreras Arquitectónicas" por "B.A."
        $categoria = $row["categoria"];
        $nivel = (int)$row["nivel"];
        $cantidad = (int)$row["cantidad"];

        // Asegurarse de que la categoría exista en el arreglo
        if (!isset($cantidades_por_categoria[$categoria])) {
            $cantidades_por_categoria[$categoria] = [];
        }

        $cantidades_por_categoria[$categoria][$nivel] = $cantidad;
    }

    // Formato para el gráfico de barras agrupadas
    $niveles_data = [];
    foreach ($niveles as $nivel) {
        // Crear una serie para cada nivel (1-5)
        $niveles_data[] = [
            'name' => 'Nivel ' . $nivel, // Nombre de la serie (Nivel 1, Nivel 2, etc.)
            'data' => [] // Inicializa los datos para cada nivel
        ];
    }

    // Asignar las cantidades a cada serie
    foreach ($categorias as $categoria) {
        foreach ($niveles as $index => $nivel) {
            $niveles_data[$index]['data'][] = isset($cantidades_por_categoria[$categoria][$nivel]) 
                                            ? $cantidades_por_categoria[$categoria][$nivel] 
                                            : 0;
        }
    }

    // Creacion procedencia de agua
    $data_procedencia_agua = [];
    $categorias_procedencia_agua = [];
    while ($row = $result_procedencia_agua->fetch_assoc()) {
        $categorias_procedencia_agua[] = $row["procedencia_agua"];
        $data_procedencia_agua[] = (int)$row["cantidad"];
    }


    // Crear gráfico 1: Promedio de condiciones de vida
    $graficos[] = [
        "titulo" => "Puntuación promedio de condiciones de vida",
        "data" => $promedios,
        "categories" => $categorias
    ];

    // Crear gráfico 2: Cantidad de personas por nivel (1-5) en cada categoría
    $graficos[] = [
        "titulo" => "Distribución de niveles por categoría",
        "series" => $niveles_data, // Pasar las series (niveles 1-5) al JS
        "categories" => $categorias
    ];

    // Crear gráfico 3: Porcentaje de personas según procedencia de agua
    $graficos[] = [
        "titulo" => "Porcentaje de personas según procedencia de agua",
        "data" => $data_procedencia_agua,
        "categories" => $categorias_procedencia_agua,
        "tipo" => "torta"
    ];

    // Devolver los datos en formato JSON
    echo json_encode($graficos);
} else {
    // En caso de error en la consulta
    echo json_encode(["error" => "Error al obtener los datos"]);
}

$conexion->close();
?>
