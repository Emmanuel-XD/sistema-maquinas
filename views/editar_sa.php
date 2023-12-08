<?php 
$id = $_GET['id']; 
  global $conexion;
  include "../includes/db.php";
 $result = mysqli_query($conexion, "SELECT sa.id,sa.folio,sa.id_empleado,sa.recibio, sa.id_area, 
 sa.descripcion, sa.clave,sa.solicitado,sa.id_pieza,sa.entregado,sa.observaciones,sa.fecha,
 o.nombre,o.apellido, a.area, p.pieza FROM salida_almacen sa INNER JOIN operadores o 
 ON sa.id_empleado = o.id INNER JOIN areas a ON sa.id_area = a.id INNER JOIN piezas p 
 ON sa.id_pieza = p.id WHERE sa.id = '$id'");
 while ($fila = mysqli_fetch_assoc($result)) :
?>
<div class="modal fade" id="editar<?php echo $fila['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h3 class="modal-title" id="exampleModalLabel">Editar Salida</h3>
                <button type="button" class="btn btn-primary" data-dismiss="modal">
                    <i class="fa fa-times" aria-hidden="true"></i></button>
            </div>
            <div class="modal-body">
                <form id="editSA<?php echo $fila['id']; ?>" method="POST">

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label for="transporte" class="form-label">Responsable Area</label>
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
                                <label for="nombre" class="form-label">Recibio</label>
                                <input type="text" class="form-control" id="recibio" name="recibio" value="<?php echo $fila['recibio']; ?>" required>
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
                                <label for="transporte" class="form-label">Descripcion</label>
                                <input type="text" class="form-control" name="descripcion" id="descripcion" value="<?php echo $fila['descripcion']; ?>">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Clave</label>
                                <input type="text" class="form-control" id="clave" name="clave" value="<?php echo $fila['clave']; ?>" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Solicitado</label>
                                <input type="text" class="form-control" id="solicitado" name="solicitado" value="<?php echo $fila['solicitado']; ?>" required>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label for="transporte" class="form-label">Pieza</label>
                                <select class="form-control" name="id_pieza" id="id_pieza">
                                    <option <?php echo $fila['id_pieza'] === 'id_pieza' ? 'selected' : ''; ?> value="<?php echo $fila['id_pieza']; ?>"><?php echo $fila['pieza']; ?></option>
                                    <?php
                                    include("../includes/db.php");
                                    // Código para mostrar categorías desde otra tabla
                                    $sql = "SELECT * FROM piezas";
                                    $resultado = mysqli_query($conexion, $sql);
                                    while ($consulta = mysqli_fetch_array($resultado)) {
                                        echo '<option value="' . $consulta['id'] . '">' . $consulta['pieza'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Entregado</label>
                                <input type="text" class="form-control" id="entregado" name="entregado" value="<?php echo $fila['entregado']; ?>" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Observaciones</label>
                                <input type="text" class="form-control" id="observaciones" name="observaciones" value="<?php echo $fila['observaciones']; ?>" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label for="folio" class="form-label">Folio</label><br>
                                <input type="text" id="folio" name="folio" class="form-control" value="<?php echo $fila['folio']; ?>" readonly>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Fecha</label>
                                <input type="date" class="form-control" id="fecha" name="fecha" value="<?php echo $fila['fecha']; ?>" readonly>
                            </div>
                        </div>

                    </div>


                    <input type="hidden" name="accion" value="editar_sa">
                    <input type="hidden" name="id" value="<?php echo $fila['id']; ?>">

                    <br>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" onclick="editSA(<?php echo $fila['id']; ?>)">Guardar</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    </div>

            </div>

            </form>
        </div>
    </div>
</div>
<?php endwhile; ?>
<script>
    function editSA(id) {
        var datosFormulario = $("#editSA" + id).serialize();

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