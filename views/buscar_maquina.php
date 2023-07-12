<?php
include_once "../includes/db.php";

if (isset($_GET['term'])) {
    $numeroMaquina = $_GET['term'];


    $query = "SELECT name FROM maquinas WHERE name LIKE '%" . $numeroMaquina . "%'";
    $result = mysqli_query($conexion, $query);

    $response = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $response[] = $row['name'];
    }

    echo json_encode($response);
}
