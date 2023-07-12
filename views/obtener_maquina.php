<?php
include_once "../includes/db.php";

if (isset($_POST['name'])) {
    $numeroMaquina = $_POST['name'];

    $query = "SELECT * FROM maquinas WHERE name = '" . $numeroMaquina . "'";
    $result = mysqli_query($conexion, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        $maquina = array(
            'name' => $row['name'],
            'id' => $row['id'],
            'modelo' => $row['modelo'],
            'serie' => $row['serie'],

        );
        echo json_encode($maquina);
    }
}
