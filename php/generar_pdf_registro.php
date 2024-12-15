<?php
require('../fpdf/fpdf.php');
include("db.php");

$search = $_GET['search'] ?? '';
$cud_filter = $_GET['cud_filter'] ?? '';
$visitado_filter = $_GET['visitado_filter'] ?? '';

$query = "SELECT nombre, apellido, dni, direccion, telefono, correo_electronico, certificado_discapacidad, quienes, visitado, fecha_registro 
          FROM registro_discapacidad 
          WHERE 1=1";

// Aplicar filtros de búsqueda si existen
if (!empty($search)) {
    $query .= " AND (nombre LIKE '%$search%' OR apellido LIKE '%$search%' OR direccion LIKE '%$search%' OR dni LIKE '%$search%')";
}
if ($cud_filter !== '') {
    $query .= " AND certificado_discapacidad = $cud_filter";
}
if ($visitado_filter !== '') {
    $query .= " AND visitado = $visitado_filter";
}

// Ordenar por apellido
$query .= " ORDER BY apellido";

// Ejecutar la consulta
$resultado = mysqli_query($conexion, $query);

class PDF extends FPDF {
    // Sobrescribir el método Footer()
    function Footer() {
        // Posicionar el número de página
        $this->SetY(-15); // 15mm desde el final
        $this->SetFont('Arial', 'I', 8); // Fuente itálica, tamaño 8
        $this->Cell(0, 10, iconv('UTF-8', 'windows-1252', 'Página ' . $this->PageNo() . ' de {nb}'), 0, 0, 'C');
    }
}

// Luego, para crear el PDF:
$pdf = new PDF();
$pdf->AddPage();
$pdf->AliasNbPages(); // Alias para el número total de páginas

// --- Portada ---

// Espacio inicial para asegurar que todo cabe en la página
$pdf->Ln(40);

// Título centrado
$pdf->SetFont('Arial', 'B', 40);
$pdf->Cell(0, 10, 'Direccion de Accesibilidad', 0, 1, 'C');
$pdf->Ln(10); // Espacio después del título

// Logo
$pdf->Image('../img/logo_accesibilidad_ok.png', 85, 70, 40, 40, 'PNG'); // Ajustar ruta, x, y, ancho, alto

$pdf->Ln(60); // Espacio después del logo

// Subtítulo centrado
$pdf->SetFont('Arial', 'B', 25);
$pdf->Cell(0, 10, 'Lista de Personas Registradas', 0, 1, 'C');
$pdf->Ln(10); // Espacio después del subtítulo

// Filtros activos
$filtros_activos = [];
if ($cud_filter !== '') {
    $filtros_activos[] = 'Filtro por CUD: ' . ($cud_filter == '1' ? 'Sí' : 'No');
}
if (!empty($search)) {
    $filtros_activos[] = 'Filtro por búsqueda: ' . $search;
}
if ($visitado_filter !== '') {
    $filtros_activos[] = 'Filtro por Visitado: ' . ($visitado_filter == '1' ? 'Sí' : 'No');
}

if (count($filtros_activos) > 0) {
    $pdf->SetFont('Arial', '', 15);
    $pdf->Cell(0, 10, iconv('UTF-8', 'windows-1252', implode(' | ', $filtros_activos)), 0, 1, 'C');
}
$pdf->Ln(20); // Espacio antes de los registros

// --- Información del desarrollador ---
// Ajustar la posición para asegurarnos de que no se pase a la segunda página
$pdf->SetY(-45); // Ajustamos para que esté más cerca del final, pero no se pase a la segunda página
$pdf->SetX(10); // Establecemos un margen desde el borde izquierdo (puedes ajustar el valor)

$pdf->SetFont('Arial', 'I', 12);
$pdf->Cell(0, 10, iconv('UTF-8', 'windows-1252', '© 2024 Diego A. Selva'), 0, 1, 'L'); // Alineado a la izquierda
$pdf->Cell(0, 10, iconv('UTF-8', 'windows-1252', 'diegoselva92@gmail.com'), 0, 1, 'L'); // Alineado a la izquierda

// --- Fin de portada ---



$pdf->AddPage(); // Nueva página para los registros

// Título del documento
$pdf->SetFont('Arial', 'B', 14);
$pdf->Ln(5); // Espacio después del título

// Iterar los registros
while ($row = mysqli_fetch_assoc($resultado)) {
    // Nombre completo como título en mayúsculas
    $pdf->SetFont('Arial', 'B', 16); // Título en negrita y más grande
    $nombre_completo = strtoupper($row['apellido'] ?? '') . " " . strtoupper($row['nombre'] ?? '');
    $pdf->Cell(0, 10, iconv('UTF-8', 'windows-1252', $nombre_completo), 0, 1, 'L');
    $pdf->Ln(3); // Espacio después del nombre

    // Detalles de la persona
    $pdf->SetFont('Arial', 'B', 12); // Negrita para los títulos
    $pdf->Cell(40, 10, 'DNI:', 0, 0);
    $pdf->SetFont('Arial', '', 12); // Normal para los datos
    $pdf->Cell(0, 10, iconv('UTF-8', 'windows-1252', $row['dni'] ?? ''), 0, 1);

    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(40, 10, 'Direccion:', 0, 0);
    $pdf->SetFont('Arial', '', 12);
    $pdf->MultiCell(0, 10, iconv('UTF-8', 'windows-1252', $row['direccion'] ?? ''), 0, 1); // MultiCell para texto largo

    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(40, 10, 'Telefono:', 0, 0);
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, iconv('UTF-8', 'windows-1252', $row['telefono'] ?? ''), 0, 1);

    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(40, 10, 'Correo:', 0, 0);
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, iconv('UTF-8', 'windows-1252', $row['correo_electronico'] ?? ''), 0, 1);

    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(40, 10, 'Certificado CUD:', 0, 0);
    $pdf->SetFont('Arial', '', 12);
    $certificado = isset($row['certificado_discapacidad']) ? ($row['certificado_discapacidad'] ? 'Sí' : 'No') : '';
    $pdf->Cell(0, 10, iconv('UTF-8', 'windows-1252', $certificado), 0, 1);

    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(40, 10, 'Quienes:', 0, 0);
    $pdf->SetFont('Arial', '', 12);
    $pdf->MultiCell(0, 10, iconv('UTF-8', 'windows-1252', $row['quienes'] ?? ''), 0, 1);

    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(40, 10, 'Visitado:', 0, 0);
    $pdf->SetFont('Arial', '', 12);
    $visitado = isset($row['visitado']) ? ($row['visitado'] ? 'Sí' : 'No') : '';
    $pdf->Cell(0, 10, iconv('UTF-8', 'windows-1252', $visitado), 0, 1);

    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(40, 10, 'Fecha Registro:', 0, 0);
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, iconv('UTF-8', 'windows-1252', $row['fecha_registro'] ?? ''), 0, 1);

    $pdf->Ln(20); // Espacio entre registros
}

// Mostrar número de páginas
$pdf->Output('D', 'Registros.pdf'); // Descargar el archivo
exit;
?>
