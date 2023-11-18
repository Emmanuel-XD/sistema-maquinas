<?php

// Get the raw POST data
$rawData = file_get_contents("php://input");

// Decode the JSON data
$decodedData = json_decode($rawData, true); // Set the second parameter to true for an associative array

// Check if decoding was successful
if ($decodedData !== null) {
    // Process the data as needed
    foreach ($decodedData as $item) {
        // Check if 'name' and 'value' fields exist in the item
        if (isset($item['name']) && isset($item['value'])) {
            // Use variable variables to create variables based on 'name'
            ${$item['name']} = $item['value'];
        } else {
            // Handle missing 'name' or 'value' fields
            echo "Error: 'name' or 'value' fields are missing.<br>";
        }
    }
    if($accion === "report_trascabo"){
    include "db.php";
    $sqlverify = "SELECT `date_register`, `id_maquina` FROM `trascabo_reports` WHERE `date_register` = '$fecha'  AND `id_maquina` = '$id_maquina'";
    $resultado = mysqli_query($conexion, $sqlverify);
    if(mysqli_num_rows($resultado) > 0){
        echo json_encode("registered");
    }
    else{
        $sqlSavedata = "INSERT INTO `trascabo_reports` ( `id_maquina`, `contractor_name`, `week_number`,`month`, `date_register`, `period_date`, `was_used`) VALUES ('$id_maquina','$fullName','$week','$mes','$fecha','$Periodo','$opero')";
        $resultado = mysqli_query($conexion, $sqlSavedata);
        if($resultado){
            $lastInsertId = mysqli_insert_id($conexion);
        $sql ="INSERT INTO `checklist_trascabo`( `id_report`, `frontIntert`, `frontIntert_comment`, `traTrab`, `traTrab_comment`, `dirDel`, `dirDel_comment`, `dirTra`, `dirTra_comment`,
        `stpTra`, `stpTra_comment`, `espLat`, `espLat_comment`, `alarmRet`, `alarmRet_comment`, `claxon`, `claxon_comment`, `fserv`, `fserv_comment`, `dirSusp`, `dirSusp_comment`,
         `cintSeg`, `cintSeg_comment`, `vidFront`, `vidFront_comment`, `limpBris`, `limpBris_comment`, `extnt`, `extnt_comment`, `asiento`, `asiento_comment`, `indiHidra`, `indiHidra_comment`,
          `motorRef`, `motorRef_comment`, `batCable`, `batCable_comment`, `horometro`, `horometro_comment`, `fugHidra`, `fugHidra_comment`, `pasaSusp`, `pasaSusp_comment`, `fugAire`, 
          `fugAire_comment`, `grapasAnc`, `grapasAnc_comment`, `cardam`, `cardam_comment`, `AcoplesRap`, `AcoplesRap_comment`, `mangueras`, `mangueras_comment`, `volco`, `volco_comment`,
           `tCombu`, `tCombu_comment`, `mBomba`, `mBomba_comment`, `llantas`, `llantas_comment`,`femer`,`femer_comment`, `gvolco`, `gvolco_comment`)
         VALUES ('$lastInsertId','$switchFrontint','$observation_Fronint','$switchTratrabajo','$observation_Tratrabajo','$switchDirdelpark','$observation_Dirdelpark','$switchDirtrapark','$observation_Dirtrapark',
         '$switchstopTra','$observation_stopTra','$switchlatMirror','$observation_latMirror','$switchretAlarm','$observation_retAlarm','$switchclaxChck','$observation_claxChck','$switchservFre','$observation_servFre',
         '$switchdirSusp','$observation_dirSusp','$switchcintSeg','$observation_cintSeg','$switchfronGlass','$observation_fronGlass','$switchlimBris','$observation_limBris','$switchextnt','$observation_extnt','$switchasiento',
         '$observation_asiento','$switchindiHid','$observation_indiHid','$switchrefrig','$observation_refrig','$switchbatCab','$observation_batCab','$horometro','$observation_horometro','$switchCfugas','$observation_Cfugas','
         $switchpasadSusp','$observation_pasadSusp','$switchctrlFugas','$observation_ctrlFugas','$switchgrapasAnclaje','$observation_grapasAnclaje','$switchcardam','$observation_cardam','$switchacoples',
         '$observation_acoples','$switchMangueras','$observation_Mangueras','$switchstatusVolco','$observation_statusVolco','$switchtanqueCombus','$observation_tanqueCombus','$switchmotorBomba',
         '$observation_motorBomba','$switchllantasStatus','$observation_llantasStatus', '$switchfemer', '$observation_femer','$switchgvolco','$observation_gvolco')";
    
        $resultado2 = mysqli_query($conexion, $sql);
        if($resultado2){
            echo json_encode("success");
        }
        else{
            echo json_encode("error");
        }
    }
   
}
}
if($accion === "editTrascabo"){
    include "db.php";
    $sqlUpdateTrascabo = "UPDATE `trascabo_reports` SET 
    `contractor_name` = '$fullName',
    `week_number` = '$week',
    `month` = '$mes',
    `period_date` = '$Periodo',
    `was_used` = '$opero'
WHERE `id` = '$id'";

$resultadoUpdateTrascabo = mysqli_query($conexion, $sqlUpdateTrascabo);
if ($resultadoUpdateTrascabo) {
    $sqlUpdateChecklist = "UPDATE `checklist_trascabo` SET 
    `frontIntert` = '$switchFrontint',
    `frontIntert_comment` = '$observation_Fronint',
    `traTrab` = '$switchTratrabajo',
    `traTrab_comment` = '$observation_Tratrabajo',
    `dirDel` = '$switchDirdelpark',
    `dirDel_comment` = '$observation_Dirdelpark',
    `dirTra` = '$switchDirtrapark',
    `dirTra_comment` = '$observation_Dirtrapark',
    `stpTra` = '$switchstopTra',
    `stpTra_comment` = '$observation_stopTra',
    `espLat` = '$switchlatMirror',
    `espLat_comment` = '$observation_latMirror',
    `alarmRet` = '$switchretAlarm',
    `alarmRet_comment` = '$observation_retAlarm',
    `claxon` = '$switchclaxChck',
    `claxon_comment` = '$observation_claxChck',
    `fserv` = '$switchservFre',
    `fserv_comment` = '$observation_servFre',
    `dirSusp` = '$switchdirSusp',
    `dirSusp_comment` = '$observation_dirSusp',
    `cintSeg` = '$switchcintSeg',
    `cintSeg_comment` = '$observation_cintSeg',
    `vidFront` = '$switchfronGlass',
    `vidFront_comment` = '$observation_fronGlass',
    `limpBris` = '$switchlimBris',
    `limpBris_comment` = '$observation_limBris',
    `extnt` = '$switchextnt',
    `extnt_comment` = '$observation_extnt',
    `asiento` = '$switchasiento',
    `asiento_comment` = '$observation_asiento',
    `indiHidra` = '$switchindiHid',
    `indiHidra_comment` = '$observation_indiHid',
    `motorRef` = '$switchrefrig',
    `motorRef_comment` = '$observation_refrig',
    `batCable` = '$switchbatCab',
    `batCable_comment` = '$observation_batCab',
    `horometro` = '$horometro',
    `horometro_comment` = '$observation_horometro',
    `fugHidra` = '$switchCfugas',
    `fugHidra_comment` = '$observation_Cfugas',
    `pasaSusp` = '$switchpasadSusp',
    `pasaSusp_comment` = '$observation_pasadSusp',
    `fugAire` = '$switchctrlFugas',
    `fugAire_comment` = '$observation_ctrlFugas',
    `grapasAnc` = '$switchgrapasAnclaje',
    `grapasAnc_comment` = '$observation_grapasAnclaje',
    `cardam` = '$switchcardam',
    `cardam_comment` = '$observation_cardam',
    `AcoplesRap` = '$switchacoples',
    `AcoplesRap_comment` = '$observation_acoples',
    `mangueras` = '$switchMangueras',
    `mangueras_comment` = '$observation_Mangueras',
    `volco` = '$switchstatusVolco',
    `volco_comment` = '$observation_statusVolco',
    `tCombu` = '$switchtanqueCombus',
    `tCombu_comment` = '$observation_tanqueCombus',
    `mBomba` = '$switchmotorBomba',
    `mBomba_comment` = '$observation_motorBomba',
    `llantas` = '$switchllantasStatus',
    `llantas_comment` = '$observation_llantasStatus',
    `femer` = '$switchfemer',
    `femer_comment` = '$observation_femer',
    `gvolco` = '$switchgvolco',
    `gvolco_comment` = '$observation_gvolco'
    WHERE id_report = '$id'";
$resultadoUpdateChecklist = mysqli_query($conexion, $sqlUpdateChecklist);

        if ($resultadoUpdateChecklist) {
            echo json_encode("success_check");
        } else {
            echo json_encode("checklist_update_error");
        }

} else {
    echo json_encode("trascabo_update_error");
}




} 
}
else {
    // Handle decoding error
    echo "Error decoding JSON data";
}   

?>