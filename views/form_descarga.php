<?php
error_reporting(0);
session_start();
?>

<?php include "../includes/header.php"; ?>


<body id="page-top">
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Agregar datos de Acarreo</h6>
                <br>


            </div>

            <div class="card-body">

                <form id="addForm" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label for="transporte" class="form-label">Tipo de Transporte</label>
                                <select class="form-control" name="transporte" id="transporte" required>
                                    <option value="">Selecciona una opción</option>
                                    <option value="14">14</option>
                                    <option value="13">13</option>
                                    <option value="12">12</option>
                                    <option value="Gonda">Gonda</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Numero de Placa</label>
                                <input type="text" class="form-control" id="placa" name="placa" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label for="fecha" class="form-label">Cantidad m3</label><br>
                                <input type="number" step="" id="cant" name="cant" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label for="material" class="form-label">Tipo de Material</label><br>
                                <div class='myform'>
                                    <div class="dropdown cq-dropdown" data-name='material'>
                                        <button class="btn fixbtn col-sm-12 dropdown-toggle" type="button" id="btndropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            Seleccione una opcion
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="btndropdown">
                                            <li>
                                                <label class="checkbox">
                                                    <input type="checkbox" value='Material 1'> Material 1
                                                </label>
                                            </li>
                                            <li>
                                                <label class="checkbox">
                                                    <input type="checkbox" value='Material 2'> Material 2
                                                </label>
                                            </li>
                                            <li>
                                                <label class="checkbox">
                                                    <input type="checkbox" value='Material 3'> Material 3
                                                </label>
                                            </li>
                                            <li>
                                                <label class="checkbox">
                                                    <input type="checkbox" value='Material 4'> Material 4
                                                </label>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>




                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label for="image1" class="form-label">Imagen 1</label><br>
                                <input type="file" name="image1" id="image1" class="form-control" required>
                            </div>

                        </div>
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label for="image2" class="form-label">Imagen 2</label><br>
                                <input type="file" name="image2" id="image2" class="form-control" required>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label for="folio" class="form-label">Folio</label><br>
                                <?php
                                include "../includes/db.php";

                                // Consulta para verificar si el folio ya existe
                                $consulta = "SELECT folio FROM acarreos WHERE folio = '$folio'";
                                $resultado = mysqli_query($conexion, $consulta);

                                if ($resultado) {
                                    if (mysqli_num_rows($resultado) > 0) {
                                        // Si el folio ya existe, obtén la parte aleatoria del folio
                                        $parteAleatoria = substr($folio, 0, 6);
                                        $consult = "SELECT MAX(CONVERT(SUBSTRING_INDEX(folio, '-', -1), SIGNED)) AS ultimo_consecutivo FROM acarreos WHERE folio LIKE '$parteAleatoria%'";
                                    } else {
                                        // Si el folio no existe, genera una parte aleatoria aleatoria
                                        $parteAleatoria = "A" . mt_rand(1000, 9999);
                                        $consult = "SELECT MAX(CONVERT(SUBSTRING_INDEX(folio, '-', -1), SIGNED)) AS ultimo_consecutivo FROM acarreos";
                                    }
                                } else {

                                    echo "Error en la consulta: " . mysqli_error($conexion);
                                }

                                $result = mysqli_query($conexion, $consult);

                                if ($result) {
                                    $row = mysqli_fetch_assoc($result);

                                    if ($row && !is_null($row['ultimo_consecutivo'])) {
                                        $ultimoConsecutivo = $row['ultimo_consecutivo'] + 1;
                                    } else {
                                        // Si no hay registros en la tabla, comienza desde 1
                                        $ultimoConsecutivo = 1;
                                    }
                                } else {
                                    echo "Error en la consulta: " . mysqli_error($conexion);
                                }

                                // Construir el nuevo folio
                                $folio = $parteAleatoria . '-' . sprintf("%02d", $ultimoConsecutivo);

                                echo '<input type="text" id="folio" name="folio" value="' . $folio . '" class="form-control">';
                                mysqli_close($conexion);
                                ?>
                            </div>
                        </div>
                    </div>


            </div>


            <input type="hidden" name="accion" value="insert_carga">
            <br>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="register" name="registrar">Guardar</button>
            </div>
            </form>
            <script>
                $(function() {
                    $('.cq-dropdown').dropdownCheckboxes();
                });

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
                                        window.location = "form_descarga.php";
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