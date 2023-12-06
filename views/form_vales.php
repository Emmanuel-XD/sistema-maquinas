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
                <h6 class="m-0 font-weight-bold text-center text-primary">Formulario de Vales de Resguardo</h6>
                <br>


            </div>

            <div class="card-body">

                <form id="addForm" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label for="transporte" class="form-label">Nombre</label>
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
                                <label for="nombre" class="form-label">Puesto</label>
                                <input type="text" class="form-control" id="puesto" name="puesto" required>
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
                                <label for="transporte" class="form-label">Cantidad</label>
                                <input type="text" class="form-control" name="cantidad" id="cantidad" required>
                            </div>
                        </div>
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

                    <div class="form-group">
                        <label for="nombre" class="form-label">Descripcion</label>
                        <input type="text" class="form-control" id="descripcion" name="descripcion" required>
                    </div>


            </div>


            <input type="hidden" name="accion" value="insert_vale">
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
                            url: 'verificar_vale.php',
                            data: {
                                id_empleado: id_empleado
                            },
                            dataType: 'json',
                            success: function(response) {
                                if (!response.error) {
                                    var nuevoFolio = response.ultimoFolioRegistrado;
                                    $('#folio').val(nuevoFolio);
                                    console.log("Nuevo folio:", nuevoFolio); 
                                } else {
                                    console.error(response.error);
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error("Error en la solicitud: " + error);
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