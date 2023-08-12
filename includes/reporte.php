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

        $this->Ln();

        include "db.php";
        extract($_GET);

        $idMaquina = $_GET['idm'];
        $fecha1 = $_GET['fecha1'];
        $fecha2 = $_GET['fecha2'];
        $mant = $_GET['mant'];

        $consulta = "SELECT i.id, i.id_maquina, i.id_operador, i.observacion, SUM(i.horas_t) AS total_horas_activas, 
        SUM(i.horas_in) AS total_horas_inactivas, i.horometraje_i, 
        i.horometraje_f,i.lugar_t, i.fallo, i.hora_paro, i.hora_reinicio, i.fecha, i.gastos_falla, o.nombre, m.name, 
        m.modelo, m.serie, m.ubicacion, m.status, i.responsable_falla FROM inventario i INNER JOIN operadores o ON i.id_operador = o.id 
        INNER JOIN maquinas m ON m.id = i.id_maquina WHERE i.id_maquina = '$idMaquina' AND i.fecha BETWEEN '$fecha1' 
        AND '$fecha2';";

        $sql = mysqli_query($conexion, $consulta);
        if ($sql->num_rows > 0) {
            foreach ($sql as $key => $filas) {
            }
        }


        $this->SetFont('Helvetica', '', 11);
        $this->Ln(20);
        $this->setY(45);
        $this->setX(1);
        $this->Cell(60, 0, ' ' . utf8_decode($filas['name']), 0, 1, 'C');

        $this->SetFont('Helvetica', '', 11);
        $this->Ln(20);
        $this->setY(45);
        $this->setX(46);
        $this->Cell(60, 0, 'Modelo:' . utf8_decode($filas['modelo']), 0, 1, 'C');

        $this->SetFont('Helvetica', '', 11);
        $this->Ln(20);
        $this->setY(45);
        $this->setX(99);//LINEA PARA AJUSTAR A LA IZQUIERDA O DERECHA LA LINEA DE COMENTARIO
        $this->Cell(60, 0, 'Serie: ' . utf8_decode($filas['serie']), 0, 1, 'C');

        $this->SetFont('Helvetica', '', 11);
        $this->Ln(20);
        $this->setY(45);
        $this->setX(160);
        $this->Cell(60, 0, 'Ubicacion: ' . utf8_decode($filas['ubicacion']), 0, 1, 'C');

        $this->SetFont('Helvetica', '', 11);
        $this->Ln(20);
        $this->setY(45);
        $this->setX(210);
        $this->Cell(60, 0, 'Estatus: ' . utf8_decode($filas['status']), 0, 1, 'C');

        $this->SetFont('Helvetica', '', 11);
        $this->Ln(20);
        $this->setY(45);
        $this->setX(265);
        $this->Cell(60, 0, 'Mantenimiento: ' . utf8_decode($mant), 0, 1, 'C');

        $this->SetFont('Helvetica', '', 11);
        $this->Ln(20);
        $this->setY(60);
        $this->setX(28);
        $this->Cell(60, 0, 'Total de Horas Activa: ' . utf8_decode($filas['total_horas_activas']), 0, 1, 'C');

        $this->SetFont('Helvetica', '', 11);
        $this->Ln(20);
        $this->setY(60);
        $this->setX(84);
        $this->Cell(60, 0, 'Total de horas Inactiva: ' . utf8_decode($filas['total_horas_inactivas']), 0, 1, 'C');
        

        $this->SetFont('Arial', 'B', 17);
        $this->Image('../img/Logo-Primario (1).png', 5, 4, 45);  // X, Y, Tamaño

        $this->Ln(7);
        $this->SetFont('Arial', 'B', 9);
        $this->Cell(70, 10, 'ACTIVIDAD DE MAQUINA:', 1, 0, 'C', 0);
        $this->Cell(54, 10, 'HORAS', 1, 0, 'C', 0);
        $this->Cell(46, 10, 'HOROMETRO', 1, 0, 'C', 0);
        $this->Cell(45, 10, 'TIPO DE FALLA', 1, 0, 'C', 0);
        $this->Cell(46, 10, 'TIEMPO DE FALLA', 1, 0, 'C', 0);
        $this->Cell(68, 10, 'FALLA', 1, 0, 'C', 0);
        
    
        $this->Ln(10);
        // Table header
        $this->SetFont('Arial', 'B', 9);
        $this->Cell(45, 10, 'Operador', 1, 0, 'C', 0);
        $this->Cell(25, 10, 'Fecha', 1, 0, 'C', 0);
        $this->Cell(27, 10, 'Trabajadas', 1, 0, 'C', 0);
        $this->Cell(27, 10, 'Inactivas', 1, 0, 'C', 0);
        $this->Cell(23, 10, 'Inicial', 1, 0, 'C', 0);
        $this->Cell(23, 10, 'Terminal', 1, 0, 'C', 0);
        $this->Cell(45, 10, 'Causa', 1, 0, 'C', 0);
        $this->Cell(23, 10, 'Inactiva', 1, 0, 'C', 0);
        $this->Cell(23, 10, 'Reinicio', 1, 0, 'C', 0);
        $this->Cell(30, 10, 'Gastos', 1, 0, 'C', 0);
        
        $this->Cell(38, 10, 'Responsable', 1, 1, 'C', 0);
        
       // $this->Cell(50, 10, 'Observacion', 1, 1, 'C', 0);
        
    }

    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);

        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Número de página
        $this->Cell(0, 10, 'pagina ' . $this->PageNo(), 0, 0, 'C');
    }
}
include_once "db.php";
// Check if the required parameters are set
if (isset($_GET['idm'], $_GET['fecha1'], $_GET['fecha2'])) {

    $idMaquina = $_GET['idm'];
    $fecha1 = $_GET['fecha1'];
    $fecha2 = $_GET['fecha2'];
    $query = "SELECT i.id, i.id_maquina, i.id_operador, i.observacion, i.horas_t, i.horas_in, i.horometraje_i, i.horometraje_f,
                i.lugar_t, i.fallo, i.hora_paro, i.hora_reinicio, i.fecha, i.gastos_falla, o.nombre, i.responsable_falla
                FROM inventario i 
                INNER JOIN operadores o ON i.id_operador = o.id
                WHERE i.id_maquina = '$idMaquina' AND i.fecha BETWEEN '$fecha1' AND '$fecha2';";
    $result = mysqli_query($conexion, $query);



    $pdf = new PDF('L', 'mm', 'Legal');
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial', '', 0);
   
    while ($row = $result->fetch_array()) {
        $pdf->Cell(45, 9, utf8_decode($row['nombre']), 1, 0, 'C', 0);
        $pdf->Cell(25, 9, utf8_decode($row['fecha']), 1, 0, 'C', 0);
        $pdf->Cell(27, 9, utf8_decode($row['horas_t']), 1, 0, 'C', 0);
        $pdf->Cell(27, 9, utf8_decode($row['horas_in']), 1, 0, 'C', 0);
        $pdf->Cell(23, 9, utf8_decode($row['horometraje_i']), 1, 0, 'C', 0);
        $pdf->Cell(23, 9, utf8_decode($row['horometraje_f']), 1, 0, 'C', 0);
        $pdf->Cell(45, 9, utf8_decode($row['fallo']), 1, 0, 'C', 0);
        $pdf->Cell(23, 9, utf8_decode($row['hora_paro']), 1, 0, 'C', 0);
        $pdf->Cell(23, 9, utf8_decode($row['hora_reinicio']), 1, 0, 'C', 0);
        $pdf->Cell(30, 9, utf8_decode($row['gastos_falla']), 1, 0, 'C', 0);
        $pdf->Cell(38, 9, utf8_decode($row['responsable_falla']), 1, 0, 'C', 0);
        $pdf->Ln(9);
       
        $pdf->Cell(24,7,'Observaciones:',1);
        $pdf->Cell(305, 7, utf8_decode($row['observacion']), 1, 1,);
        $pdf->Ln(5);
      
    }

    $pdf->Output();
}
