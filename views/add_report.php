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

                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#inv">
                    <span class="glyphicon glyphicon-plus"></span> Agregar nuevo reporte <i class="fa fa-plus"></i>
                </button>
                <button id="export-btn" class="btn btn-outline-success" type="button">Exportar a Excel</button>
                <a id="download-link" style="display: none"></a>



            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>OPERADOR</th>
                                <th>FECHA</th>
                                <th>HRS TRABAJADAS</th>
                                <th>HRS INACTIVA</th>
                                <th>HOROMETRO INICIAL</th>
                                <th>HOROMETRO TERMINAL</th>
                                <th>LUGAR DE TRABAJO</th>
                                <th>TIPO DE FALLA</th>
                                <th>hora de paro</th>
                                <th>hora de reinicio</th>
                                <th>gastos de falla</th>
                                <th>OBSERVACIONES</th>
                                <th>UPDATE/DEL</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require_once("../includes/db.php");
                            $result = mysqli_query($conexion, "SELECT * FROM inventario ");
                            while ($fila = mysqli_fetch_assoc($result)) :
                            ?>
                                <tr>
                                    <td><?php echo $fila['operador']; ?></td>
                                    <td><?php echo $fila['fecha']; ?></td>
                                    <td><?php echo $fila['horas_t']; ?></td>
                                    <td><?php echo $fila['horas_in']; ?></td>
                                    <td><?php echo $fila['horometraje_i']; ?></td>
                                    <td><?php echo $fila['horometraje_f']; ?></td>
                                    <td><?php echo $fila['lugar_t']; ?></td>
                                    <td><?php echo $fila['fallo']; ?></td>
                                    <td><?php echo $fila['hora_paro']; ?></td>
                                    <td><?php echo $fila['hora_reinicio']; ?></td>
                                    <td><?php echo $fila['gastos_falla']; ?></td>
                                    <td><?php echo $fila['observacion']; ?></td>
                                    <td>
                                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editar<?php echo $fila['id']; ?>">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <a href="../includes/eliminar_inv.php?id=<?php echo $fila['id'] ?>" class="btn btn-danger btn-del">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php include "editar_inv.php"; ?>
                            <?php endwhile; ?>

                        </tbody>
                    </table>
                    <script>
                        $('.btn-del').on('click', function(e) {
                            e.preventDefault();
                            const href = $(this).attr('href');

                            Swal.fire({
                                title: 'Estás seguro de eliminar este registro?',
                                text: "¡No podrás revertir esto!",
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
                                        );
                                    }
                                    document.location.href = href;
                                }
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $("#id").change(function() {
                var maquinaSeleccionada = $(this).val();

                $.ajax({
                    url: "obtener_maquina.php",
                    type: "POST",
                    data: {
                        id: maquinaSeleccionada
                    },
                    dataType: "json",
                    success: function(data) {
                        $("#modelo").val(data.modelo);
                        $("#serie").val(data.serie);
                        $("#ubicacion").val(data.ubicacion);
                        $("#status").val(data.status);
                        $("#mant").val(data.mantenimiento);
                        $("#horas_a").val(data.horas_a);
                        $("#horas_p").val(data.horas_p);
                    }
                });
            });
        });
    </script>
    <script>
        $('#filtro').click(function(e) {
            e.preventDefault();
            var startDate = $('#star').val();
            var endDate = $('#fin').val();

            var data = {
                start: startDate,
                end: endDate
            };

            $.ajax({
                url: 'dataTable.php',
                method: 'POST',
                data: data,
                success: function(response) {
                    $('#table_id tbody').html(response);
                }
            });
        });
    </script>
    <script>
        function exportTableToExcel() {
            const table = document.getElementById('dataTable');
            const data = [];
            const rows = table.querySelectorAll('tr');
            rows.forEach((row) => {
                const rowData = [];
                const cells = row.querySelectorAll('th, td');
                cells.forEach((cell) => {
                    rowData.push(cell.innerText);
                });
                data.push(rowData);
            });
            const workbook = XLSX.utils.book_new();
            const worksheet = XLSX.utils.aoa_to_sheet(data);
            XLSX.utils.book_append_sheet(workbook, worksheet, 'Tabla');
            const excelBuffer = XLSX.write(workbook, {
                bookType: 'xlsx',
                type: 'array'
            });
            const blob = new Blob([excelBuffer], {
                type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
            });
            const downloadLink = document.getElementById('download-link');
            downloadLink.href = URL.createObjectURL(blob);
            downloadLink.download = 'inventario.xlsx';
            downloadLink.click();
        }
        const exportButton = document.getElementById('export-btn');
        exportButton.addEventListener('click', exportTableToExcel);
    </script>

    <?php
    $query = mysqli_query($conexion, "SELECT SUM(horas_t) FROM inventario");
    $arrayDatos = array();
    while ($row = mysqli_fetch_array($query)) {
        $arrayDatos[] = $row;
    }
    print_r($arrayDatos);
    //Ahora tienes la suma en $resultadototal
    ?>
    <span>total de horas activa </span> <span id="{{'$query'}}"></span>

    <?php include "form_inv.php"; ?>
    <?php include "../includes/footer.php"; ?>
</body>

</html>