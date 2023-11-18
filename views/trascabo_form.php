    <?php include "../includes/header.php";?>


<body  id="page-top">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-9">
                <h1>Reportes trascabo</h1>  
            </div>
             <div class="col-sm-1">
             <button type="button" id="goReports" class="btn btn-warning btn-block">Reportes</button>
             </div>
            <div class="col-sm-1">
                  <button type="button" id="saveData" class="btn btn-success btn-block">Guardar</button>
             </div>
             <div class="col-sm-1">
             <button type="button" id="exitForm" class="btn btn-danger btn-block">Salir</button>
             </div>
        </div>
    
            <form id="formTrascabo">
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-12">
                            <label for="exampleFormControlInput1">Contratista y/o proveedor</label>
                            <input type="text" class="form-control" id="fullName" name="fullName" placeholder="nombre completo" required>
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
                            <select class="form-control" name="id_maquina" id="id_maquina" required>
                            <option value="">Selecciona una opción</option>
                            <?php
                            include("../includes/db.php");
                            // Código para mostrar categorías desde otra tabla
                            $sql = "SELECT * FROM maquinas ";
                            $resultado = mysqli_query($conexion, $sql);
                            while ($consulta = mysqli_fetch_array($resultado)) {
                                echo '<option value="' . $consulta['id'] . '">' . $consulta['name'] . '</option>';
                            }
                            ?>
                        </select>
                        </div>
                        <div class="col-sm-2">
                                <label for="">Semana:</label>
                                <input type="text" class="form-control" id="week" name="week" placeholder="00" required>
                        </div>
                        <div class="col-sm-2">
                                <label for="fecha">Fecha:</label>
                                <input type="date"  class="form-control" id="fecha" name="fecha" placeholder="00-00-2000" required>
                        </div>
                        <div class="col-sm-2">
                                <label for="mes">Mes:</label>
                                <select name="mes" id="mes" class="form-control" required>
                                <option value="">Selecciona una opción</option>
                                <option value="1">Enero</option>
                                <option value="2">Febrero</option>
                                <option value="3">Marzo</option>
                                <option value="4">Abril</option>
                                <option value="5">Mayo</option>
                                <option value="6">Junio</option>
                                <option value="7">Julio</option>
                                <option value="8">Agosto</option>
                                <option value="9">Septiembre</option>
                                <option value="10">Octubre</option>
                                <option value="11">Noviembre</option>
                                <option value="12">Diciembre</option>
                                </select>
                        </div>
                        <div class="col-sm-2">
                                <label for="Periodo">Periodo:</label>
                                <input type="text"  class="form-control" id="Periodo"  name="Periodo" placeholder="00000-00000" required >
                        </div>
                        <div class="col-sm-2">
                                <label for="operator">Opero:</label>
                                <select name="opero" id="opero" class="form-control" required>
                                    <option value="">Selecciona una opción</option>
                                    <option value="0">Sí</option>
                                    <option value="1">No</option>
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
                                                <input type="radio" name="switchFrontint" value="0" required />
                                                <div class="state p-success">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">
                                                <input type="radio" name="switchFrontint"  value="1" required/>
                                                <div class="state p-danger">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-5">
                                            <input type="text" class="form-control" name="observation_Fronint" id="observation_Fronint" required>
                                            </div>
                            </div>
                            <br>
                            <div class="row">
                                    <div class="col-sm-5">
                                    <label for="Tratrabajo">Traseras de trabajo (reflector):</label>
                                    </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">
                                                <input type="radio" name="switchTratrabajo"  value="0" required/>
                                                <div class="state p-success">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">
                                                <input type="radio" name="switchTratrabajo" value="1" required/>
                                                <div class="state p-danger">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-5">
                                            <input type="text" class="form-control" name="observation_Tratrabajo" id="observation_Tratrabajo" required>
                                            </div>
                                            
        
                                        
                        </div>
                        <div class="row">
                                    <div class="col-sm-5">
                                    <label for="Dirdelpark">Direccionales delanteras de parqueo(giro):</label>
                                    </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">
                                                <input type="radio" name="switchDirdelpark"  value="0" required>
                                                <div class="state p-success">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">
                                                <input type="radio" name="switchDirdelpark"  value="1" required >
                                                <div class="state p-danger">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-5">
                                            <input type="text" class="form-control" name="observation_Dirdelpark" id="observation_Dirdelpark" required>
                                            </div>
                                            

                        </div>
                        <div class="row">
                                    <div class="col-sm-5">
                                    <label for="Dirtrapark">Direccionales traseras de parqueo(giro):</label>
                                    </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">
                                                <input type="radio" name="switchDirtrapark"  value="0" required>
                                                <div class="state p-success">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">
                                                <input type="radio" name="switchDirtrapark"  value="1" required>
                                                <div class="state p-danger">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-5">
                                            <input type="text" class="form-control" name="observation_Dirtrapark" id="observation_Dirtrapark" required>
                                            </div>
                                            

                        </div>
                        <div class="row">
                                    <div class="col-sm-5">
                                    <label for="stopTra">De stop y señal trasera:</label>
                                    </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">
                                                <input type="radio" name="switchstopTra"  value="0" required>
                                                <div class="state p-success">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">
                                                <input type="radio" name="switchstopTra"  value="1" required>
                                                <div class="state p-danger">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-5">
                                            <input type="text" class="form-control" name="observation_stopTra" id="observation_stopTra" required>
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
                                                <input type="radio" name="switchlatMirror"  value="0" required>
                                                <div class="state p-success">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">
                                                <input type="radio" name="switchlatMirror"  value="1" required>
                                                <div class="state p-danger">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-5">
                                            <input type="text" class="form-control" name="observation_latMirror" id="observation_latMirror" required>
                                            </div>
                                            

                        </div>
                        <br>
                        <div class="row">
                                    <div class="col-sm-5">
                                    <label for="retAlarm">Alarma de retroceso:</label>
                                    </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">
                                                <input type="radio" name="switchretAlarm"  value="0" required>
                                                <div class="state p-success">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">
                                                <input type="radio" name="switchretAlarm"  value="1" required>
                                                <div class="state p-danger">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-5">
                                            <input type="text" class="form-control" name="observation_retAlarm" id="observation_retAlarm" required>
                                            </div>
                                            

                        </div>
                        <br>
                        <div class="row">
                                    <div class="col-sm-5">
                                    <label for="claxChck">Claxon:</label>
                                    </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">    
                                                <input type="radio" name="switchclaxChck"  value="0" required>
                                                <div class="state p-success">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">
                                                <input type="radio" name="switchclaxChck"  value="1" required>
                                                <div class="state p-danger">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-5">
                                            <input type="text" class="form-control" name="observation_claxChck" id="observation_claxChck" required>
                                            </div>
                                            

                        </div>
                        <br>
                        <div class="row">
                                    <div class="col-sm-5">
                                    <label for="servFre">Freno de servicio:</label>
                                    </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">    
                                                <input type="radio" name="switchservFre"  value="0" required>
                                                <div class="state p-success">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">
                                                <input type="radio" name="switchservFre"  value="1" required>
                                                <div class="state p-danger">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-5">
                                            <input type="text" class="form-control" name="observation_servFre" id="observation_servFre" required>
                                            </div>
                                            

                        </div>
                        <br>
                        <div class="row">
                                    <div class="col-sm-5">
                                    <label for="femer">Freno de emergencia:</label>
                                    </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">    
                                                <input type="radio" name="switchfemer"  value="0" required>
                                                <div class="state p-success">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">
                                                <input type="radio" name="switchfemer"  value="1" required>
                                                <div class="state p-danger">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-5">
                                            <input type="text" class="form-control" name="observation_femer" id="observation_femer" required>
                                            </div>
                                            

                        </div>
                        <br>
                        <div class="row">
                                    <div class="col-sm-5">
                                    <label for="dirSusp">Dirección /suspensión (terminales):</label>
                                    </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">    
                                                <input type="radio" name="switchdirSusp"  value="0" required>
                                                <div class="state p-success">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">
                                                <input type="radio" name="switchdirSusp"  value="1" required>
                                                <div class="state p-danger">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-5">
                                            <input type="text" class="form-control" name="observation_dirSusp" id="observation_dirSusp" required>
                                            </div>
                                            

                        </div>
                        <div class="row">
                                    <div class="col-sm-5">
                                    <label for="cintSeg">Cinturón de seguridad:</label>
                                    </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">    
                                                <input type="radio" name="switchcintSeg"  value="0" required>
                                                <div class="state p-success">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">
                                                <input type="radio" name="switchcintSeg"  value="1" required>
                                                <div class="state p-danger">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-5">
                                            <input type="text" class="form-control" name="observation_cintSeg" id="observation_cintSeg" required>
                                            </div>
                                            

                        </div>
                        <br>
                        <div class="row">
                                    <div class="col-sm-5">
                                    <label for="fronGlass">Vidrio frontal:</label>
                                    </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">    
                                                <input type="radio" name="switchfronGlass"  value="0" required>
                                                <div class="state p-success">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">
                                                <input type="radio" name="switchfronGlass"  value="1" required>
                                                <div class="state p-danger">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-5">
                                            <input type="text" class="form-control" name="observation_fronGlass" id="observation_fronGlass" required>
                                            </div>
                                            

                        </div>
                        <br>
                        <div class="row">
                                    <div class="col-sm-5">
                                    <label for="limBris">Limpia brisas:</label>
                                    </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">    
                                                <input type="radio" name="switchlimBris"  value="0" required>
                                                <div class="state p-success">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">
                                                <input type="radio" name="switchlimBris"  value="1" required>
                                                <div class="state p-danger">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-5">
                                            <input type="text" class="form-control" name="observation_limBris" id="observation_limBris" required>
                                            </div>
                                            

                        </div>
                        <br>
                        <div class="row">
                                    <div class="col-sm-5">
                                    <label for="extnt">Extintor 2.0kg:</label>
                                    </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">    
                                                <input type="radio" name="switchextnt"  value="0" required>
                                                <div class="state p-success">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">
                                                <input type="radio" name="switchextnt"  value="1"required>
                                                <div class="state p-danger">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-5">
                                            <input type="text" class="form-control" name="observation_extnt" id="observation_extnt" required>
                                            </div>
                                            

                        </div>
                        <br>
                        <div class="row">
                                    <div class="col-sm-5">
                                    <label for="asiento">Asiento en buena condición:</label>
                                    </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">    
                                                <input type="radio" name="switchasiento"  value="0" required>
                                                <div class="state p-success">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">
                                                <input type="radio" name="switchasiento"  value="1" required>
                                                <div class="state p-danger">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-5">
                                            <input type="text" class="form-control" name="observation_asiento" id="observation_asiento" required>
                                            </div>
                                            

                        </div>
                        <br>
                        <div class="row">
                                    <div class="col-sm-5">
                                    <label for="indiHid">Indicadores (hidráulico-voltimetro):</label>
                                    </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">    
                                                <input type="radio" name="switchindiHid"  value="0" required>
                                                <div class="state p-success">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">
                                                <input type="radio" name="switchindiHid"  value="1" required>
                                                <div class="state p-danger">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-5">
                                            <input type="text" class="form-control" name="observation_indiHid" id="observation_indiHid" required>
                                            </div>
                                            

                        </div>
                        <div class="row">
                                    <div class="col-sm-5">
                                    <label for="refrig">Motor, refirgerante, aire:</label>
                                    </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">    
                                                <input type="radio" name="switchrefrig"  value="0" required>
                                                <div class="state p-success">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">
                                                <input type="radio" name="switchrefrig"  value="1" required>
                                                <div class="state p-danger">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-5">
                                            <input type="text" class="form-control" name="observation_refrig" id="observation_refrig" required>
                                            </div>
                                            

                        </div>
                        <br>
                        <div class="row">
                                    <div class="col-sm-5">
                                    <label for="batCab">Batería y cables:</label>
                                   
                                    </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">    
                                                <input type="radio" name="switchbatCab"  value="0" required>
                                                <div class="state p-success">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">
                                                <input type="radio" name="switchbatCab"  value="1" required>
                                                <div class="state p-danger">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-5">
                                            <input type="text" class="form-control" name="observation_batCab" id="observation_batCab">
                                            </div>
                                            

                        </div>
                        <br>
                        <div class="row">
                                    <div class="col-sm-4">
                                    <label for="batCab">horometro:</label>
                                    <br>
                                    </div>
                                            <div class="col-sm-3">
                                                    <input type="number"   class="form-control" name="horometro" id="horometro" required>
                                            </div>
                                            <div class="col-sm-5">
                                            <input type="text" class="form-control" name="observation_horometro" id="observation_horometro" required>
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
                                                <input type="radio" name="switchCfugas"  value="0" required>
                                                <div class="state p-success">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">
                                                <input type="radio" name="switchCfugas"  value="1" required>
                                                <div class="state p-danger">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-5">
                                            <input type="text" class="form-control" name="observation_Cfugas" id="observation_Cfugas" required>
                                            </div>
                                            

                        </div>
                        <br>
                        <div class="row">
                                    <div class="col-sm-5">
                                    <label for="pasadSusp">Pasadores, suspensión:</label>
                                   
                                    </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">    
                                                <input type="radio" name="switchpasadSusp"  value="0" required>
                                                <div class="state p-success">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">
                                                <input type="radio" name="switchpasadSusp"  value="1" required>
                                                <div class="state p-danger">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-5">
                                            <input type="text" class="form-control" name="observation_pasadSusp" id="observation_pasadSusp" required>
                                            </div>
                                            

                        </div>
                        <br>
                        <div class="row">
                                    <div class="col-sm-5">
                                    <label for="ctrlFugas">Control fugas de aire:</label>
                                   
                                    </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">    
                                                <input type="radio" name="switchctrlFugas"  value="0" required>
                                                <div class="state p-success">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">
                                                <input type="radio" name="switchctrlFugas"  value="1" required>
                                                <div class="state p-danger">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-5">
                                            <input type="text" class="form-control" name="observation_ctrlFugas" id="observation_ctrlFugas" required>
                                            </div>
                                            

                        </div>
                        <br>
                        <div class="row">
                                    <div class="col-sm-5">
                                    <label for="grapasAnclaje">Grapas y anclaje de chasis:</label>
                                   
                                    </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">    
                                                <input type="radio" name="switchgrapasAnclaje"  value="0" required>
                                                <div class="state p-success">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">
                                                <input type="radio" name="switchgrapasAnclaje"  value="1" required>
                                                <div class="state p-danger">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-5">
                                            <input type="text" class="form-control" name="observation_grapasAnclaje" id="observation_grapasAnclaje" required>
                                            </div>
                                            

                        </div>
                        <br>
                        <div class="row">
                                    <div class="col-sm-5">
                                    <label for="cardam">Cardam, delantero, trasero, pin del cardan:</label>
                                   
                                    </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">    
                                                <input type="radio" name="switchcardam"  value="0" required>
                                                <div class="state p-success">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">
                                                <input type="radio" name="switchcardam"  value="1" required>
                                                <div class="state p-danger">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-5">
                                            <input type="text" class="form-control" name="observation_cardam" id="observation_cardam" required>
                                            </div>
                                            

                        </div>
                        <div class="row">
                                    <div class="col-sm-5">
                                    <label for="acoples">Acoples rapidos:</label>
                                   
                                    </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">    
                                                <input type="radio" name="switchacoples"  value="0" required>
                                                <div class="state p-success">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">
                                                <input type="radio" name="switchacoples"  value="1" required>
                                                <div class="state p-danger">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-5">
                                            <input type="text" class="form-control" name="observation_acoples" id="observation_acoples" required>
                                            </div>
                                            

                        </div>
                        <br>
                        <div class="row">
                                    <div class="col-sm-5">
                                    <label for="Mangueras">Mangueras:</label>
                                   
                                    </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">    
                                                <input type="radio" name="switchMangueras"  value="0" required>
                                                <div class="state p-success">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">
                                                <input type="radio" name="switchMangueras"  value="1" required>
                                                <div class="state p-danger">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-5">
                                            <input type="text" class="form-control" name="observation_Mangueras" id="observation_Mangueras" required>
                                            </div>
                                            

                        </div>
                        <br>
                                      <div class="row">
                                    <div class="col-sm-5">
                                    <label for="statusVolco">Estado general del volcó:</label>
                                   
                                    </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">    
                                                <input type="radio" name="switchstatusVolco"  value="0" required> 
                                                <div class="state p-success">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">
                                                <input type="radio" name="switchstatusVolco"  value="1" required>
                                                <div class="state p-danger">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-5">
                                            <input type="text" class="form-control" name="observation_statusVolco" id="observation_statusVolco" required>
                                            </div>
                                            

                        </div>
                        <br>
                        <div class="row">
                                    <div class="col-sm-5">
                                    <label for="gvolco">Gato de levante del volco:</label>
                                    </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">    
                                                <input type="radio" name="switchgvolco"  value="0" required>
                                                <div class="state p-success">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">
                                                <input type="radio" name="switchgvolco"  value="1" required>
                                                <div class="state p-danger">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-5">
                                            <input type="text" class="form-control" name="observation_gvolco" id="observation_gvolco" required>
                                            </div>
                                            

                        </div>
                        <br>
                        <div class="row">
                                    <div class="col-sm-5">
                                    <label for="tanqueCombus">Tanque de combustible(abrasaderas,soporte):</label>
                                   
                                    </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">    
                                                <input type="radio" name="switchtanqueCombus"  value="0" required>
                                                <div class="state p-success">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">
                                                <input type="radio" name="switchtanqueCombus"  value="1" required>
                                                <div class="state p-danger">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-5">
                                            <input type="text" class="form-control" name="observation_tanqueCombus" id="observation_tanqueCombus" required>
                                            </div>
                                            

                        </div>
                        <div class="row">
                                    <div class="col-sm-5">
                                    <label for="motorBomba">Motor de bomba:</label>
                                   
                                    </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">    
                                                <input type="radio" name="switchmotorBomba"  value="0" required>
                                                <div class="state p-success">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">
                                                <input type="radio" name="switchmotorBomba"  value="1" required>
                                                <div class="state p-danger">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-5">
                                            <input type="text" class="form-control" name="observation_motorBomba" id="observation_motorBomba" required>
                                            </div>
                                            

                        </div>  
                        <br>
                        <div class="row">
                                    <div class="col-sm-5">
                                    <label for="llantasStatus">Llantas: cortaduras, abultamientos:</label>
                                   
                                    </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">    
                                                <input type="radio" name="switchllantasStatus"  value="0" required>
                                                <div class="state p-success">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-1">
                                            <div class="pretty p-switch p-fill">
                                                <input type="radio" name="switchllantasStatus"  value="1" required>
                                                <div class="state p-danger">
                                                    <label></label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-5">
                                            <input type="text" class="form-control" name="observation_llantasStatus" id="observation_llantasStatus" required>
                                            </div>
                                            

                        </div>  
                    </div>
                </div>
        </form>
    </div>
</body>


    <script src="../js/trascaboReport.js"></script>
    <?php include "../includes/footer.php";?>