<div class="modal fade" id="editar<?php echo $fila['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h3 class="modal-title" id="exampleModalLabel">Editar registro de maquina</h3>
                <button type="button" class="btn btn-primary" data-dismiss="modal">
                    <i class="fa fa-times" aria-hidden="true"></i></button>
            </div>
            <div class="modal-body">

                <form id="editInv<?php echo $fila['id']; ?>" method="POST">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Operador</label>
                                <select class="form-control" id="id_operador" name="id_operador" required>
                                <option <?php echo $fila['id_operador'] === 'nombre' ? "selected='selected' " : "" ?> value="<?php echo $fila['id_operador']; ?>"><?php echo $fila['nombre']; ?> </option>
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
                                <label for="password">fecha </label><br>
                                <input type="date" step="" id="fecha" name="fecha" class="form-control" value="<?php echo $fila['fecha']; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="password">horas trabajadas:</label><br>
                                <input type="number" name="horas_t" id="horas_t" class="form-control" value="<?php echo $fila['horas_t']; ?>" required>
                            </div>
                        </div>


                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="password">horas inactiva</label><br>
                                <input type="number" name="horas_in" id="horas_in" class="form-control" value="<?php echo $fila['horas_in']; ?>" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="password">horometro inicial </label><br>
                                <input type="number" step="" id="horometraje_i" name="horometraje_i" class="form-control" value="<?php echo $fila['horometraje_i']; ?>">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="password">horometro terminnal </label><br>
                                <input type="number" step="" id="horometraje_f" name="horometraje_f" class="form-control" value="<?php echo $fila['horometraje_f']; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="password">ubicacion</label><br>
                                <select name="lugar_t" id="lugar_t" class="form-control" required>
                                    <option <?php echo $fila['lugar_t'] === 'tijuana' ? 'selected' : ''; ?> value="tijuana">tijuana</option>
                                    <option <?php echo $fila['lugar_t'] === 'tren maya' ? 'selected' : ''; ?> value="tren maya">tren maya</option>
                                    <option <?php echo $fila['lugar_t'] === 'guadalajara' ? 'selected' : ''; ?> value="guadalajara">guadalajara</option>
                                    <option <?php echo $fila['lugar_t'] === 'veracruz' ? 'selected' : ''; ?> value="veracruz">veracruz</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="password">TIPO DE FALLA</label><br>
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
                                <label for="password">hora de paro </label><br>
                                <input type="text" step="" id="hora_paro" name="hora_paro" class="form-control" value="<?php echo $fila['hora_paro']; ?>">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="password">hora de reinicio </label><br>
                                <input type="text" step="" id="hora_reinicio" name="hora_reinicio" class="form-control" value="<?php echo $fila['hora_reinicio']; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">gastos de falla</label>
                                <input type="text" id="gastos_falla" name="gastos_falla" class="form-control" value="<?php echo $fila['gastos_falla']; ?>">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">observaciones</label>
                                <input type="text" id="observacion" name="observacion" class="form-control" value="<?php echo $fila['observacion']; ?>" required>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="accion" value="editar_inv">
                    <input type="hidden" name="id" value="<?php echo $fila['id']; ?>">

                    <br>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" onclick="editarInv(<?php echo $fila['id']; ?>)">Guardar</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>

<script>
    function editarInv(id) {
        var datosFormulario = $("#editInv" + id).serialize();

        $.ajax({
            url: "../includes/functions.php",
            type: "POST",
            data: datosFormulario,
            dataType: "json",
            success: function(response) {
                if (response === "correcto") {
                    alert("El registro se ha actualizado correctamente");
                    setTimeout(function() {
                        location.assign('inventario.php');
                    }, 2000);
                } else {
                    alert("Ha ocurrido un error al actualizar el registro");
                }
            },
            error: function() {
                alert("Error de comunicacion con el servidor");
            }
        });
    }
</script>