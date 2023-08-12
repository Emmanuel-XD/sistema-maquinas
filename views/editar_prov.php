<div class="modal fade" id="editar<?php echo $fila['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h3 class="modal-title" id="exampleModalLabel">Editar Maquina</h3>
                <button type="button" class="btn btn-primary" data-dismiss="modal">
                    <i class="fa fa-times" aria-hidden="true"></i></button>
            </div>
            <div class="modal-body">

                <form id="editProv<?php echo $fila['id']; ?>" method="POST">

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Numero de Maquina</label>
                                <input type="text" id="name" name="name" class="form-control" value="<?php echo $fila['name']; ?>" required>

                            </div>
                        </div>


                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Modelo</label>
                                <input type="text" id="modelo" name="modelo" class="form-control" value="<?php echo $fila['modelo']; ?>" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="password" class="form-label">Serie</label><br>
                                <input type="text" name="serie" id="serie" class="form-control" value="<?php echo $fila['serie']; ?>" required>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Ubicacion</label>
                                <select name="ubicacion" id="ubicacion" class="form-control" required>
                                    <option <?php echo $fila['ubicacion'] === 'banco de material acc2' ? 'selected' : ''; ?> value="banco de material acc2">banco de material acc2</option>
                                    <option <?php echo $fila['ubicacion'] === 'Tren maya' ? 'selected' : ''; ?> value="Tren maya">Tren maya</option>
                                    <option <?php echo $fila['ubicacion'] === 'banco de material tulum' ? 'selected' : ''; ?> value="banco de material tulum">banco de material tulum</option>
                                    <option <?php echo $fila['ubicacion'] === 'tramo' ? 'selected' : ''; ?> value="tramo">tramo</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="status" class="form-label">Estatus</label>
                        <select name="status" id="status" class="form-control" required>
                            <option <?php echo $fila['status'] === 'Activo' ? 'selected' : ''; ?> value="Activo">Activo</option>
                            <option <?php echo $fila['status'] === 'Inactivo' ? 'selected' : ''; ?> value="Inactivo">Inactivo</option>
                        </select>
                    </div>

                    <input type="hidden" name="accion" value="editar_prov">
                    <input type="hidden" name="id" value="<?php echo $fila['id']; ?>">


                    <br>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" onclick="editarProv(<?php echo $fila['id']; ?>)">Guardar</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    </div>

            </div>

            </form>
        </div>
    </div>
</div>

<script>
    function editarProv(id) {
        var datosFormulario = $("#editProv" + id).serialize();

        $.ajax({
            url: "../includes/functions.php",
            type: "POST",
            data: datosFormulario,
            dataType: "json",
            
            success: function(response) {
                if (response === "correcto") {
                    alert("El registro se ha actualizado correctamente");
                    setTimeout(function() {
                        location.assign('maquinas.php');
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