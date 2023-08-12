<?php
error_reporting(0);
session_start();
?>

<?php include "../includes/header.php"; ?>
<script src="https://unpkg.com/xlsx/dist/xlsx.full.min.js"></script>

<body id="page-top">
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Agregar un Reporte</h6>
                <br>


            </div>

            <div class="card-body">

                <form id="inventarioForm">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label for="id_maquina" class="form-label">Maquinaria</label>
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
                        </div>
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Operador</label>
                                <select class="form-control" name="id_operador" id="id_operador" required>
                                    <option value="">Selecciona una opción</option>
                                    <?php
                                    include("../includes/db.php");
                                    // Código para mostrar categorías desde otra tabla
                                    $sql = "SELECT * FROM operadores ";
                                    $resultado = mysqli_query($conexion, $sql);
                                    while ($consulta = mysqli_fetch_array($resultado)) {
                                        echo '<option value="' . $consulta['id'] . '">' . $consulta['nombre'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label for="fecha" class="form-label">Fecha</label><br>
                                <input type="date" step="" id="fecha" name="fecha" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label for="lugar_t" class="form-label">Lugar de trabajo</label><br>
                                <select name="lugar_t" id="lugar_t" class="form-control">
                                    <option value="">Selecciona una opción</option>
                                    <option value="banco de material acc2">banco de material acc2</option>
                                    <option value="Tren maya">Tren maya</option>
                                    <option value="banco de material tulum">banco de material tulum</option>
                                    <option value="tramo">tramo</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label for="horas_t" class="form-label">Horas Trabajadas</label><br>
                                <input type="number" name="horas_t" id="horas_t" class="form-control" required>
                            </div>

                        </div>
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label for="horas_in" class="form-label">Horas Inactivas</label><br>
                                <input type="number" name="horas_in" id="horas_in" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label for="horometraje_i" class="form-label">Horometro Inicial</label><br>
                                <input type="number" id="horometraje_i" name="horometraje_i" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label for="horometraje_f" class="form-label">Horometro final</label><br>
                                <input type="number" id="horometraje_f" name="horometraje_f" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label for="responsable_falla" class="form-label">Responsable de la falla</label><br>
                                <select name="responsable_falla" id="responsable_falla" class="form-control">
                                    <option value="">Selecciona una opción</option>
                                    <option value="Global">Global </option>
                                    <option value="empresa">empresa</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-sm-4">
                            <div class="mb-3"> <!--Hora de inicio de falla-->
                                <label for="hora_paro" class="form-label">Hora de falla</label><br>
                                <input type="time" id="hora_paro" name="hora_paro" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label for="hora_reinicio" class="form-label">Hora de reinicio de operaciones</label><br>
                                <input type="time" id="hora_reinicio" name="hora_reinicio" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label for="gastos_falla" class="form-label">Gastos de falla</label><br>
                            <div class="form-group">
                                <span style="color: black;" class="fa fa-usd form-control-icon"></span>
                                <input type="number" step="0.1" id="gastos_falla" name="gastos_falla" class="form-control">
                            </div>
                        </div>
                    </div>



                    <div class="form-group">
                        <label for="nombre" class="form-label">Observaciones</label>
                        <input type="text" id="observacion" name="observacion" class="form-control" required>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label class="form-label">Tipo de falla</label><br>

                                <div class="form-check">
                                    <input type="checkbox" id="fallo-mecanica" name="fallas[]" value="mecanica" class="form-check-input">
                                    <label for="fallo-mecanica" class="form-check-label">mecanica</label>
                                </div>

                                <div class="form-check">
                                    <input type="checkbox" id="fallo-operador" name="fallas[]" value="operador" class="form-check-input">
                                    <label for="fallo-operador" class="form-check-label">operador</label>
                                </div>


                                <div class="form-check">
                                    <input type="checkbox" id="fallo-diesel" name="fallas[]" value="diesel" class="form-check-input">
                                    <label for="fallo-operador" class="form-check-label">diesel</label>
                                </div>

                                <div class="form-check">
                                    <input type="checkbox" id="fallo-fractura de bote" name="fallas[]" value="fractura de bote" class="form-check-input">
                                    <label for="fallo-operador" class="form-check-label">fractura de bote</label>
                                </div>

                                <div class="form-check">
                                    <input type="checkbox" id="fallo-servicios" name="fallas[]" value="servicios" class="form-check-input">
                                    <label for="fallo-operador" class="form-check-label">servicios</label>
                                </div>

                                <div class="form-check">
                                    <input type="checkbox" id="fallo-aceite" name="fallas[]" value="aceite" class="form-check-input">
                                    <label for="fallo-operador" class="form-check-label">aceite</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <div class="form-check">
                                    <input type="checkbox" id="falta de tramo sedena" name="fallas[]" value="falta de tramo sedena" class="form-check-input">
                                    <label for="fallo-operador" class="form-check-label">falta de tramo sedena</label>
                                </div>

                                <div class="form-check">
                                    <input type="checkbox" id="mangueras" name="fallas[]" value="mangueras" class="form-check-input">
                                    <label for="fallo-operador" class="form-check-label">mangueras</label>
                                </div>

                                <div class="form-check">
                                    <input type="checkbox" id="clima" name="fallas[]" value="clima" class="form-check-input">
                                    <label for="fallo-operador" class="form-check-label">clima</label>
                                </div>

                                <div class="form-check">
                                    <input type="checkbox" id="voladuras" name="fallas[]" value="voladuras" class="form-check-input">
                                    <label for="fallo-operador" class="form-check-label">voladuras</label>
                                </div>

                                <div class="form-check">
                                    <input type="checkbox" id="cabezal" name="fallas[]" value="cabezal" class="form-check-input">
                                    <label for="fallo-operador" class="form-check-label">cabezal</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" id="pago" name="fallas[]" value="pago" class="form-check-input">
                                    <label for="fallo-operador" class="form-check-label">pago</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <div class="form-check">
                                    <input type="checkbox" id="falta valvula" name="fallas[]" value="falta valvula" class="form-check-input">
                                    <label for="fallo-operador" class="form-check-label">falta valvula</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" id="falta valvula, pago" name="fallas[]" value="falta valvula-pago" class="form-check-input">
                                    <label for="fallo-operador" class="form-check-label">falta valvula, pago</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" id="cabezal-pago" name="fallas[]" value="cabezal-pago" class="form-check-input">
                                    <label for="fallo-operador" class="form-check-label">cabezal,pago</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" id="sin falla" name="fallas[]" value="sin falla" class="form-check-input">
                                    <label for="fallo-operador" class="form-check-label">sin falla</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" id="otro" name="fallas[]" value="otro" class="form-check-input">
                                    <label for="fallo-otro" class="form-check-label">otro</label>
                                </div>

                            </div>
                        </div>
                    </div>



                    <input type="hidden" name="accion" value="insertar_inventario">

                    <br>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="register" name="registrar">Guardar</button>
                        <!-- <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>-->
                    </div>
                </form>

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
                                            window.location = "add_report.php"; // Redirecciona al usuario a la página deseada
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

                <?php include "../includes/footer.php"; ?>
</body>

</html>