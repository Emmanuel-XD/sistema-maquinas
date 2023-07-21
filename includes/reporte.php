<?php
require('../fpdf/fpdf.php');

class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        $this->SetFont('Arial', 'B', 16);
        $this->Cell(0, 10, utf8_decode('REPORTE DE MAQUINARIAS'), 0, 1, 'C');

        $this->SetFont('Arial', '', 15);
        $this->Cell(0, 10, 'CONTROL DE MAQUINARIA', 0, 1, 'C');

        $this->SetFont('Helvetica', '', 11);
        $this->Cell(60, 10, 'Maquina:', 0, 0, 'C');
        $this->Cell(60, 10, 'Modelo:', 0, 0, 'C');
        $this->Cell(60, 10, 'Serie:', 0, 0, 'C');
        $this->Cell(60, 10, 'Ubicacion:', 0, 0, 'C');
        $this->Cell(60, 10, 'Estatus:', 0, 0, 'C');
        $this->Cell(60, 10, 'Mantenimiento:', 0, 0, 'C');
        $this->Cell(60, 10, 'Total de HRS Activa:', 0, 0, 'C');
        $this->Cell(60, 10, 'Total de HRS Parada:', 0, 1, 'C');

        $this->SetFont('Arial', 'B', 17);
        $this->Image('../img/Logo-Primario (1).png', 5, 4, 45);  // X, Y, Tamaño

        // Table header
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(40, 10, 'Operador', 1, 0, 'C', 0);
        $this->Cell(25, 10, 'Fecha', 1, 0, 'C', 0);
        $this->Cell(27, 10, 'Hrs Trab.', 1, 0, 'C', 0);
        $this->Cell(27, 10, 'Hrs In', 1, 0, 'C', 0);
        $this->Cell(23, 10, 'HRMT Ini', 1, 0, 'C', 0);
        $this->Cell(23, 10, 'HRMT Ter', 1, 0, 'C', 0);
        $this->Cell(25, 10, 'Falla', 1, 0, 'C', 0);
        $this->Cell(23, 10, 'Hra Paro', 1, 0, 'C', 0);
        $this->Cell(23, 10, 'Hra Reinicio', 1, 0, 'C', 0);
        $this->Cell(22, 10, 'Gastos', 1, 0, 'C', 0);
        $this->Cell(78, 10, 'Observacion', 1, 1, 'C', 0);
    }

    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);

        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Número de página
        $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
    }
}
include_once "db.php";
// Check if the required parameters are set
if (isset($_GET['idm'], $_GET['fecha1'], $_GET['fecha2'])) {

    $idMaquina = $_GET['idm'];
    $fecha1 = $_GET['fecha1'];
    $fecha2 = $_GET['fecha2'];
    $query = "SELECT i.id, i.id_maquina, i.id_operador, i.observacion, i.horas_t, i.horas_in, i.horometraje_i, i.horometraje_f,
                i.lugar_t, i.fallo, i.hora_paro, i.hora_reinicio, i.fecha, i.gastos_falla, o.nombre
                FROM inventario i 
                INNER JOIN operadores o ON i.id_operador = o.id
                WHERE i.id_maquina = '$idMaquina' AND i.fecha BETWEEN '$fecha1' AND '$fecha2';";
    $result = mysqli_query($conexion, $query);



    $pdf = new PDF('L', 'mm', 'Legal');
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial', '', 0);

    while ($row = $result->fetch_array()) {
        $pdf->Cell(40, 10, utf8_decode($row['id_operador']), 1, 0, 'C', 0);
        $pdf->Cell(25, 10, utf8_decode($row['fecha']), 1, 0, 'C', 0);
        $pdf->Cell(27, 10, utf8_decode($row['horas_t']), 1, 0, 'C', 0);
        $pdf->Cell(27, 10, utf8_decode($row['horas_in']), 1, 0, 'C', 0);
        $pdf->Cell(23, 10, utf8_decode($row['horometraje_i']), 1, 0, 'C', 0);
        $pdf->Cell(23, 10, utf8_decode($row['horometraje_f']), 1, 0, 'C', 0);
        $pdf->Cell(25, 10, utf8_decode($row['fallo']), 1, 0, 'C', 0);
        $pdf->Cell(23, 10, utf8_decode($row['hora_paro']), 1, 0, 'C', 0);
        $pdf->Cell(23, 10, utf8_decode($row['hora_reinicio']), 1, 0, 'C', 0);
        $pdf->Cell(22, 10, utf8_decode($row['gastos_falla']), 1, 0, 'C', 0);
        $pdf->Cell(78, 10, utf8_decode($row['observacion']), 1, 1, 'C', 0);
    }

    $pdf->Output();
}
