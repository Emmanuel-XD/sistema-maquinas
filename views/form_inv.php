<div class="modal fade" id="inv" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h3 class="modal-title" id="exampleModalLabel">Registro nuevo</h3>
                <button type="button" class="btn btn-primary" data-dismiss="modal">
                    <i class="fa fa-times" aria-hidden="true"></i></button>
            </div>
            <div class="modal-body">
                <form id="inventarioForm">


                    <div class="form-group">
                        <label for="password">Maquinaria</label><br>
                        <select class="form-control" name="id_maquina" id="id_maquina">
                            <option value="0">Selecciona una opción</option>
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

                    </div> <!--se termina la columna 1-->

                    <div class="row"> <!--*primer columna donde se posicionan 2 imput-->
                        <div class="col-sm-6"> <!--input1 operador = codigo-->
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Operador</label>
                                <input type="text" id="operador" name="operador" class="form-control" required>

                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="password">Fecha </label><br>
                                <input type="date" step="" id="fecha" name="fecha" class="form-control">
                            </div>
                        </div>

                    </div> <!--se termina la columna 1-->

                    <div class="row"><!--*segunda columna donde se posicionan 3 imput-->

                        <div class="col-sm-6"><!--input2 hsr trabajadas = observaciones-->
                            <div class="mb-3">
                                <label for="password">Horas Trabajadas</label><br>
                                <input type="number" step=".01" name="horas_t" id="horas_t" class="form-control" required>
                            </div>
                        </div>


                        <div class="col-sm-6"><!--input1 operador = codigo-->
                            <div class="mb-3">
                                <label for="password">Horas Inactivas</label><br>
                                <input type="number" step=".01" name="horas_in" id="horas_in" class="form-control" required>
                            </div>
                        </div><!--input1 operador = codigo-->
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="password"> Horometroja Inicial</label><br>
                                <input type="number" step=".01" id="horometraje_i" name="horometraje_i" class="form-control">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="password">Horometraje Terminal </label><br>
                                <input type="number" step=".01" id="horometraje_f" name="horometraje_f" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="password">Lugar de trabajo</label><br>
                                <select name="lugar_t" id="lugar_t" class="form-control" required>
                                    <option value="0">Selecciona una opción</option>
                                    <option value="banco de material acc2">banco de material acc2</option>
                                    <option value="Tren maya">Tren maya</option>
                                    <option value="banco de material tulum">banco de material tulum</option>
                                    <option value="tramo">tramo</option>



                                </select>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="password">Tipo de falla</label><br>
                                <select name="fallo" id="fallo" class="form-control"  multiple required>
                                    <option value="0">Selecciona una opción</option>
                                    <option value="mecanica">mecanica</option>
                                    <option value="operador">operador</option>
                                    <option value="diesel">diesel</option>
                                    <option value="fractura de bote">fractura de bote</option>
                                    <option value="servicios">servicios</option>
                                    <option value="aceite">aceite</option>
                                    <option value="falta de tramo sedena">falta de tramo sedena</option>
                                    <option value="mangueras">mangueras</option>
                                    <option value="clima">clima</option>
                                    <option value="voladuras">voladuras</option>
                                    <option value="cabezal">cabezal</option>
                                    <option value="pago">pago</option>
                                    <option value="falta valvula">falta valvula</option>
                                    <option value="falta valvula, pago">falta valvula, pago</option>
                                    <option value="cabezal,pago">cabezal,pago</option>
                                    <option value="sin fallas">sin fallas</option>
                                    <option value="otro">otro</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="password">Hora de paro</label><br>
                                <input type="varchar" step="" id="hora_paro" name="hora_paro" class="form-control">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="password">Hora de reinicio </label><br>
                                <input type="varchar" step="" id="hora_reinicio" name="hora_reinicio" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="password">Gastos de falla</label><br>
                                <input type="text" step="" id="gastos_falla" name="gastos_falla" class="form-control">
                            </div>
                        </div>

                        <div class="col-sm-6"><!--input1 operador = codigo-->
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Observaciones</label>
                                <input type="text" id="observacion" name="observacion" class="form-control" required>
                            </div>
                        </div>
                    </div>


                    <input type="hidden" name="accion" value="insertar_inventario">

                    <br>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="register" name="registrar">Guardar</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    </div>

            </div>

            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#inventarioForm').submit(function(e) {
            e.preventDefault(); // Evita que el formulario se envíe de forma predeterminada
            var formData = $(this).serialize(); // Serializa los datos del formulario
            $.ajax({
                url: '../includes/functions.php',
                type: 'POST',
                data: formData,
                dataType: 'json', // Espera una respuesta en formato JSON
                success: function(response) {
                    if (response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Éxito',
                            text: 'Los datos se guardaron correctamente'
                        }).then(function() {
                            window.location = "inventario.php"; // Redirecciona al usuario a la página deseada
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Ocurrió un error inesperado'
                        });
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Ocurrió un error inesperado'
                    });
                }
            });
        });
    });
</script>