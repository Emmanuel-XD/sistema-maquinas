<?php include "../includes/header.php";
 $id = $_GET['id'];
 require_once "../includes/db.php";
$query="SELECT
    trascabo_reports.id,
    trascabo_reports.id_maquina,
    trascabo_reports.contractor_name,
    trascabo_reports.week_number,
    trascabo_reports.month,
    trascabo_reports.was_used,
    trascabo_reports.period_date,
    trascabo_reports.date_register,
    checklist_trascabo.frontIntert,
    checklist_trascabo.frontIntert_comment,
    checklist_trascabo.traTrab,
    checklist_trascabo.traTrab_comment,
    checklist_trascabo.dirDel,
    checklist_trascabo.dirDel_comment,
    checklist_trascabo.dirTra,
    checklist_trascabo.dirTra_comment,
    checklist_trascabo.stpTra,
    checklist_trascabo.stpTra_comment,
    checklist_trascabo.espLat,
    checklist_trascabo.espLat_comment,
    checklist_trascabo.alarmRet,
    checklist_trascabo.alarmRet_comment,
    checklist_trascabo.claxon,
    checklist_trascabo.claxon_comment,
    checklist_trascabo.fserv,
    checklist_trascabo.fserv_comment,
    checklist_trascabo.dirSusp,
    checklist_trascabo.dirSusp_comment,
    checklist_trascabo.cintSeg,
    checklist_trascabo.cintSeg_comment,
    checklist_trascabo.vidFront,
    checklist_trascabo.vidFront_comment,
    checklist_trascabo.limpBris,
    checklist_trascabo.limpBris_comment,
    checklist_trascabo.extnt,
    checklist_trascabo.extnt_comment,
    checklist_trascabo.asiento,
    checklist_trascabo.asiento_comment,
    checklist_trascabo.indiHidra,
    checklist_trascabo.indiHidra_comment,
    checklist_trascabo.motorRef,
    checklist_trascabo.motorRef_comment,
    checklist_trascabo.batCable,
    checklist_trascabo.batCable_comment,
    checklist_trascabo.horometro,
    checklist_trascabo.horometro_comment,
    checklist_trascabo.fugHidra,
    checklist_trascabo.fugHidra_comment,
    checklist_trascabo.pasaSusp,
    checklist_trascabo.pasaSusp_comment,
    checklist_trascabo.fugAire,
    checklist_trascabo.fugAire_comment,
    checklist_trascabo.grapasAnc,
    checklist_trascabo.grapasAnc_comment,
    checklist_trascabo.cardam,
    checklist_trascabo.cardam_comment,
    checklist_trascabo.AcoplesRap,
    checklist_trascabo.AcoplesRap_comment,
    checklist_trascabo.mangueras,
    checklist_trascabo.mangueras_comment,
    checklist_trascabo.volco,
    checklist_trascabo.volco_comment,
    checklist_trascabo.tCombu,
    checklist_trascabo.tCombu_comment,
    checklist_trascabo.mBomba,
    checklist_trascabo.mBomba_comment,
    checklist_trascabo.llantas,
    checklist_trascabo.llantas_comment,
    checklist_trascabo.gvolco,
    checklist_trascabo.gvolco_comment,
    checklist_trascabo.femer,
    checklist_trascabo.femer_comment
FROM
    trascabo_reports
JOIN
    checklist_trascabo ON trascabo_reports.id = checklist_trascabo.id_report
WHERE
    trascabo_reports.id = '$id';";
$result = $conexion->query($query);

