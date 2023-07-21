<?php
include_once "../includes/db.php";

if (isset($_POST['id'])) {
  $idMaquina = $_POST['id'];

  $query = "SELECT m.id, m.name, m.modelo, m.serie, m.ubicacion, m.status, m.fecha, SUM(i.horas_t) AS total_horas_activas, 
  SUM(i.horas_in) AS total_horas_inactivas, i.lugar_t FROM maquinas m INNER JOIN inventario i ON i.id_maquina = m.id 
  WHERE m.id = " . $idMaquina;
  $result = mysqli_query($conexion, $query);

  if ($row = mysqli_fetch_assoc($result)) {
    $maquina = array(
      'id' => $row['id'],
      'name' => $row['name'],
      'modelo' => $row['modelo'],
      'serie' => $row['serie'],
      'ubicacion' => $row['ubicacion'],
      'status' => $row['status'],
      'total_horas_activas' => $row['total_horas_activas'],
      'total_horas_inactivas' => $row['total_horas_inactivas'],
    );
    echo json_encode($maquina);
  }
}
if(isset($_POST['table'])){
    $idMaquina = $_POST['idm'];
    $fecha1 = $_POST['fecha1'];
    $fecha2 = $_POST['fecha2'];
    $query =  "SELECT i.id, i.id_maquina,i.id_operador,i.observacion,i.horas_t,i.horas_in,i.horometraje_i,i.horometraje_f,i.lugar_t, i.fallo,i.hora_paro,i.hora_reinicio,i.fecha,i.gastos_falla,o.nombre FROM inventario i INNER JOIN operadores o ON i.id_operador = o.id WHERE i.id_maquina = $idMaquina AND i.fecha BETWEEN  '$fecha1' and '$fecha2';";
    $result = mysqli_query($conexion, $query);
    if (mysqli_num_rows($result)>0)
    {    
        while ($dato = mysqli_fetch_assoc($result) ){
         $datos[] = $dato;
    }
    echo json_encode($datos);
  }
  else{
    echo json_encode(0);
  }



}
