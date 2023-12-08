<?php
error_reporting(0);
session_start();

?>



<?php include "../includes/header.php"; ?>

<body id="page-top">

    <!-- Begin Page Content -->
    <div class="container-fluid">


        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Vales de Resguardo</h6>
                <br>
                <form action="" method="POST" accept-charset="utf-8" id="filtro-form">

                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="transporte" class="form-label">Empleado</label>
                                <select class="form-control" name="id_empleado" id="id_empleado">
                                    <option value="">Selecciona una opción</option>
                                    <?php
                                    include("../includes/db.php");

                                    $sql = "SELECT * FROM operadores ";
                                    $resultado = mysqli_query($conexion, $sql);
                                    while ($consulta = mysqli_fetch_array($resultado)) {
                                        echo '<option value="' . $consulta['id'] . '">' . $consulta['nombre'] . ' ' . $consulta['apellido'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="" class="form-label"><b>Del dia</b> </label>
                                <input type="date" name="dia" id="dia" class="form-control" required>
                            </div>
                        </div>



                        <div class="col-sm-0.5">
                            <div class="form-group">
                                <label for="filtro" class="form-label"><b>Filtrar</b></label><br>
                                <button type="button" id="filtro" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i></button>
                            </div>
                        </div>
                        <div class="col-sm-1">
                            <div class="form-group">
                        <label for="excel" class="form-label"><b>Archivo</b></label><br>
                                <button type="button" id="excel" class="btn btn-success"><i class="fas fa-file-excel" aria-hidden="true"></i></button>
                                </div>
                        </div>
                    </div>
                </form>

                <a href="form_vales.php" class="btn btn-success">Agregar <i class="fa fa-plus"></i></a>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Folio</th>
                                <th>Empleado</th>
                                <th>Area</th>
                                <th>Puesto</th>
                                <th>Cantidad</th>
                                <th>Descripcion</th>
                                <th>Fecha</th>
                                <th>Acciones.</th>
                            </tr>
                        </thead>

                        <tbody>
                        
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->






    </div>
    <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->




</body>

<?php include "../includes/footer.php"; ?>
<script src="../js/vales.js"></script>
</html>