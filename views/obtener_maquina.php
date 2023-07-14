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
      'lugar_t' => $row['lugar_t'],
      'status' => $row['status'],
      'total_horas_activas' => $row['total_horas_activas'],
      'total_horas_inactivas' => $row['total_horas_inactivas'],
    );
    echo json_encode($maquina);
  }
}
