<?php
include_once "../includes/db.php";

if (isset($_POST['id'])) {
  $idMaquina = $_POST['id'];

  $query = "SELECT * FROM maquinas WHERE id = " . $idMaquina;
  $result = mysqli_query($conexion, $query);

  if ($row = mysqli_fetch_assoc($result)) {
    $maquina = array(
      'id' => $row['id'],
      'name' => $row['name'],
      'modelo' => $row['modelo'],
      'serie' => $row['serie'],
      'ubicacion' => $row['ubicacion'],
      'status' => $row['status'],
     
    );
    echo json_encode($maquina);
  }
}
