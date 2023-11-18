
<?php

include "db.php";
$id = $_GET['id'];

$DeleteTrascabo = "DELETE FROM trascabo_reports WHERE id = '$id'";
$resultadoDeleteTrascabo = mysqli_query($conexion, $DeleteTrascabo);

if($resultadoDeleteTrascabo){
    $deleteChecklist = "DELETE FROM checklist_trascabo WHERE id_report = '$id'";
    $resultadoDeleteCltrascabo = mysqli_query($conexion, $deleteChecklist);
    if($resultadoDeleteCltrascabo){
        header('Location: ../views/trascabo_consultas.php');
    }
    else{
        echo json_encode("error");
    }
}
else{
    echo json_encode("error");
}

?>