// Check if the query was successful
if ($result === false) {
    echo "Error executing query: " . $conexion->error;
} else {
    // Check if there are any rows returned
    if ($result->num_rows > 0) {
        // Loop through the result set and output data
        while ($row = $result->fetch_assoc()) {
        
?>


<body  id="page-top">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-9">
                <h1>Reportes trascabo</h1>  
            </div>
            <div class="col-sm-2">
               
                  <button type="button" id="updateData" class="btn btn-success btn-block">Actualizar reporte</button>
             </div>
             <div class="col-sm-1">
             <button type="button" id="exitForm" class="btn btn-danger btn-block">Salir</button>
             </div>
        </div>
    
            <form id="formTrascabo">
            <input type="text" name="id" id="id" hidden value="<?php echo $row["id"] ?>">
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-12">
                            <label for="exampleFormControlInput1">Contratista y/o proveedor</label>
                            <input type="text" class="form-control" id="fullName" name="fullName" placeholder="nombre completo" value="<?php echo $row["contractor_name"] ?>" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <!-- <div class="col-sm-4">
                                <label for="">N° Serie:</label>
                                <input type="text" class="form-control" id="numSerie" name="numSerie" placeholder="000000" required>
                        </div>
                        <div class="col-sm-4">
                                <label for="">Modelo:</label>
                                <input type="text" class="form-control" id="model"  name="model" placeholder="000000" required>
                        </div> -->
                        <div class="col-sm-2">
                            <label for="maquina">Maquina: </label>
                            <select class="form-control" name="id_maquina" id="id_maquina" value="<?php echo $row["id_maquina"] ?>" required>
                            <option value="">Selecciona una opción</option>
                            <?php
                            include("../includes/db.php");
                            // Código para mostrar categorías desde otra tabla
                            $sql = "SELECT * FROM maquinas ";
                            $resultado = mysqli_query($conexion, $sql);
                            while ($consulta = mysqli_fetch_array($resultado)) {
                                echo '<option value="' . $consulta['id'] . '" ' . ($row["id_maquina"] == $consulta['id'] ? 'selected' : '') . '>' . $consulta['name'] . '</option>';
                            }
                            ?>
                        </select>
                        </div>
                        <div class="col-sm-2">
                                <label for="">Semana:</label>
                                <input type="text" class="form-control" id="week" name="week" placeholder="00"value="<?php echo $row["week_number"] ?>" required>
                        </div>
                        <div class="col-sm-2">
                                <label for="fecha">Fecha:</label>
                                <input type="date"  class="form-control" id="fecha" name="fecha" value="<?php echo $row["date_register"] ?>" required>
                        </div>
                        <div class="col-sm-2">
                                <label for="mes">Mes:</label>
                                <select name="mes" id="mes" class="form-control" required>
                                <option value="" <?php echo $row["month"] == "" ? 'selected' : ''; ?>>Selecciona una opción</option>
                                <option value="1" <?php echo $row["month"] == "1" ? 'selected' : ''; ?>>Enero</option>
                                <option value="2" <?php echo $row["month"] == "2" ? 'selected' : ''; ?>>Febrero</option>
                                <option value="3" <?php echo $row["month"] == "3" ? 'selected' : ''; ?>>Marzo</option>
                                <option value="4" <?php echo $row["month"] == "4" ? 'selected' : ''; ?>>Abril</option>
                                <option value="5" <?php echo $row["month"] == "8" ? 'selected' : ''; ?>>Agosto</option>
                                <option value="9" <?php echo $row["month"] == "9" ? 'selected' : ''; ?>>Septiembre</option>
                                <option value="10" <?php echo $row["month"] == "10" ? 'selected' : ''; ?>>Octubre</option>
                                <option value="11" <?php echo $row["month"]== "11" ? 'selected' : ''; ?>>Noviembre</option>
                                <option value="12" <?php echo $row["month"] == "12" ? 'selected' : ''; ?>>Diciembre</option>
                                </select>
                        </div>
                        <div class="col-sm-2">
                                <label for="Periodo">Periodo:</label>
                                <input type="text"  class="form-control" id="Periodo"  name="Periodo" placeholder="00000-00000" value="<?php echo $row["period_date"] ?>"  required >
                        </div>
                        <div class="col-sm-2">
                                <label for="operator">Opero:</label>
                                <select name="opero" id="opero" class="form-control" required>
                                    <option value="" <?php echo $row["was_used"] == "" ? 'selected' : ''; ?>>Selecciona una opción</option>
                                    <option value="0" <?php echo $row["was_used"] == "0" ? 'selected' : ''; ?>>Sí</option>
                                    <option value="1" <?php echo $row["was_used"] == "1" ? 'selected' : ''; ?>>No</option>
                                </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-4">
                                 <center><b><p>Luces</p></b></center>
                                 <!-- tasks -->
                            <div class="row">
                                    <div class="col-sm-5">
                                    <label for="Frontint">Frontales,intermitentes:</label>
                                    </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">
                                                <input type="radio" name="switchFrontint" value="0" required  <?php echo $row["frontIntert"] == "0" ? 'checked' : ''; ?>/>
                                                <div class="state p-success">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">
                                                <input type="radio" name="switchFrontint"  value="1" required  <?php echo $row["frontIntert"] == "1" ? 'checked' : ''; ?>/>
                                                <div class="state p-danger">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-5">
                                            <input type="text" class="form-control" name="observation_Fronint" id="observation_Fronint" value=<?php echo $row["frontIntert_comment"] ?> required >
                                            </div>
                            </div>
                            <br>
                            <div class="row">
                                    <div class="col-sm-5">
                                    <label for="Tratrabajo">Traseras de trabajo (reflector):</label>
                                    </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">
                                                <input type="radio" name="switchTratrabajo"  value="0" required <?php echo $row["traTrab"] == "0" ? 'checked' : ''; ?>/>
                                                <div class="state p-success">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">
                                                <input type="radio" name="switchTratrabajo" value="1" required <?php echo $row["traTrab"] == "1" ? 'checked' : ''; ?>/>
                                                <div class="state p-danger">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-5">
                                            <input type="text" class="form-control" name="observation_Tratrabajo" id="observation_Tratrabajo" value=<?php echo $row["traTrab_comment"] ?> required>
                                            </div>
                                            
        
                                        
                        </div>
                        <div class="row">
                                    <div class="col-sm-5">
                                    <label for="Dirdelpark">Direccionales delanteras de parqueo(giro):</label>
                                    </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">
                                                <input type="radio" name="switchDirdelpark"  value="0" required <?php echo $row["dirDel"] == "0" ? 'checked' : ''; ?>>
                                                <div class="state p-success">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">
                                                <input type="radio" name="switchDirdelpark"  value="1" required <?php echo $row["dirDel"] == "1" ? 'checked' : ''; ?> >
                                                <div class="state p-danger">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-5">
                                            <input type="text" class="form-control" name="observation_Dirdelpark" id="observation_Dirdelpark" value=<?php echo $row["dirDel_comment"] ?> required >
                                            </div>
                                            

                        </div>
                        <div class="row">
                                    <div class="col-sm-5">
                                    <label for="Dirtrapark">Direccionales traseras de parqueo(giro):</label>
                                    </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">
                                                <input type="radio" name="switchDirtrapark"  value="0" required <?php echo $row["dirTra"] == "0" ? 'checked' : ''; ?>>
                                                <div class="state p-success">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">
                                                <input type="radio" name="switchDirtrapark"  value="1" required <?php echo $row["dirTra"] == "1" ? 'checked' : ''; ?>>
                                                <div class="state p-danger">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-5">
                                            <input type="text" class="form-control" name="observation_Dirtrapark" id="observation_Dirtrapark" value=<?php echo $row["dirTra_comment"] ?> required>
                                            </div>
                                            

                        </div>
                        <div class="row">
                                    <div class="col-sm-5">
                                    <label for="stopTra">De stop y señal trasera:</label>
                                    </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">
                                                <input type="radio" name="switchstopTra"  value="0" required <?php echo $row["stpTra"] == "0" ? 'checked' : ''; ?>>
                                                <div class="state p-success">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">
                                                <input type="radio" name="switchstopTra"  value="1" required <?php echo $row["stpTra"] == "1" ? 'checked' : ''; ?>>
                                                <div class="state p-danger">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-5">
                                            <input type="text" class="form-control" name="observation_stopTra" id="observation_stopTra" value=<?php echo $row["stpTra_comment"] ?> required>
                                            </div>
                                            

                        </div>
                    </div>
                    <div class="col-sm-4">
                    <center><b><p>Cabina</p></b></center>
                    <div class="row">
                                    <div class="col-sm-5">
                                    <label for="latMirror">Espejos laterales:</label>
                                    </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">
                                                <input type="radio" name="switchlatMirror"  value="0" required <?php echo $row["espLat"] == "0" ? 'checked' : ''; ?>>
                                                <div class="state p-success">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">
                                                <input type="radio" name="switchlatMirror"  value="1" required <?php echo $row["espLat"] == "1" ? 'checked' : ''; ?>>
                                                <div class="state p-danger">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-5">
                                            <input type="text" class="form-control" name="observation_latMirror" id="observation_latMirror" value=<?php echo $row["espLat_comment"] ?> required>
                                            </div>
                                            

                        </div>
                        <br>
                        <div class="row">
                                    <div class="col-sm-5">
                                    <label for="retAlarm">Alarma de retroceso:</label>
                                    </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">
                                                <input type="radio" name="switchretAlarm"  value="0" required <?php echo $row["alarmRet"] == "0" ? 'checked' : ''; ?>>
                                                <div class="state p-success">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">
                                                <input type="radio" name="switchretAlarm"  value="1" required <?php echo $row["alarmRet"] == "1" ? 'checked' : ''; ?>>
                                                <div class="state p-danger">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-5">
                                            <input type="text" class="form-control" name="observation_retAlarm" id="observation_retAlarm" value=<?php echo $row["alarmRet_comment"] ?> required >
                                            </div>
                                            

                        </div>
                        <br>
                        <div class="row">
                                    <div class="col-sm-5">
                                    <label for="claxChck">Claxon:</label>
                                    </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">    
                                                <input type="radio" name="switchclaxChck"  value="0" required <?php echo $row["claxon"] == "0" ? 'checked' : ''; ?>>
                                                <div class="state p-success">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">
                                                <input type="radio" name="switchclaxChck"  value="1" required <?php echo $row["claxon"] == "1" ? 'checked' : ''; ?>>
                                                <div class="state p-danger">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-5">
                                            <input type="text" class="form-control" name="observation_claxChck" id="observation_claxChck" value=<?php echo $row["claxon_comment"] ?> required >
                                            </div>
                                            

                        </div>
                        <br>
                        <div class="row">
                                    <div class="col-sm-5">
                                    <label for="servFre">Freno de servicio:</label>
                                    </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">    
                                                <input type="radio" name="switchservFre"  value="0" required <?php echo $row["fserv"] == "0" ? 'checked' : ''; ?>>
                                                <div class="state p-success">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">
                                                <input type="radio" name="switchservFre"  value="1" required <?php echo $row["fserv"] == "1" ? 'checked' : ''; ?>>
                                                <div class="state p-danger">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-5">
                                            <input type="text" class="form-control" name="observation_servFre" id="observation_servFre" value=<?php echo $row["fserv_comment"] ?> required>
                                            </div>
                                            

                        </div>
                        <br>
                        <div class="row">
                                    <div class="col-sm-5">
                                    <label for="femer">Freno de emergencia:</label>
                                    </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">    
                                                <input type="radio" name="switchfemer"  value="0" required <?php echo $row["femer"] == "0" ? 'checked' : ''; ?>>
                                                <div class="state p-success">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">
                                                <input type="radio" name="switchfemer"  value="1" required <?php echo $row["femer"] == "1" ? 'checked' : ''; ?>>
                                                <div class="state p-danger">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-5">
                                            <input type="text" class="form-control" name="observation_femer" id="observation_femer" value=<?php echo $row["femer_comment"] ?> required>
                                            </div>
                                            

                        </div>
                        <br>
                        <div class="row">
                                    <div class="col-sm-5">
                                    <label for="dirSusp">Dirección /suspensión (terminales):</label>
                                    </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">    
                                                <input type="radio" name="switchdirSusp"  value="0" required <?php echo $row["dirSusp"] == "0" ? 'checked' : ''; ?>>
                                                <div class="state p-success">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">
                                                <input type="radio" name="switchdirSusp"  value="1" required <?php echo $row["dirSusp"] == "1" ? 'checked' : ''; ?>>
                                                <div class="state p-danger">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-5">
                                            <input type="text" class="form-control" name="observation_dirSusp" id="observation_dirSusp" value=<?php echo $row["dirSusp_comment"] ?> required>
                                            </div>
                                            

                        </div>
                        <div class="row">
                                    <div class="col-sm-5">
                                    <label for="cintSeg">Cinturón de seguridad:</label>
                                    </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">    
                                                <input type="radio" name="switchcintSeg"  value="0" required <?php echo $row["cintSeg"] == "0" ? 'checked' : ''; ?>>
                                                <div class="state p-success">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">
                                                <input type="radio" name="switchcintSeg"  value="1" required <?php echo $row["cintSeg"] == "1" ? 'checked' : ''; ?>> 
                                                <div class="state p-danger">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-5">
                                            <input type="text" class="form-control" name="observation_cintSeg" id="observation_cintSeg" value=<?php echo $row["cintSeg_comment"] ?> required>
                                            </div>
                                            

                        </div>
                        <br>
                        <div class="row">
                                    <div class="col-sm-5">
                                    <label for="fronGlass">Vidrio frontal:</label>
                                    </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">    
                                                <input type="radio" name="switchfronGlass"  value="0" required <?php echo $row["vidFront"] == "0" ? 'checked' : ''; ?>>
                                                <div class="state p-success">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">
                                                <input type="radio" name="switchfronGlass"  value="1" required <?php echo $row["vidFront"] == "1" ? 'checked' : ''; ?>>
                                                <div class="state p-danger">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-5">
                                            <input type="text" class="form-control" name="observation_fronGlass" id="observation_fronGlass" value=<?php echo $row["vidFront_comment"] ?> required>
                                            </div>
                                            

                        </div>
                        <br>
                        <div class="row">
                                    <div class="col-sm-5">
                                    <label for="limBris">Limpia brisas:</label>
                                    </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">    
                                                <input type="radio" name="switchlimBris"  value="0" required <?php echo $row["limpBris"] == "0" ? 'checked' : ''; ?>>
                                                <div class="state p-success">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">
                                                <input type="radio" name="switchlimBris"  value="1" required <?php echo $row["limpBris"] == "1" ? 'checked' : ''; ?>>
                                                <div class="state p-danger">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-5">
                                            <input type="text" class="form-control" name="observation_limBris" id="observation_limBris" value=<?php echo $row["limpBris_comment"] ?> required>
                                            </div>
                                            

                        </div>
                        <br>
                        <div class="row">
                                    <div class="col-sm-5">
                                    <label for="extnt">Extintor 2.0kg:</label>
                                    </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">    
                                                <input type="radio" name="switchextnt"  value="0" required <?php echo $row["extnt"] == "0" ? 'checked' : ''; ?>>
                                                <div class="state p-success">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">
                                                <input type="radio" name="switchextnt"  value="1"required <?php echo $row["extnt"] == "1" ? 'checked' : ''; ?>>
                                                <div class="state p-danger">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-5">
                                            <input type="text" class="form-control" name="observation_extnt" id="observation_extnt" value=<?php echo $row["extnt_comment"] ?> required>
                                            </div>
                                            

                        </div>
                        <br>
                        <div class="row">
                                    <div class="col-sm-5">
                                    <label for="asiento">Asiento en buena condición:</label>
                                    </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">    
                                                <input type="radio" name="switchasiento"  value="0" required <?php echo $row["asiento"] == "0" ? 'checked' : ''; ?>>
                                                <div class="state p-success">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">
                                                <input type="radio" name="switchasiento"  value="1" required <?php echo $row["asiento"] == "1" ? 'checked' : ''; ?>>
                                                <div class="state p-danger">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-5">
                                            <input type="text" class="form-control" name="observation_asiento" id="observation_asiento" value=<?php echo $row["asiento_comment"] ?> required>
                                            </div>
                                            

                        </div>
                        <br>
                        <div class="row">
                                    <div class="col-sm-5">
                                    <label for="indiHid">Indicadores (hidráulico-voltimetro):</label>
                                    </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">    
                                                <input type="radio" name="switchindiHid"  value="0" required <?php echo $row["indiHidra"] == "0" ? 'checked' : ''; ?>>
                                                <div class="state p-success">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">
                                                <input type="radio" name="switchindiHid"  value="1" required <?php echo $row["indiHidra"] == "1" ? 'checked' : ''; ?>>
                                                <div class="state p-danger">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-5">
                                            <input type="text" class="form-control" name="observation_indiHid" id="observation_indiHid" value=<?php echo $row["indiHidra_comment"] ?> required>
                                            </div>
                                            

                        </div>
                        <div class="row">
                                    <div class="col-sm-5">
                                    <label for="refrig">Motor, refirgerante, aire:</label>
                                    </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">    
                                                <input type="radio" name="switchrefrig"  value="0" required <?php echo $row["motorRef"] == "0" ? 'checked' : ''; ?>>
                                                <div class="state p-success">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">
                                                <input type="radio" name="switchrefrig"  value="1" required <?php echo $row["motorRef"] == "1" ? 'checked' : ''; ?>>
                                                <div class="state p-danger">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-5">
                                            <input type="text" class="form-control" name="observation_refrig" id="observation_refrig" value=<?php echo $row["motorRef_comment"] ?> required>
                                            </div>
                                            

                        </div>
                        <br>
                        <div class="row">
                                    <div class="col-sm-5">
                                    <label for="batCab">Batería y cables:</label>
                                   
                                    </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">    
                                                <input type="radio" name="switchbatCab"  value="0" required <?php echo $row["batCable"] == "0" ? 'checked' : ''; ?>>
                                                <div class="state p-success">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">
                                                <input type="radio" name="switchbatCab"  value="1" required <?php echo $row["batCable"] == "1" ? 'checked' : ''; ?>>
                                                <div class="state p-danger">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-5">
                                            <input type="text" class="form-control" name="observation_batCab" id="observation_batCab" value=<?php echo $row["batCable_comment"] ?>>
                                            </div>
                                            

                        </div>
                        <br>
                        <div class="row">
                                    <div class="col-sm-4">
                                    <label for="batCab">horometro:</label>
                                    <br>
                                    </div>
                                            <div class="col-sm-3">
                                                    <input type="number"   class="form-control" name="horometro" id="horometro" value="<?php echo $row["horometro"] ?>" required >
                                            </div>
                                            <div class="col-sm-5">
                                            <input type="text" class="form-control" name="observation_horometro" id="observation_horometro" required value="<?php echo $row["horometro_comment"] ?>">
                                            </div>
                                            

                        </div>
                    </div>
                    <div class="col-sm-4">
                            <center><b><p>Estado mecánico</p></b></center>
                            <div class="row">
                                    <div class="col-sm-5">
                                    <label for="Cfugas">Control de fugas hidráulicas:</label>
                                   
                                    </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">    
                                                <input type="radio" name="switchCfugas"  value="0" required <?php echo $row["fugHidra"] == "0" ? 'checked' : ''; ?>>
                                                <div class="state p-success">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">
                                                <input type="radio" name="switchCfugas"  value="1" required <?php echo $row["fugHidra"] == "1" ? 'checked' : ''; ?>>
                                                <div class="state p-danger">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-5">
                                            <input type="text" class="form-control" name="observation_Cfugas" id="observation_Cfugas" value=<?php echo $row["fugHidra_comment"] ?> required>
                                            </div>
                                            

                        </div>
                        <br>
                        <div class="row">
                                    <div class="col-sm-5">
                                    <label for="pasadSusp">Pasadores, suspensión:</label>
                                   
                                    </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">    
                                                <input type="radio" name="switchpasadSusp"  value="0" required <?php echo $row["pasaSusp"] == "0" ? 'checked' : ''; ?>>
                                                <div class="state p-success">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">
                                                <input type="radio" name="switchpasadSusp"  value="1" required <?php echo $row["pasaSusp"] == "1" ? 'checked' : ''; ?>>
                                                <div class="state p-danger">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-5">
                                            <input type="text" class="form-control" name="observation_pasadSusp" id="observation_pasadSusp" value=<?php echo $row["pasaSusp_comment"] ?> required>
                                            </div>
                                            

                        </div>
                        <br>
                        <div class="row">
                                    <div class="col-sm-5">
                                    <label for="ctrlFugas">Control fugas de aire:</label>
                                   
                                    </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">    
                                                <input type="radio" name="switchctrlFugas"  value="0" required <?php echo $row["fugAire"] == "0" ? 'checked' : ''; ?>>
                                                <div class="state p-success">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">
                                                <input type="radio" name="switchctrlFugas"  value="1" required <?php echo $row["fugAire"] == "1" ? 'checked' : ''; ?>>
                                                <div class="state p-danger">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-5">
                                            <input type="text" class="form-control" name="observation_ctrlFugas" id="observation_ctrlFugas" value=<?php echo $row["fugAire_comment"] ?> required>
                                            </div>
                                            

                        </div>
                        <br>
                        <div class="row">
                                    <div class="col-sm-5">
                                    <label for="grapasAnclaje">Grapas y anclaje de chasis:</label>
                                   
                                    </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">    
                                                <input type="radio" name="switchgrapasAnclaje"  value="0" required <?php echo $row["grapasAnc"] == "0" ? 'checked' : ''; ?>>
                                                <div class="state p-success">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">
                                                <input type="radio" name="switchgrapasAnclaje"  value="1" required <?php echo $row["grapasAnc"] == "1" ? 'checked' : ''; ?>>
                                                <div class="state p-danger">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-5">
                                            <input type="text" class="form-control" name="observation_grapasAnclaje" id="observation_grapasAnclaje" value=<?php echo $row["grapasAnc_comment"] ?> required>
                                            </div>
                                            

                        </div>
                        <br>
                        <div class="row">
                                    <div class="col-sm-5">
                                    <label for="cardam">Cardam, delantero, trasero, pin del cardan:</label>
                                   
                                    </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">    
                                                <input type="radio" name="switchcardam"  value="0" required <?php echo $row["cardam"] == "0" ? 'checked' : ''; ?>>
                                                <div class="state p-success">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">
                                                <input type="radio" name="switchcardam"  value="1" required <?php echo $row["cardam"] == "1" ? 'checked' : ''; ?>>
                                                <div class="state p-danger">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-5">
                                            <input type="text" class="form-control" name="observation_cardam" id="observation_cardam" value=<?php echo $row["cardam_comment"] ?> required>
                                            </div>
                                            

                        </div>
                        <div class="row">
                                    <div class="col-sm-5">
                                    <label for="acoples">Acoples rapidos:</label>
                                   
                                    </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">    
                                                <input type="radio" name="switchacoples"  value="0" required <?php echo $row["AcoplesRap"] == "0" ? 'checked' : ''; ?>>
                                                <div class="state p-success">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">
                                                <input type="radio" name="switchacoples"  value="1" required <?php echo $row["AcoplesRap"] == "1" ? 'checked' : ''; ?>>
                                                <div class="state p-danger">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-5">
                                            <input type="text" class="form-control" name="observation_acoples" id="observation_acoples" value=<?php echo $row["AcoplesRap_comment"] ?> required>
                                            </div>
                                            

                        </div>
                        <br>
                        <div class="row">
                                    <div class="col-sm-5">
                                    <label for="Mangueras">Mangueras:</label>
                                   
                                    </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">    
                                                <input type="radio" name="switchMangueras"  value="0" required <?php echo $row["mangueras"] == "0" ? 'checked' : ''; ?>>
                                                <div class="state p-success">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">
                                                <input type="radio" name="switchMangueras"  value="1" required <?php echo $row["mangueras"] == "1" ? 'checked' : ''; ?>>
                                                <div class="state p-danger">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-5">
                                            <input type="text" class="form-control" name="observation_Mangueras" id="observation_Mangueras" value=<?php echo $row["mangueras_comment"] ?> required>
                                            </div>
                                            

                        </div>
                        <br>
                                      <div class="row">
                                    <div class="col-sm-5">
                                    <label for="statusVolco">Estado general del volcó:</label>
                                   
                                    </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">    
                                                <input type="radio" name="switchstatusVolco"  value="0" required <?php echo $row["volco"] == "0" ? 'checked' : ''; ?>> 
                                                <div class="state p-success">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">
                                                <input type="radio" name="switchstatusVolco"  value="1" required <?php echo $row["volco"] == "1" ? 'checked' : ''; ?>>
                                                <div class="state p-danger">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-5">
                                            <input type="text" class="form-control" name="observation_statusVolco" id="observation_statusVolco" value=<?php echo $row["volco_comment"] ?> required>
                                            </div>
                                            

                        </div>
                        <br>
                        <div class="row">
                                    <div class="col-sm-5">
                                    <label for="gvolco">Gato de levante del volco:</label>
                                    </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">    
                                                <input type="radio" name="switchgvolco"  value="0" required <?php echo $row["gvolco"] == "0" ? 'checked' : ''; ?>>
                                                <div class="state p-success">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">
                                                <input type="radio" name="switchgvolco"  value="1" required <?php echo $row["gvolco"] == "1" ? 'checked' : ''; ?>>
                                                <div class="state p-danger">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-5">
                                            <input type="text" class="form-control" name="observation_gvolco" id="observation_gvolco" value=<?php echo $row["gvolco_comment"] ?> required>
                                            </div>
                                            

                        </div>
                        <br>
                        <div class="row">
                                    <div class="col-sm-5">
                                    <label for="tanqueCombus">Tanque de combustible(abrasaderas,soporte):</label>
                                   
                                    </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">    
                                                <input type="radio" name="switchtanqueCombus"  value="0" required <?php echo $row["tCombu"] == "0" ? 'checked' : ''; ?>>
                                                <div class="state p-success">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">
                                                <input type="radio" name="switchtanqueCombus"  value="1" required <?php echo $row["tCombu"] == "1" ? 'checked' : ''; ?>>
                                                <div class="state p-danger">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-5">
                                            <input type="text" class="form-control" name="observation_tanqueCombus" id="observation_tanqueCombus" value=<?php echo $row["tCombu_comment"] ?> required>
                                            </div>
                                            

                        </div>
                        <div class="row">
                                    <div class="col-sm-5">
                                    <label for="motorBomba">Motor de bomba:</label>
                                   
                                    </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">    
                                                <input type="radio" name="switchmotorBomba"  value="0" required <?php echo $row["mBomba"] == "0" ? 'checked' : ''; ?>>
                                                <div class="state p-success">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">
                                                <input type="radio" name="switchmotorBomba"  value="1" required <?php echo $row["mBomba"] == "1" ? 'checked' : ''; ?>>
                                                <div class="state p-danger">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-5">
                                            <input type="text" class="form-control" name="observation_motorBomba" id="observation_motorBomba" value=<?php echo $row["mBomba_comment"] ?> required>
                                            </div>
                                            

                        </div>  
                        <br>
                        <div class="row">
                                    <div class="col-sm-5">
                                    <label for="llantasStatus">Llantas: cortaduras, abultamientos:</label>
                                   
                                    </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">    
                                                <input type="radio" name="switchllantasStatus"  value="0" required <?php echo $row["llantas"] == "0" ? 'checked' : ''; ?>>
                                                <div class="state p-success">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">
                                                <input type="radio" name="switchllantasStatus"  value="1" required <?php echo $row["llantas"] == "1" ? 'checked' : ''; ?>>
                                                <div class="state p-danger">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-5">
                                            <input type="text" class="form-control" name="observation_llantasStatus" id="observation_llantasStatus" value=<?php echo $row["llantas_comment"] ?> required>
                                            </div>
                                        <?php    
                                        }
    } else {
        echo "No results found for ID: $id";
    }

    // Free the result set
    $result->free_result();
}

?>
                        </div>  
                    </div>
                </div>
        </form>
    </div>
</body>


    <script src="../js/trascaboReport.js"></script>
    <?php include "../includes/footer.php";?>