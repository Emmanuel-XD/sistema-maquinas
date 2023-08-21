<?php

if (isset($_POST['id_maquina']) && isset($_POST['start']) && isset($_POST['fin'])) {
    $idMaquina = $_POST['id_maquina'];
    $start = $_POST['start'];
    $fin = $_POST['fin'];
    $currentDate = date('Y-m-d');
    include('db.php');
    session_start();
    $user = $_SESSION['usuario'];
    $sql = "SELECT * FROM historial WHERE id_maquina = '$idMaquina' AND inicio >= '$start' AND fin <= '$fin'";
    $resultado = mysqli_query($conexion, $sql);

    if (mysqli_num_rows($resultado) > 0) {

        echo 'existe';
    } else {
        $sql = "INSERT INTO `historial`( `id_maquina`, `status`, `inicio`, `fin`, `datetime`, `usuario`) VALUES ('$idMaquina','Mantenimiento Relizado','$start','$fin','$currentDate','$user ')";
        $resultado = mysqli_query($conexion, $sql);
        if($resultado){
            echo 'mant_realizado';
        }
    }

    mysqli_close($conexion);
} else {

    echo 'error';
}
