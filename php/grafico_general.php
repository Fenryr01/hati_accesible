<?php
header("Content-Type: application/json");

include("db.php"); // Conexión a la base de datos

$graficos = [];

// 1. Consulta para contar la cantidad total de personas
$sql_personas = "SELECT COUNT(*) AS cantidad_personas FROM personas";
$result_personas = $conexion->query($sql_personas);

// 2. Consulta para contar la cantidad de registros en registro_discapacidad
$sql_discapacidad = "SELECT COUNT(*) AS cantidad_discapacidad FROM registro_discapacidad";
$result_discapacidad = $conexion->query($sql_discapacidad);

// 3. Consulta para contar la cantidad de personas por zona
$sql_zonas = "SELECT zonas.zona, COUNT(personas.zona) AS cantidad_personas_por_zona 
              FROM personas 
              JOIN zonas ON personas.zona = zonas.id 
              GROUP BY zonas.zona";
$result_zonas = $conexion->query($sql_zonas);

// 4. Consulta para calcular la edad de las personas
$sql_edades = "SELECT TIMESTAMPDIFF(YEAR, nacimiento, CURDATE()) AS edad FROM personas";
$result_edades = $conexion->query($sql_edades);

// Inicializamos los contadores de edades por intervalo
$rangos_edades = [
    "0-9" => 0,
    "10-19" => 0,
    "20-29" => 0,
    "30-39" => 0,
    "40-49" => 0,
    "50-59" => 0,
    "60-69" => 0,
    "70-79" => 0,
    "80+" => 0
];

if ($result_personas && $result_discapacidad && $result_zonas && $result_edades) {
    $row_personas = $result_personas->fetch_assoc();
    $row_discapacidad = $result_discapacidad->fetch_assoc();

    // Crear gráfico 1: Comparación de la cantidad de personas y discapacidad
    $graficos[] = [
        "titulo" => "Cantidad de personas",
        "data" => [
            (int)$row_personas["cantidad_personas"], 
            (int)$row_discapacidad["cantidad_discapacidad"]
        ],
        "categories" => ["Formulario", "Registro"]
    ];

    // Crear gráfico 2: Cantidad de personas por zona
    $zonas = [];
    $cantidad_personas_por_zona = [];
    while ($row_zona = $result_zonas->fetch_assoc()) {
        $zonas[] = $row_zona["zona"]; // Usamos el nombre de la zona
        $cantidad_personas_por_zona[] = (int)$row_zona["cantidad_personas_por_zona"]; // Contamos las personas por zona
    }

    $graficos[] = [
        "titulo" => "Cantidad de Personas por Zona",
        "data" => $cantidad_personas_por_zona,
        "categories" => $zonas
    ];

    // Crear gráfico 3: Edades de las personas (intervalos de 10 años)
    while ($row_edad = $result_edades->fetch_assoc()) {
        $edad = $row_edad['edad'];

        if ($edad < 10) {
            $rangos_edades["0-9"]++;
        } elseif ($edad < 20) {
            $rangos_edades["10-19"]++;
        } elseif ($edad < 30) {
            $rangos_edades["20-29"]++;
        } elseif ($edad < 40) {
            $rangos_edades["30-39"]++;
        } elseif ($edad < 50) {
            $rangos_edades["40-49"]++;
        } elseif ($edad < 60) {
            $rangos_edades["50-59"]++;
        } elseif ($edad < 70) {
            $rangos_edades["60-69"]++;
        } elseif ($edad < 80) {
            $rangos_edades["70-79"]++;
        } else {
            $rangos_edades["80+"]++;
        }
    }

    // Añadir el gráfico de edades al arreglo de gráficos
    $graficos[] = [
        "titulo" => "Distribución por edades",
        "data" => array_values($rangos_edades),
        "categories" => array_keys($rangos_edades)
    ];

    // Devolver los datos en formato JSON
    echo json_encode($graficos);
} else {
    // En caso de error en la consulta
    echo json_encode(["error" => "Error al obtener los datos"]);
}

$conexion->close();
?>
