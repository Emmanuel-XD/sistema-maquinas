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
            <div class="row">
                <div class="col-sm-6">
                    <label for="fallas" class="form-label">Tipo de fallas</label><br>
                    <div class='myform'>
                    <div class="dropdown cq-dropdown" data-name='fallas'>
                        <button class="btn fixbtn col-sm-11 dropdown-toggle" type="button"  id="btndropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                Tipo de falla
                                <span class="caret"></span>
                        </button>
                            <ul class="dropdown-menu" aria-labelledby="btndropdown">
                                <li>
                                    <label class="radio-btn">
                                        <input type="checkbox" value='mecanica' >
                                        mecanica
                                    </label>
                                </li>
                                <li>
                                <label class="radio-btn">   
                                        <input type="checkbox" value='operador'>
                                        operador </label>
                                    
                                </li>
                                <li>
                                    <label class="radio-btn">
                                        <input type="checkbox" value='diesel'>
                                        diesel
                                    </label>
                                </li>
                                <li>
                                    <label class="radio-btn">
                                        <input type="checkbox" value='bote' >
                                        fractura de bote
                                    </label>
                                </li>
                                <li>
                                    <label class="radio-btn">
                                        <input type="checkbox" value='servicios' >
                                        servicios
                                    </label>
                                </li>
                                <li>
                                    <label class="radio-btn">
                                        <input type="checkbox" value='aceite' >
                                        aceite
                                    </label>
                                </li>
                                <li>
                                    <label class="radio-btn">
                                        <input type="checkbox" value='tramo' >
                                        Falta de tramo sedena
                                    </label>
                                </li>
                                <li>
                                    <label class="radio-btn">
                                        <input type="checkbox" value='mangueras' >
                                        Mangueras
                                    </label>
                                </li>
                                <li>
                                    <label class="radio-btn">
                                        <input type="checkbox" value='clima' >
                                        Clima
                                    </label>
                                </li>
                                <li>
                                    <label class="radio-btn">
                                        <input type="checkbox" value='voladuras' >
                                        Voladuras
                                    </label>
                                </li>
                                <li>
                                    <label class="radio-btn">
                                        <input type="checkbox" value='cabezal' >
                                        Cabezal
                                    </label>
                                </li>
                                <li>
                                    <label class="radio-btn">
                                        <input type="checkbox" value='pago' >
                                        Pago
                                    </label>
                                </li>
                                <li>
                                    <label class="radio-btn">
                                        <input type="checkbox" value='valvula' >
                                        Falta valvula
                                    </label>
                                </li>
                                <li>
                                    <label class="radio-btn">
                                        <input type="checkbox" value='otro' >
                                        Otro
                                    </label>
                                </li>
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
                       

                        <div class="col-sm-6">
                        <label for="nombre" class=" form-label">Observaciones</label>
                        <input type="text" id="observacion" name="observacion" class="form-control" required>
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
    $(function(){
      $('.cq-dropdown').dropdownCheckboxes();   
    });
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