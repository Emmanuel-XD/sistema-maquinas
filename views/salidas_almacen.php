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
                <h6 class="m-0 font-weight-bold text-primary">Salidas de Almacen</h6>
                <br>


                <a href="form_almacen.php" class="btn btn-success">Agregar <i class="fa fa-plus"></i></a>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Folio</th>
                                <th>Empleado</th>
                                <th>Recibio</th>
                                <th>Area</th>
                                <th>Descripcion</th>
                                <th>Clave</th>
                                <th>Solicitado</th>
                                <th>Pieza</th>
                                <th>Entregado</th>
                                <th>Observaciones</th>
                                <th>Fecha</th>
                                <th>Acciones.</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            require_once("../includes/db.php");
                            $result = mysqli_query($conexion, "SELECT sa.id,sa.folio,sa.id_empleado,sa.recibio, sa.id_area, 
                            sa.descripcion, sa.clave,sa.solicitado,sa.id_pieza,sa.entregado,sa.observaciones,sa.fecha,
                            o.nombre,o.apellido, a.area, p.pieza FROM salida_almacen sa INNER JOIN operadores o 
                            ON sa.id_empleado = o.id INNER JOIN areas a ON sa.id_area = a.id INNER JOIN piezas p 
                            ON sa.id_pieza = p.id");
                            while ($fila = mysqli_fetch_assoc($result)) :
                            ?>
                                <tr>
                                    <td><?php echo $fila['folio']; ?></td>
                                    <td><?php echo $fila['nombre'] . ' ' . $fila['apellido']; ?></td>
                                    <td><?php echo $fila['recibio']; ?></td>
                                    <td><?php echo $fila['area']; ?></td>
                                    <td><?php echo $fila['descripcion']; ?></td>
                                    <td><?php echo $fila['clave']; ?></td>
                                    <td><?php echo $fila['solicitado']; ?></td>
                                    <td><?php echo $fila['pieza']; ?></td>
                                    <td><?php echo $fila['entregado']; ?></td>
                                    <td><?php echo $fila['observaciones']; ?></td>

                                    <td><?php echo $fila['fecha']; ?></td>
                                    <td>
                                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editar<?php echo $fila['id']; ?>">
                                            <i class="fa fa-edit "></i>
                                        </button>
                                        <a href="../includes/eliminar_sa.php?id=<?php echo $fila['id'] ?>" class="btn btn-danger btn-del">
                                            <i class="fa fa-trash "></i></a>
                                    </td>
                                </tr>
                                <?php include "editar_sa.php"; ?>
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