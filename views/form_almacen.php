<?php
error_reporting(0);
session_start();
?>

<?php include "../includes/header.php"; ?>


<body id="page-top">
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <br>
                <h6 class="m-0 font-weight-bold text-center text-primary">Formulario de Salida de Almacen</h6>
                <br>


            </div>

            <div class="card-body">

                <form id="addForm" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label for="transporte" class="form-label">Responsable Area</label>
                                <select class="form-control" name="id_empleado" id="id_empleado">
                                    <option value="0">Selecciona una opción</option>
                                    <?php
                                    include("../includes/db.php");
                                    // Código para mostrar categorías desde otra tabla
                                    $sql = "SELECT * FROM operadores ";
                                    $resultado = mysqli_query($conexion, $sql);
                                    while ($consulta = mysqli_fetch_array($resultado)) {
                                        echo '<option value="' . $consulta['id'] . '">' . $consulta['nombre'] . ' ' . $consulta['apellido'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Recibio</label>
                                <input type="text" class="form-control" id="recibio" name="recibio" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label for="fecha" class="form-label">Area</label><br>
                                <select class="form-control" name="id_area" id="id_area">
                                    <option value="0">Selecciona una opción</option>
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
                                <input type="text" class="form-control" name="descripcion" id="descripcion">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Clave</label>
                                <input type="text" class="form-control" id="clave" name="clave" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Solicitado</label>
                                <input type="text" class="form-control" id="solicitado" name="solicitado" required>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label for="transporte" class="form-label">Pieza</label>
                                <select class="form-control" name="id_pieza" id="id_pieza">
                                    <option value="0">Selecciona una opción</option>
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
                                <input type="text" class="form-control" id="entregado" name="entregado" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Observaciones</label>
                                <input type="text" class="form-control" id="observaciones" name="observaciones" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label for="folio" class="form-label">Folio</label><br>
                                <input type="text" id="folio" name="folio" class="form-control" readonly>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Fecha</label>
                                <input type="date" class="form-control" id="fecha" name="fecha" value="<?php echo date("Y-m-d"); ?>" required>
                            </div>
                        </div>

                    </div>


            </div>


            <input type="hidden" name="accion" value="insert_salida">
            <br>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="register" name="registrar">Guardar</button>
            </div>
            </form>

            <script>
                $(document).ready(function() {
                    $('#id_empleado').change(function() {
                        var id_empleado = $(this).val();

                        // Verificar el último folio registrado por el empleado para el día actual
                        $.ajax({
                            type: 'POST',
                            url: 'verificar_registro.php',
                            data: {
                                id_empleado: id_empleado
                            },
                            dataType: 'json',
                            success: function(response) {
                                if (!response.error) {
                                    // Actualizar el valor del folio con el último folio registrado
                                    var nuevoFolio = response.ultimoFolioRegistrado;
                                    $('#folio').val(nuevoFolio);
                                    console.log("Nuevo folio:", nuevoFolio); // Agregado para depuración
                                } else {
                                    // Manejar el error
                                    console.error(response.error);
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error("Error en la solicitud AJAX: " + error);
                            }
                        });
                    });
                });
            </script>



            <script>
                $(document).ready(function() {
                    $('#addForm').submit(function(e) {
                        e.preventDefault();

                        var formData = new FormData(this);

                        $.ajax({
                            url: '../includes/functions.php',
                            type: 'POST',
                            data: formData,
                            dataType: 'json',
                            processData: false,
                            contentType: false,
                            success: function(response) {
                                if (response.status === 'success') {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Éxito',
                                        text: 'Los datos se guardaron correctamente'
                                    }).then(function() {
                                        location.reload();
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