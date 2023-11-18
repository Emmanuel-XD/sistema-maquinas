
<?php	

if(isset($_POST['accion'])){
    switch ($_POST['accion']) {
        //casos de registros
    case 'fillTable':
        fillTable();
        break;

    case 'consultExcel':
        consultExcel();
        break;
    }
}
function fillTable(){
    include  "db.php";
    $idMaquina = $_POST["maquina"];
    $date = $_POST["fecha"];
    $week = date("Y-m-d", strtotime($date . " +1 week"));

    $result = mysqli_query($conexion, "SELECT maquinas.name, maquinas.modelo, trascabo_Reports.date_register, trascabo_Reports.id
    FROM maquinas
    JOIN trascabo_Reports ON maquinas.id = trascabo_Reports.id_maquina
    WHERE trascabo_Reports.date_register >= '$date'
    AND trascabo_Reports.date_register <= '$week'
    AND trascabo_Reports.id_maquina = '$idMaquina';");

    if($result->num_rows > 0){
        $rows = array();

        // Fetch each row and add it to the array
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
    
        // Echo the JSON-encoded array
        echo json_encode($rows);
    }
    else{
        echo json_encode("empty");
    }
   


}
function consultExcel(){
    include  "db.php";
    $idMaquina = $_POST["maquina"];
    $date = $_POST["fecha"];
    $week = date("Y-m-d", strtotime($date . " +1 week"));
    $result = mysqli_query($conexion, "SELECT 
    maquinas.name, maquinas.serie, maquinas.modelo,
    trascabo_Reports.date_register, trascabo_Reports.contractor_name,
    trascabo_Reports.week_number, trascabo_Reports.month, trascabo_Reports.period_date,checklist_trascabo.frontIntert,
    checklist_trascabo.frontIntert_comment, checklist_trascabo.traTrab,
    checklist_trascabo.traTrab_comment, checklist_trascabo.dirDel,
    checklist_trascabo.dirDel_comment, checklist_trascabo.dirTra,
    checklist_trascabo.dirTra_comment, checklist_trascabo.stpTra,
    checklist_trascabo.stpTra_comment, checklist_trascabo.espLat,
    checklist_trascabo.espLat_comment, checklist_trascabo.alarmRet,
    checklist_trascabo.alarmRet_comment, checklist_trascabo.claxon,
    checklist_trascabo.claxon_comment, checklist_trascabo.fserv,
    checklist_trascabo.fserv_comment, checklist_trascabo.dirSusp,
    checklist_trascabo.dirSusp_comment, checklist_trascabo.cintSeg,
    checklist_trascabo.cintSeg_comment, checklist_trascabo.vidFront,
    checklist_trascabo.vidFront_comment, checklist_trascabo.limpBris,
    checklist_trascabo.limpBris_comment, checklist_trascabo.extnt,
    checklist_trascabo.extnt_comment, checklist_trascabo.asiento,
    checklist_trascabo.asiento_comment, checklist_trascabo.indiHidra,
    checklist_trascabo.indiHidra_comment, checklist_trascabo.motorRef,
    checklist_trascabo.motorRef_comment, checklist_trascabo.batCable,
    checklist_trascabo.batCable_comment, checklist_trascabo.horometro,
    checklist_trascabo.horometro_comment, checklist_trascabo.fugHidra,
    checklist_trascabo.fugHidra_comment, checklist_trascabo.pasaSusp,
    checklist_trascabo.pasaSusp_comment, checklist_trascabo.fugAire,
    checklist_trascabo.fugAire_comment, checklist_trascabo.grapasAnc,
    checklist_trascabo.grapasAnc_comment, checklist_trascabo.cardam,
    checklist_trascabo.cardam_comment, checklist_trascabo.AcoplesRap,
    checklist_trascabo.AcoplesRap_comment, checklist_trascabo.mangueras,
    checklist_trascabo.mangueras_comment, checklist_trascabo.volco,
    checklist_trascabo.volco_comment, checklist_trascabo.tCombu,
    checklist_trascabo.tCombu_comment, checklist_trascabo.mBomba,
    checklist_trascabo.mBomba_comment, checklist_trascabo.llantas,
    checklist_trascabo.llantas_comment, checklist_trascabo.gvolco,
    checklist_trascabo.gvolco_comment, checklist_trascabo.femer,
    checklist_trascabo.femer_comment
FROM 
    maquinas
JOIN 
    trascabo_Reports ON maquinas.id = trascabo_Reports.id_maquina
JOIN 
    checklist_trascabo ON checklist_trascabo.id_report = trascabo_reports.id
    WHERE 
    trascabo_Reports.date_register >= '$date'
    AND trascabo_Reports.date_register <= '$week'
    AND trascabo_Reports.id_maquina = '$idMaquina'");

    if($result->num_rows > 0){
        $rows = array();

        // Fetch each row and add it to the array
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
    
        // Echo the JSON-encoded array
        echo json_encode($rows);
    }
    else{
        echo json_encode("empty");
    }
}

?>