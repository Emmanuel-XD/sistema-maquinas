<div class="modal fade" id="editar<?php echo $fila['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h3 class="modal-title" id="exampleModalLabel">Editar Vale</h3>
                <button type="button" class="btn btn-primary" data-dismiss="modal">
                    <i class="fa fa-times" aria-hidden="true"></i></button>
            </div>
            <div class="modal-body">
                <form id="editVal<?php echo $fila['id']; ?>" method="POST">


                    <div class="row">
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label for="transporte" class="form-label">Nombre</label>
                                <select class="form-control" name="id_empleado" id="id_empleado">
                                    <option <?php echo $fila['id_empleado'] === 'id_empleado' ? 'selected' : ''; ?> value="<?php echo $fila['id_empleado']; ?>"><?php echo $fila['nombre'] . ' ' . $fila['apellido']; ?></option>
                                    <?php
                                    /* include("../includes/db.php");
                                    // Código para mostrar categorías desde otra tabla
                                    $sql = "SELECT * FROM operadores ";
                                    $resultado = mysqli_query($conexion, $sql);
                                    while ($consulta = mysqli_fetch_array($resultado)) {
                                        echo '<option value="' . $consulta['id'] . '">' . $consulta['nombre'] . ' ' . $consulta['apellido'] . '</option>';
                                    }*/
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Puesto</label>
                                <input type="text" class="form-control" id="puesto" name="puesto" value="<?php echo $fila['puesto']; ?>" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label for="fecha" class="form-label">Area</label><br>
                                <select class="form-control" name="id_area" id="id_area">
                                    <option <?php echo $fila['id_area'] === 'id_area' ? 'selected' : ''; ?> value="<?php echo $fila['id_area']; ?>"><?php echo $fila['area']; ?></option>
                                    <?php
                                    include("../includes/db.php");
                                    // Código para mostrar categorías desde otra tabla
                                    $sql = "SELECT * FROM areas ";
                                    $resultado = mysqli_query($conexion, $sql);
                                    while ($consulta = mysqli_fetch_array($resultado)) {
                                        echo '<option value="' . $consulta['id'] . '">' . $consulta['area'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label for="transporte" class="form-label">Cantidad</label>
                                <input type="text" class="form-control" name="cantidad" id="cantidad" value="<?php echo $fila['cantidad']; ?>" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label for="folio" class="form-label">Folio</label><br>
                                <input type="text" id="folio" name="folio" class="form-control" value="<?php echo $fila['folio']; ?>" readonly>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Fecha</label>
                                <input type="date" class="form-control" id="fecha" name="fecha" value="<?php echo $fila['fecha']; ?>" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="nombre" class="form-label">Descripcion</label>
                        <input type="text" class="form-control" id="descripcion" name="descripcion" value="<?php echo $fila['descripcion']; ?>" required>
                    </div>





                    <input type="hidden" name="accion" value="editar_val">
                    <input type="hidden" name="id" value="<?php echo $fila['id']; ?>">

                    <br>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" onclick="editVal(<?php echo $fila['id']; ?>)">Guardar</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    </div>

            </div>

            </form>
        </div>
    </div>
</div>
<script>
    function editVal(id) {
        var datosFormulario = $("#editVal" + id).serialize();

        $.ajax({
            url: "../includes/functions.php",
            type: "POST",
            data: datosFormulario,
            dataType: "json",
            success: function(response) {
                if (response === "correcto") {
                    alert("El registro se ha actualizado correctamente");
                    setTimeout(function() {
                        location.reload();
                    }, 10);
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