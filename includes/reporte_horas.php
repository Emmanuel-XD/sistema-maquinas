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
        $this->Cell(60, 4, 'CONTROL DE MAQUINARIA', 0, 1, 'C');

        $this->SetFont('Arial', '', 10);
        $this->setY(19);
        $this->setX(150);
        $this->Cell(60, 4, '' . utf8_decode(fecha()), 0, 1, 'C');

        // Salto de línea
        $this->SetFont('Arial', 'B', 10);
        $this->Ln(15);
        $this->SetX(20);
        $star = date("Y-m-d", strtotime($_POST['star']));
        $fin  = date("Y-m-d", strtotime($_POST['fin']));

        $this->SetFont('Helvetica', '', 10);
        $this->Ln(20);
        $this->setY(53);
        $this->setX(10);
        $this->Cell(60, 0, 'FECHA 1: ' . utf8_decode($star), 0, 1, 'L');


        $this->SetFont('Helvetica', '', 10);
        $this->Ln(20);
        $this->setY(53);
        $this->setX(55);
        $this->Cell(60, 0, 'FECHA 2: ' . utf8_decode($fin), 0, 1, 'L');


        $this->Ln(10);
        $this->SetFont('Arial', 'B', 10);
        $this->SetX(10);

        $this->Cell(23, 10, '#Maquina', 1, 0, 'C', 0);
        $this->Cell(42, 10, 'Serie', 1, 0, 'C', 0);
        $this->Cell(50, 10, 'Modelo', 1, 0, 'C', 0,);
        $this->Cell(25, 10, 'Horas Act', 1, 0, 'C', 0);
        $this->Cell(25, 10, 'Horas Inact', 1, 0, 'C', 0);
        $this->Cell(25, 10, 'Precio Renta', 1, 1, 'C', 0);
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
$star = date("Y-m-d", strtotime($_POST['star']));
$fin  = date("Y-m-d", strtotime($_POST['fin']));
$consulta = "SELECT m.name AS maquina, m.serie, m.modelo, SUM(i.horas_t) AS total_horas_activas,
SUM(i.horas_in) AS total_horas_inactivas FROM maquinas m LEFT JOIN inventario i ON i.id_maquina = m.id  
AND i.fecha BETWEEN '$star' AND '$fin' GROUP BY m.name, m.serie, m.modelo;";
$resultado = mysqli_query($conexion, $consulta);

$renta = 1670.40;
$pdf = new PDF();

$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 0);
//$pdf->SetWidths(array(10, 30, 27, 27, 20, 20, 20, 20, 22));
while ($row = $resultado->fetch_assoc()) {

    $pdf->SetX(10);

    $pdf->Cell(23, 10, $row['maquina'], 1, 0, 'L', 0);
    $pdf->Cell(42, 10, $row['serie'], 1, 0, 'L', 0);
    $pdf->Cell(50, 10, $row['modelo'], 1, 0, 'L', 0);
    $pdf->Cell(25, 10, $row['total_horas_activas'], 1, 0, 'L', 0);
    $pdf->Cell(25, 10, $row['total_horas_inactivas'], 1, 0, 'L', 0);
    $pdf->Cell(25, 10, '$' . $row['total_horas_activas'] * $renta, 1, 1, 'L', 0);
}


$pdf->Output();
