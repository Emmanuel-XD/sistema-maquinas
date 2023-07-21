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
                <h6 class="m-0 font-weight-bold text-primary">Agregar un reporte</h6>
                <br>


            </div>

            <div class="card-body">

                <form id="inventarioForm">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label for="id_maquina" class="form-label">Maquinaria</label>
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
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Operador</label>
                                <select class="form-control" name="id_operador" id="id_operador">
                                    <option value="0">Selecciona una opción</option>
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
                                <input type="date" step="" id="fecha" name="fecha" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row">
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
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label for="lugar_t" class="form-label">Lugar de trabajo</label><br>
                                <select name="lugar_t" id="lugar_t" class="form-control" required>
                                    <option value="0">Selecciona una opción</option>
                                    <option value="Tijuana">Tijuana</option>
                                    <option value="Guadalajara">Guadalajara</option>
                                    <option value="Veracruz">Veracruz</option>
                                    <option value="Tren Maya">Tren Maya</option>

                                </select>
                            </div>
                        </div>
                
                    </div>

                    <div class="row">
                    <div class="col-sm-4">
                            <div class="mb-3">
                                <label for="horometraje_i" class="form-label">Horometro Inicial</label><br>
                                <input type="number" id="horometraje_i" name="horometraje_i" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label for="horometraje_f" class="form-label">Horometro final</label><br>
                                <input type="number" id="horometraje_f" name="horometraje_f" class="form-control">
                            </div>
                        </div>
                        
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label for="fallo" class="form-label">Tipo de falla</label><br>
                                <select name="fallo" id="fallo" class="form-control" required>
                                    <option value="0">Selecciona una opción</option>
                                    <option value="MECANICA">MECANICA</option>
                                    <option value="OPERADOR">OPERADOR</option>
                                    <option value="DIESEL">DIESEL</option>
                                    <option value="FRACTURA DE BOTE">FRACTURA DE BOTE</option>
                                    <option value="SERVICIOS">SERVICIOS</option>
                                    <option value="ACEITE">ACEITE</option>
                                    <option value="FALTA DE TRAMO SEDENA">FALTA DE TRAMO SEDENA</option>
                                    <option value="MANGUERAS">MANGUERAS</option>
                                    <option value="CLIMA">CLIMA</option>
                                    <option value="VOLADURAS">VOLADURAS</option>
                                    <option value="SIN FALLAS">SIN FALLAS</option>
                                    <option value="OTRO">OTRA</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label for="hora_paro" class="form-label">Hora de paro</label><br>
                                <input type="time" id="hora_paro" name="hora_paro" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label for="hora_reinicio" class="form-label">Hora de reinicio</label><br>
                                <input type="time" id="hora_reinicio" name="hora_reinicio" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label for="gastos_falla" class="form-label">Gastos de falla</label><br>
                            <div class="form-group">
                                <span class="fa fa-usd form-control-icon"></span>
                                <input type="number" step="0.1" id="gastos_falla" name="gastos_falla" class="form-control">
                            </div>
                        </div>

                    </div>

                    <div class="form-group">
                        <label for="nombre" class="form-label">Observaciones</label>
                        <input type="text" id="observacion" name="observacion" class="form-control" required>
                    </div>

                    <input type="hidden" name="accion" value="insertar_inventario">

                    <br>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="register" name="registrar">Guardar</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
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