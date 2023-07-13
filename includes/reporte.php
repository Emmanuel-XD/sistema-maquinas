<?php


require('../fpdf/fpdf.php');

class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {

        //$this->image('', 150, 1, 40); // X, Y, Tamaño
        $this->Ln(20);
        // Arial bold 15
        $this->SetFont('Arial', 'B', 16);

        // Movernos a la derecha
        $this->Cell(100);
        // Título
        $this->setY(10);
        $this->setX(105);

        $this->Cell(70, 10, utf8_decode('REPORTE DE MAQUINARIAS '), 0, 1, 'C');



        $this->SetFont('Arial', '', 15);
        $this->setY(20);
        $this->setX(110);
        $this->Cell(60, 4, 'CONTROL DE MAQUINARIA', 0, 1, 'C');


        $this->SetFont('Helvetica', '', 9);
        $this->Ln(20);
        $this->setY(45);
        $this->setX(10);
        $this->Cell(60, 0, 'Maquina: ', 0, 1, 'C');

        $this->SetFont('Helvetica', '', 9);
        $this->Ln(20);
        $this->setY(45);
        $this->setX(50);
        $this->Cell(60, 0, 'Modelo: ', 0, 1, 'C');

        $this->SetFont('Helvetica', '', 9);
        $this->Ln(20);
        $this->setY(45);
        $this->setX(90);
        $this->Cell(60, 0, 'Serie: ', 0, 1, 'C');

        $this->SetFont('Helvetica', '', 9);
        $this->Ln(20);
        $this->setY(45);
        $this->setX(130);
        $this->Cell(60, 0, 'Ubicacion: ', 0, 1, 'C');

        $this->SetFont('Helvetica', '', 9);
        $this->Ln(20);
        $this->setY(45);
        $this->setX(170);
        $this->Cell(60, 0, 'Estatus: ', 0, 1, 'C');
        
        $this->SetFont('Helvetica', '', 9);
        $this->Ln(20);
        $this->setY(45);
        $this->setX(210);
        $this->Cell(60, 0, 'Mantenimiento: ', 0, 1, 'C');

        $this->SetFont('Helvetica', '', 9);
        $this->Ln(20);
        $this->setY(60);
        $this->setX(18);
        $this->Cell(60, 0, 'Total de HRS Activa: ', 0, 1, 'C');

        $this->SetFont('Helvetica', '', 9);
        $this->Ln(20);
        $this->setY(60);
        $this->setX(65);
        $this->Cell(60, 0, 'Total de HRS Parada: ', 0, 1, 'C');


        $this->SetFont('Arial', 'B', 17);
        $this->setY(40);
        $this->SetX(100);

        $this->image('../img/Logo-Primario (1).png', 5, 4, 45);  // X, Y, Tamaño



        // Salto de línea
        $this->SetFont('Arial', 'B', 10);
        $this->Ln();
        $this->SetX(20);


        $this->Ln();
        $this->SetFont('Arial', 'B', 8);
        $this->SetY(70);
        $this->SetX(10);

        $this->Cell(30, 10, 'Operador', 1, 0, 'C', 0);
        $this->Cell(23, 10, 'Fecha', 1, 0, 'C', 0,);
        $this->Cell(27, 10, 'Hrs Trab.', 1, 0, 'C', 0);
        $this->Cell(27, 10, 'Hrs In', 1, 0, 'C', 0);
        $this->Cell(23, 10, 'HRMT Ini', 1, 0, 'C', 0);
        $this->Cell(23, 10, 'HRMT Ter', 1, 0, 'C', 0);
        $this->Cell(25, 10, 'Lugar', 1, 0, 'C', 0);
        $this->Cell(25, 10, 'Falla', 1, 0, 'C', 0);
        $this->Cell(20, 10, 'Hra Paro', 1, 0, 'C', 0);
        $this->Cell(20, 10, 'Hra Reinicio', 1, 0, 'C', 0);
        $this->Cell(20, 10, 'Gastos', 1, 0, 'C', 0);
        $this->Cell(22, 10, 'Observacion', 1, 1, 'C', 0);
    }

    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);

        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Número de página


       




        //$this->SetFillColor(223, 229,235);
        //$this->SetDrawColor(181, 14,246);
        //$this->Ln(0.5);
    }
}



$pdf = new PDF();
$pdf = new PDF('L', 'mm', 'letter');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 0);

//$pdf->SetWidths(array(10, 30, 27, 27, 20, 20, 20, 20, 22));




$pdf->Output();
