<?php


require('../fpdf/fpdf.php');
include "fecha.php";

class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {

        //$this->image('', 150, 1, 40); // X, Y, Tamaño
        $this->Ln();
        // Arial bold 15
        $this->SetFont('Arial', 'B', 17);

        // Movernos a la derecha
        $this->Cell(100);

        // Título
        $this->setY(15);
        $this->SetX(70);

        $this->image('../img/Logo-Primario (1).png', 5, 6, 30);  // X, Y, Tamaño
        $this->Cell(70, 10, 'MAQUINARIA   ', 0, 1, 'C');

        $this->SetFont('Helvetica', 'B', 7);
        $this->Ln(20);
        $this->setY(30);
        $this->setX(10);
        $this->Cell(190, 0, '', 'T'); // DIVISION   

        $this->SetFont('Arial', 'B', 10);
        $this->setY(35);
        $this->setX(75);
        $this->Cell(60, 4, 'HISTORIAL DE MANTENIMIENTO', 0, 1, 'C');

        $this->SetFont('Arial', '', 10);
        $this->setY(19);
        $this->setX(150);
        $this->Cell(60, 4, '' . utf8_decode(fecha()), 0, 1, 'C');

        // Salto de línea
        $this->SetFont('Arial', 'B', 10);
        $this->Ln(15);
        $this->SetX(20);




        $this->Ln(15);
        $this->SetFont('Arial', 'B', 10);
        $this->SetX(10);

        $this->Cell(23, 10, '#Maquina', 1, 0, 'C', 0);
        $this->Cell(42, 10, 'Status', 1, 0, 'C', 0);
        $this->Cell(30, 10, 'Fecha Inicio', 1, 0, 'C', 0,);
        $this->Cell(25, 10, 'Fecha Fin', 1, 0, 'C', 0);
        $this->Cell(35, 10, 'Fecha Mant.', 1, 0, 'C', 0);
        $this->Cell(35, 10, 'Usuario', 1, 1, 'C', 0);
    }

    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);

        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Número de página

        $this->Cell(0, 10, utf8_decode('Página') . $this->PageNo() . '/{nb}', 0, 0, 'C');
        //$this->SetFillColor(223, 229,235);
        //$this->SetDrawColor(181, 14,246);
        //$this->Ln(0.5);
    }
}

//include "db.php";
require_once("db.php");
extract($_POST);
$consulta = "SELECT h.id, h.id_maquina, h.status, h.inicio, h.fin, h.datetime, h.usuario,
m.name FROM historial h INNER JOIN maquinas m ON h.id_maquina = m.id WHERE h.id_maquina = '$id_maquina'";
$resultado = mysqli_query($conexion, $consulta);

$renta = 1670.40;
$pdf = new PDF();

$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 0);
//$pdf->SetWidths(array(10, 30, 27, 27, 20, 20, 20, 20, 22));
while ($row = $resultado->fetch_assoc()) {

    $pdf->SetX(10);

    $pdf->Cell(23, 10, $row['name'], 1, 0, 'L', 0);
    $pdf->Cell(42, 10, $row['status'], 1, 0, 'L', 0);
    $pdf->Cell(30, 10, $row['inicio'], 1, 0, 'L', 0);
    $pdf->Cell(25, 10, $row['fin'], 1, 0, 'L', 0);
    $pdf->Cell(35, 10, $row['datetime'], 1, 0, 'L', 0);
    $pdf->Cell(35, 10, $row['usuario'], 1, 1, 'L', 0);
}


$pdf->Output();
