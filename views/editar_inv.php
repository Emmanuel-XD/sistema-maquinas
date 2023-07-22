<div class="modal fade" id="editar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <input type="number" value="" readonly hidden>
            <div class="modal-header bg-primary text-white">
                <h3 class="modal-title" id="exampleModalLabel">Editar registro de maquina</h3>
                <button type="button" class="btn btn-primary" data-dismiss="modal">
                    <i class="fa fa-times" aria-hidden="true"></i></button>
            </div>
            <div class="modal-body">

                <form id="editInv" data-id="<?php echo $fila['id']; ?>" method="POST">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Operador</label>
                                <select class="form-control" id="id_operador" name="id_operador" required>
                                    <?php

                                    include("../includes/db.php");
                                    //Codigo para mostrar categorias desde otra tabla
                                    $sql = "SELECT * FROM operadores ";
                                    $resultado = mysqli_query($conexion, $sql);
                                    while ($consulta = mysqli_fetch_array($resultado)) {
                                        echo '<option value="' . $consulta['id'] . '">' . $consulta['nombre'] . '</option>';
                                    }

                                    ?>
                                </select>

                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="fecha">Fecha </label><br>
                                <input type="date" step="" id="fecha" name="fecha" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="horas_t">Horas Trabajadas</label><br>
                                <input type="number" name="horas_t" id="horas_to" class="form-control" required>
                            </div>
                        </div>


                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="horas_in">Horas Inactiva</label><br>
                                <input type="number" name="horas_in" id="horas_ina" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="horometraje_i">Horometro Inicial </label><br>
                                <input type="number" id="horometrajes_i" name="horometrajes_i" class="form-control">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="horometraje_f">Horometro Terminal </label><br>
                                <input type="number" id="horometrajes_f" name="horometrajes_f" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="lugar_t">Ubicacion</label><br>
                                <select name="lugar_t" id="lugar_t" class="form-control" required>
                                    <option <?php echo $fila['lugar_t'] === 'Tijuana' ? 'selected' : ''; ?> value="Tijuana">Tijuana</option>
                                    <option <?php echo $fila['lugar_t'] === 'Tren maya' ? 'selected' : ''; ?> value="Tren maya">Tren maya</option>
                                    <option <?php echo $fila['lugar_t'] === 'Guadalajara' ? 'selected' : ''; ?> value="Guadalajara">Guadalajara</option>
                                    <option <?php echo $fila['lugar_t'] === 'Veracruz' ? 'selected' : ''; ?> value="Veracruz">Veracruz</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="fallo">TIPO DE FALLA</label><br>
                                <select name="fallo" id="fallo" class="form-control" required>
                                    <option <?php echo $fila['fallo'] === 'MECANICA' ? 'selected' : ''; ?> value="MECANICA">MECANICA</option>
                                    <option <?php echo $fila['fallo'] === 'OPERADOR' ? 'selected' : ''; ?> value="OPERADOR">OPERADOR</option>
                                    <option <?php echo $fila['fallo'] === 'DIESEL' ? 'selected' : ''; ?> value="DIESEL">DIESEL</option>
                                    <option <?php echo $fila['fallo'] === 'FRACTURA DE BOTE' ? 'selected' : ''; ?> value="FRACTURA DE BOTE">FRACTURA DE BOTE</option>
                                    <option <?php echo $fila['fallo'] === 'SERVICIOS' ? 'selected' : ''; ?> value="SERVICIOS">SERVICIOS</option>
                                    <option <?php echo $fila['fallo'] === 'ACEITE' ? 'selected' : ''; ?> value="ACEITE">ACEITE</option>
                                    <option <?php echo $fila['fallo'] === 'FALTA DE TRAMO SEDENA' ? 'selected' : ''; ?> value="FALTA DE TRAMO SEDENA">FALTA DE TRAMO SEDENA</option>
                                    <option <?php echo $fila['fallo'] === 'MANGUERAS' ? 'selected' : ''; ?> value="MANGUERAS">MANGUERAS</option>
                                    <option <?php echo $fila['fallo'] === 'CLIMA' ? 'selected' : ''; ?> value="CLIMA">CLIMA</option>
                                    <option <?php echo $fila['fallo'] === 'VOLADURAS' ? 'selected' : ''; ?> value="VOLADURAS">VOLADURAS</option>
                                    <option <?php echo $fila['fallo'] === 'SIN FALLAS' ? 'selected' : ''; ?> value="SIN FALLAS">SIN FALLAS</option>
                                    <option <?php echo $fila['fallo'] === 'OTRO' ? 'selected' : ''; ?> value="OTRO">OTRO</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="hora_paro">hora de paro </label><br>
                                <input type="time" id="hora_paro" name="hora_paro" class="form-control" value="<?php echo $fila['hora_paro']; ?>">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="hora_reinicio">hora de reinicio </label><br>
                                <input type="time" id="hora_reinicio" name="hora_reinicio" class="form-control" value="<?php echo $fila['hora_reinicio']; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="gastos_falla" class="form-label">gastos de falla</label>
                                <input type="number" id="gastos_falla" name="gastos_falla" class="form-control" value="<?php echo $fila['gastos_falla']; ?>">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="observacion" class="form-label">observaciones</label>
                                <input type="text" id="observacion" name="observacion" class="form-control" value="<?php echo $fila['observacion']; ?>" required>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="idrow" id="idrow">

                    <br>

                    <div class="modal-footer">
                        <button type="button" id="save" class="btn btn-primary" onclick='editarInv( )'>Guardar</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>
<script>
    function editarInv() {
        var id = $("#idrow").val();

        var datosFormulario = $("#editInv" + id).serialize();
        console.log(datosFormulario);

        var datos = new FormData();
        datos.append("accion", "editar_inv");
        datos.append("id", id);
        datos.append("id_maquina", $("#id_maquina").val());
        datos.append("id_operador", $("#id_operador").val());
        datos.append("observacion", $("#observacion").val());
        datos.append("horas_t", $("#horas_to").val()); // Corregido para usar $("#horas_to")
        datos.append("horas_in", $("#horas_ina").val()); // Corregido para usar $("#horas_ina")
        datos.append("horometraje_i", $("#horometraje_i").val());
        datos.append("horometraje_f", $("#horometraje_f").val());
        datos.append("lugar_t", $("#lugar_t").val());
        datos.append("fallo", $("#fallo").val());
        datos.append("fecha", $("#fecha").val());
        datos.append("hora_paro", $("#hora_paro").val());
        datos.append("hora_reinicio", $("#hora_reinicio").val());
        datos.append("gastos_falla", $("#gastos_falla").val());
        fetch("../includes/functions.php", {
                method: 'POST',
                body: datos
            }).then(response => response.json())
            .then(response => {
                if (response === "correcto") {
                    alert("El registro se ha actualizado correctamente");
                    setTimeout(function() {
                        location.assign('inventario.php');
                    }, 2000);
                } else {
                    alert("Ha ocurrido un error al actualizar el registro");
                }
            });
    }


    // $.ajax({
    //     url: "../includes/functions.php",
    //     type: "POST",
    //     data: datosFormulario,
    //     dataType: "json",
    //     success: function(response) {
    //         if (response === "correcto") {
    //             alert("El registro se ha actualizado correctamente");
    //             setTimeout(function() {
    //                 location.assign('inventario.php');
    //             }, 2000);
    //         } else {
    //             alert("Ha ocurrido un error al actualizar el registro");
    //         }
    //     },
    //     error: function() {
    //         alert("Error de comunicacion con el servidor");
    //     }
    // });
</script>