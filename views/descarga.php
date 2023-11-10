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
                <h6 class="m-0 font-weight-bold text-primary">Lista de Acarreos</h6>
                <br>

                <a href="form_descarga.php" class="btn btn-success" target="_blank">Agregar Registro <i class="fa fa-plus"></i></a>

            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Folio</th>
                                <th>Transporte</th>
                                <th>Placa</th>
                                <th>Cant m3</th>
                                <th>Material</th>
                                <th>Imagen1</th>
                                <th>Imagen2</th>
                                <th>Fecha - Hora</th>
                                <th>Acciones.</th>
                                <th>Reporte</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            require_once("../includes/db.php");
                            $result = mysqli_query($conexion, "SELECT * FROM acarreos ");
                            while ($fila = mysqli_fetch_assoc($result)) :
                                $imagen1 = $fila["image1"];
                                $imagen2 = $fila["image2"];
                            ?>
                                <tr>
                                    <td><?php echo $fila['folio']; ?></td>
                                    <td><?php echo $fila['transporte']; ?></td>
                                    <td><?php echo $fila['placa']; ?></td>
                                    <td><?php echo $fila['cant']; ?></td>
                                    <td><?php echo $fila['material']; ?></td>
                                    <td><img src="../includes/<?php echo $imagen1; ?>" width="50" height="70"></td>
                                    <td><img src="../includes/<?php echo $imagen2; ?>" width="50" height="70"></td>
                                    <td><?php echo $fila['fecha_registro']; ?></td>
                                    <td>
                                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editar<?php echo $fila['id']; ?>">
                                            <i class="fa fa-edit "></i>
                                        </button>
                                        <a href="../includes/eliminar_acarreo.php?id=<?php echo $fila['id'] ?>" class="btn btn-danger btn-del">
                                            <i class="fa fa-trash "></i></a>
                                    </td>
                                    <td><a href="../includes/reporte_acarreo.php?id=<?php echo $fila['id'] ?>" target="_blank" class="btn btn-danger">
                                            <i class="fa fa-file "></i></a>
                                    </td>
                                    </td>
                                </tr>
                                <?php include "editar_acarreo.php"; ?>
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