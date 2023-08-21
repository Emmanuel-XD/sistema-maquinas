<div class="modal fade" id="editar<?php echo $fila['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <input type="number" value="" readonly hidden>
            <div class="modal-header bg-primary text-white">
                <h3 class="modal-title" id="exampleModalLabel">Editar registro</h3>
                <button type="button" class="btn btn-primary" data-dismiss="modal">
                    <i class="fa fa-times" aria-hidden="true"></i></button>
            </div>
            <div class="modal-body">
                <form id="editInv<?php echo $fila['id']; ?>" method="POST">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="fecha">Fecha </label><br>
                                <input type="date" step="" id="fecha" name="fecha" class="form-control" value="<?php echo $fila['fecha']; ?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Operador</label>
                                <select class="form-control" id="id_operador" name="id_operador" required>
                                    <option <?php echo $fila['id_operador'] === 'id_operador' ? 'selected' : ''; ?> value="<?php echo $fila['id_operador']; ?>"><?php echo $fila['nombre']; ?></option>
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
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="horas_t">Horas Trabajadas</label><br>
                                <input type="number" name="horas_t" id="horas_t" class="form-control" value="<?php echo $fila['horas_t']; ?>" required>
                            </div>
                        </div>


                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="horas_in">Horas Inactiva</label><br>
                                <input type="number" name="horas_in" id="horas_in" class="form-control" value="<?php echo $fila['horas_in']; ?>" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="horometraje_i">Horometro Inicial </label><br>
                                <input type="number" id="horometraje_i" name="horometraje_i" class="form-control" value="<?php echo $fila['horometraje_i']; ?>">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="horometraje_f">Horometro Terminal </label><br>
                                <input type="number" id="horometraje_f" name="horometraje_f" class="form-control" value="<?php echo $fila['horometraje_f']; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="lugar_t">Ubicacion</label><br>
                                <select name="lugar_t" id="lugar_t" class="form-control" required>
                                    <option value="">Selecciona una opción</option>
                                    <option <?php echo $fila['lugar_t'] === 'banco de material acc2' ? 'selected' : ''; ?> value="banco de material acc2">banco de material acc2</option>
                                    <option <?php echo $fila['lugar_t'] === 'Tren maya' ? 'selected' : ''; ?> value="Tren maya">Tren maya</option>
                                    <option <?php echo $fila['lugar_t'] === 'banco de material tulum' ? 'selected' : ''; ?> value="banco de material tulum">banco de material tulum</option>
                                    <option <?php echo $fila['lugar_t'] === 'tramo' ? 'selected' : ''; ?> value="tramo">tramo</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="hora_paro">hora de falla </label><br>
                                <input type="time" id="hora_paro" name="hora_paro" class="form-control" value="<?php echo $fila['hora_paro']; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="hora_reinicio">hora de reinicio </label><br>
                                <input type="time" id="hora_reinicio" name="hora_reinicio" class="form-control" value="<?php echo $fila['hora_reinicio']; ?>">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="gastos_falla">gastos de falla</label>
                                <input type="number" id="gastos_falla" name="gastos_falla" class="form-control" value="<?php echo $fila['gastos_falla']; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="responsable_falla">Responsable de la falla</label><br>
                                <select name="responsable_falla" id="responsable_falla" class="form-control" required>
                                    <option value="">Selecciona una opción</option>
                                    <option <?php echo $fila['responsable_falla'] === 'Global' ? 'selected' : ''; ?> value="Global">Global</option>
                                    <option <?php echo $fila['responsable_falla'] === 'empresa' ? 'selected' : ''; ?> value="empresa">empresa</option>

                                </select>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="observacion">observaciones</label>
                                <input type="text" id="observacion" name="observacion" class="form-control" value="<?php echo $fila['observacion']; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label for="fallas" class="form-label">Tipo de fallas</label><br>
                                <div class="dropdown cq-dropdown" data-name='fallas<?php echo $fila['id']; ?>'>
                                        <button class="btn  col-sm-11 fixbtn dropdown-toggle" type="button"  id="btndropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                Tipo de falla
                                                <span class="caret"></span>
                                        </button>
                                         <ul class="dropdown-menu" aria-labelledby="btndropdown">
                                <?php
                                $tipoFalla = explode(',', $fila['fallo']); // Convertir la cadena de fallas en un arreglo
                                $tiposFalla = array(
                                    'mecanica', 'operador', 'diesel', 'fractura de bote', 'servicios', 'aceite', 'falta de tramo sedena',
                                    'mangueras', 'clima', 'voladuras', 'cabezal', 'pago', 'falta valvula', 'falta valvula-pago', 'cabezal-pago', 'otro',
                                );

                                $itemsPerRow = 6;
                                $itemsPerColumn = 4;
                                $totalItems = count($tiposFalla);
                               
                                    
                                            
                                for ($row = 0; $row < $itemsPerColumn; $row++) {
                                    for ($col = 0; $col < $itemsPerRow; $col++) {
                                        $index = $row * $itemsPerRow + $col;
                                        if ($index < $totalItems) {
                                            $tipo = $tiposFalla[$index];
                                            $checked = in_array($tipo, $tipoFalla) ? 'checked' : '';
                                            echo '<li>';
                                            echo '<label class="radio-btn">';
                                            echo '<input type="checkbox" value="'.$tipo.'" '. $checked .'>';
                                            echo " $tipo ";
                                            echo '</label>';
                                            echo '</li>';
                                        } 
                                    }
                                }
                                ?>
                                 </ul>    
                            <div class="tool-tip">
                                <i class="tool-tip__icon">i</i>
                                <p class="tool-tip__info">
                                <span class="info"><span class="info__title">Si no presenta falla:</span>dejar vacio</span>
                                </p>
                            </div>
                            </div>
                   
                        </div>
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
        var fallas = $(`input[name=fallas${id}]`).val()
        var datosFormulario = $("#editInv" + id).serialize();
        datosFormulario = datosFormulario + '&' + $.param({ 'fallas': fallas });
        $.ajax({
            url: "../includes/functions.php",
            type: "POST",
            data: datosFormulario,
            dataType: "json",
            success: function(response) {
                if (response === "correcto") {
                    alert("El registro se ha actualizado correctamente");
                    setTimeout(function() {
                        location.assign('registros.php');
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

<script>
    $('.btn-del').on('click', function(e) {
        e.preventDefault();
        const href = $(this).attr('href')

        Swal.fire({
            title: 'Estas seguro de eliminar este registro?',
            text: "¡No podrás revertir esto!!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, eliminar!',
            cancelButtonText: 'Cancelar!',
        }).then((result) => {
            if (result.value) {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Eliminado!',
                        'El registro fue eliminado.',
                        'success'
                    )
                }

                document.location.href = href;
            }
        })

    })
</script>