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
        $this->setX(145);

        $this->Cell(70, 10, utf8_decode('REPORTE DE MAQUINARIAS '), 0, 1, 'C');

        $this->SetFont('Arial', '', 15);
        $this->setY(20);
        $this->setX(150);
        $this->Cell(60, 4, 'CONTROL DE MAQUINARIA', 0, 1, 'C');

        $this->SetFont('Helvetica', '', 11);
        $this->Ln(20);
        $this->setY(45);
        $this->setX(25);
        $this->Cell(60, 0, 'Maquina: ', 0, 1, 'C');

        $this->SetFont('Helvetica', '', 11);
        $this->Ln(20);
        $this->setY(45);
        $this->setX(75);
        $this->Cell(60, 0, 'Modelo: ', 0, 1, 'C');

        $this->SetFont('Helvetica', '', 11);
        $this->Ln(20);
        $this->setY(45);
        $this->setX(115);
        $this->Cell(60, 0, 'Serie: ', 0, 1, 'C');

        $this->SetFont('Helvetica', '', 11);
        $this->Ln(20);
        $this->setY(45);
        $this->setX(155);
        $this->Cell(60, 0, 'Ubicacion: ', 0, 1, 'C');

        $this->SetFont('Helvetica', '', 11);
        $this->Ln(20);
        $this->setY(45);
        $this->setX(200);
        $this->Cell(60, 0, 'Estatus: ', 0, 1, 'C');

        $this->SetFont('Helvetica', '', 11);
        $this->Ln(20);
        $this->setY(45);
        $this->setX(250);
        $this->Cell(60, 0, 'Mantenimiento: ', 0, 1, 'C');

        $this->SetFont('Helvetica', '', 11);
        $this->Ln(20);
        $this->setY(60);
        $this->setX(34);
        $this->Cell(60, 0, 'Total de HRS Activa: ', 0, 1, 'C');

        $this->SetFont('Helvetica', '', 11);
        $this->Ln(20);
        $this->setY(60);
        $this->setX(95);
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
        $this->SetFont('Arial', 'B', 10);
        $this->SetY(72);
        $this->SetX(10);

        $this->Cell(40, 10, 'Operador', 1, 0, 'C', 0);
        $this->Cell(25, 10, 'Fecha', 1, 0, 'C', 0,);
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
    include_once "db.php";
    $idMaquina = $_GET['idm'];
    $fecha1 = $_GET['fecha1'];
    $fecha2 = $_GET['fecha2'];
    $query =  "SELECT i.id, i.id_maquina,i.id_operador,i.observacion,i.horas_t,i.horas_in,i.horometraje_i,i.horometraje_f,i.lugar_t, i.fallo,i.hora_paro,i.hora_reinicio,i.fecha,i.gastos_falla,o.nombre FROM inventario i INNER JOIN operadores o ON i.id_operador = o.id WHERE i.id_maquina = $idMaquina AND i.fecha BETWEEN  '$fecha1' and '$fecha2';";
    $result = mysqli_query($conexion, $query);
    while ($row=$result->fetch_assoc()) {
        $this->SetX(10);
        $this->Cell(40,10,$row['id'],1,0,'C',0);
    }
    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);

        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Número de página
    }
}

$pdf = new PDF('L', 'mm', 'Legal');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 0);

$pdf->Output();
