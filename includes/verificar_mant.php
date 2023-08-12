<?php

if (isset($_POST['id_maquina']) && isset($_POST['start']) && isset($_POST['fin'])) {
    $idMaquina = $_POST['id_maquina'];
    $start = $_POST['start'];
    $fin = $_POST['fin'];

    include('db.php');

    $sql = "SELECT * FROM historial WHERE id_maquina = '$idMaquina' AND inicio = '$start' AND fin = '$fin'";
    $resultado = mysqli_query($conexion, $sql);

    if (mysqli_num_rows($resultado) > 0) {

        echo 'existe';
    } else {

        echo 'no_existe';
    }

    mysqli_close($conexion);
} else {

    echo 'error';
}
