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
                                    <option value="0">Selecciona una opción</option>
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



                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="" class="form-label"><b>Filtrar</b></label><br>
                                <button type="button" id="filtro" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i></button>
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
                            <?php
                            require_once("../includes/db.php");
                            $result = mysqli_query($conexion, "SELECT r.id,r.folio,r.id_empleado,r.id_area,r.puesto,
                            r.cantidad,r.descripcion,r.fecha, o.nombre, o.apellido, a.area FROM resguardos r INNER JOIN 
                            operadores o ON r.id_empleado = o.id INNER JOIN areas a ON r.id_area = a.id");
                            while ($fila = mysqli_fetch_assoc($result)) :
                            ?>
                                <tr>
                                    <td><?php echo $fila['folio']; ?></td>
                                    <td><?php echo $fila['nombre'] . ' ' . $fila['apellido']; ?></td>
                                    <td><?php echo $fila['area']; ?></td>
                                    <td><?php echo $fila['puesto']; ?></td>
                                    <td><?php echo $fila['cantidad']; ?></td>
                                    <td><?php echo $fila['descripcion']; ?></td>
                                    <td><?php echo $fila['fecha']; ?></td>
                                    <td>
                                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editar<?php echo $fila['id']; ?>">
                                            <i class="fa fa-edit "></i>
                                        </button>
                                        <a href="../includes/eliminar_val.php?id=<?php echo $fila['id'] ?>" class="btn btn-danger btn-del">
                                            <i class="fa fa-trash "></i></a>
                                    </td>
                                </tr>
                                <?php include "editar_val.php"; ?>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
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

</html>