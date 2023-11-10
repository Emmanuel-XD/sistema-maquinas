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
        $this->SetFont('Arial', 'B', 13);

        // Movernos a la derecha
        $this->Cell(100);

        // Título
        $this->setY(10);
        $this->SetX(67);

        $this->image('../img/Logo-Primario (1).png', 5, 6, 30);  // X, Y, Tamaño
        $this->Cell(70, 10, 'Construccion del Viaducto de Acceso a la', 0, 1, 'C');

        $this->SetFont('Helvetica', 'B', 13);

        $this->setY(15);
        $this->SetX(67);
        $this->Cell(70, 10, ' Nueva Garita Otay II/Fabricacion de Vigas AASHTO ', 0, 1, 'C');
        $this->SetFont('Helvetica', 'B', 13);
        $this->setY(20);
        $this->SetX(67);
        $this->Cell(70, 10, ' para Viaducto de acceso a la Nueva Garita Otay II', 0, 1, 'C');

        $this->SetFont('Helvetica', 'B', 7);
        $this->Ln(20);
        $this->setY(35);
        $this->setX(10);
        $this->Cell(190, 0, '', 'T'); // DIVISION   

        $this->SetFont('Arial', 'B', 10);
        $this->setY(40);
        $this->setX(75);
        $this->Cell(60, 4, 'CONTROL DE ACARREO', 0, 1, 'C');

        $this->SetFont('Arial', '', 10);
        $this->setY(19);
        $this->setX(150);
        $this->Cell(60, 4, '' . utf8_decode(fecha()), 0, 1, 'C');

        // Salto de línea
        $this->SetFont('Arial', 'B', 10);
        $this->Ln(20);
        $this->SetX(20);



        $this->Ln(10);
        $this->SetFont('Arial', 'B', 10);
        $this->SetX(10);

        $this->Cell(23, 10, 'Folio', 1, 0, 'C', 0);
        $this->Cell(30, 10, 'Transporte', 1, 0, 'C', 0);
        $this->Cell(25, 10, 'Placa', 1, 0, 'C', 0,);
        $this->Cell(15, 10, 'Cant m3', 1, 0, 'C', 0);
        $this->Cell(35, 10, 'Material', 1, 0, 'C', 0);
        $this->Cell(25, 10, 'Usuario', 1, 0, 'C', 0);
        $this->Cell(35, 10, 'Fecha - Hora', 1, 1, 'C', 0);
    }
    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);

        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Número de página
        include "db.php";
        extract($_GET);
        $consulta = "SELECT * FROM acarreos WHERE id = '$id' ";
        $resultado = mysqli_query($conexion, $consulta);

        while ($fila = mysqli_fetch_array($resultado)) {
            $image1 = $fila['image1'];
            $image2 = $fila['image2'];

            $this->SetFont('Helvetica', 'B', 17);
            $this->Ln(20);
            $this->setY(120);
            $this->setX(85);
        }

        $this->Cell(60, 0, utf8_decode('EVIDENCIA'), 0, 1, 'L');
        $this->image($image1, 25, 150, 60);  // X, Y, Tamaño
        $this->image($image2, 120, 150, 60);  // X, Y, Tamaño

        $this->SetFont('Helvetica', 'B', 7);
        $this->Ln(20);
        $this->setY(-30);
        $this->setX(18);
        $this->Cell(50, 0, '', 'T'); // DIVISION

        $this->SetFont('Helvetica', 'B', 10);
        $this->Ln(20);
        $this->setY(-50);
        $this->setX(12);
        $this->Cell(60, 0, utf8_decode('REVISO'), 0, 1, 'C');

        $this->SetFont('Helvetica', 'B', 10);
        $this->Ln(20);
        $this->setY(-25);
        $this->setX(12);
        $this->Cell(60, 0, utf8_decode('Arq.Nombre'), 0, 1, 'C');
        //Otra firma
        $this->SetFont('Helvetica', 'B', 7);
        $this->Ln(20);
        $this->setY(-30);
        $this->setX(140);
        $this->Cell(50, 0, '', 'T'); // DIVISION

        $this->SetFont('Helvetica', 'B', 10);
        $this->Ln(20);
        $this->setY(-50);
        $this->setX(136);
        $this->Cell(60, 0, utf8_decode('APROBO'), 0, 1, 'C');

        $this->SetFont('Helvetica', 'B', 10);
        $this->Ln(20);
        $this->setY(-25);
        $this->setX(136);
        $this->Cell(60, 0, utf8_decode('Ing.Nombre'), 0, 1, 'C');

        //$this->SetFillColor(223, 229,235);
        //$this->SetDrawColor(181, 14,246);
        //$this->Ln(0.5);
    }
}

//include "db.php";
require_once("db.php");
extract($_GET);
$consulta = "SELECT * FROM acarreos WHERE id = '$id' ";
$resultado = mysqli_query($conexion, $consulta);

$renta = 1670.40;
$pdf = new PDF();

$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 0);
//$pdf->SetWidths(array(10, 30, 27, 27, 20, 20, 20, 20, 22));
while ($row = $resultado->fetch_assoc()) {

    $pdf->SetX(10);

    $pdf->Cell(23, 10, $row['folio'], 1, 0, 'L', 0);
    $pdf->Cell(30, 10, $row['transporte'], 1, 0, 'L', 0);
    $pdf->Cell(25, 10, $row['placa'], 1, 0, 'L', 0);
    $pdf->Cell(15, 10, $row['cant'], 1, 0, 'L', 0);
    $pdf->Cell(35, 10, $row['material'], 1, 0, 'L', 0);
    $pdf->Cell(25, 10, $row['user'], 1, 0, 'L', 0);
    $pdf->Cell(35, 10, $row['fecha_registro'], 1, 1, 'L', 0);
}


$pdf->Output();
