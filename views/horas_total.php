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
                <h6 class="m-0 font-weight-bold text-primary">Reportes de Total de Horas</h6>
                <form action="../includes/reporte_horas.php" method="POST" accept-charset="utf-8" id="filtro-form" target="_blank">
                    <br>
                    <div class="row">

                        <div class="col-md-4">

                            <div class="form-group">
                                <label><b>Fecha Inicio</b></label>
                                <input type="date" name="star" id="star" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><b> Fecha Fin</b></label>
                                <input type="date" name="fin" id="fin" class="form-control" required>
                            </div>
                        </div>

                    </div>

                    <br>

                    <button type="button" class="btn btn-primary" id="filtro">Buscar <i class="fa fa-search" aria-hidden="true"></i></button>
                    <button class="btn btn-danger" type="submit">Exportar a PDF</button><a id="download-link" style="display: none"></a>
                    <button id="export-btn" class="btn btn-success" type="button">Exportar a Excel</button><a id="download-link" style="display: none"></a>
                </form>

            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Maquina</th>
                                <th>Serie</th>
                                <th>Modelo</th>
                                <th>Horas Activas/Trabajadas.</th>
                                <th>Horas Inactivas</th>
                                <th>Precio Renta</th>


                            </tr>
                        </thead>
                        <tbody>


                            <?php
                            require_once("../includes/db.php");
                            $result = mysqli_query($conexion, "SELECT m.name AS maquina, m.serie, m.modelo, SUM(i.horas_t) AS total_horas_activas,
                            SUM(i.horas_in) AS total_horas_inactivas FROM maquinas m LEFT JOIN inventario i ON i.id_maquina = m.id 
                            GROUP BY m.name, m.serie, m.modelo;");
                            while ($fila = mysqli_fetch_assoc($result)) :

                                $renta = 1670.40;
                            ?>
                                <tr>
                                    <td><?php echo $fila['maquina']; ?></td>
                                    <td><?php echo $fila['serie']; ?></td>
                                    <td><?php echo $fila['modelo']; ?></td>
                                    <td><?php echo $fila['total_horas_activas']; ?></td>
                                    <td><?php echo $fila['total_horas_inactivas']; ?></td>
                                    <td><?php echo '$', $fila['total_horas_activas'] * $renta; ?></td>


                                </tr>
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
        $("#filtro").click(function() {
            var starDate = $("#star").val();
            var endDate = $("#fin").val();

            // Verificar si no se han seleccionado fechas
            if (!starDate || !endDate) {
                Swal.fire({
                    title: 'Fechas no seleccionadas',
                    text: 'Por favor, selecciona un rango de fechas antes de buscar.',
                    icon: 'warning',
                    confirmButtonText: 'Aceptar'
                });
                return; // Detener la ejecución si no se seleccionaron fechas
            }

            var idMaquina = $("#id").val();

            $.ajax({
                url: "../includes/consultar.php",
                type: "POST",
                data: {
                    star: starDate,
                    fin: endDate,
                    id: idMaquina
                },
                success: function(data) {
                    $("#dataTable").html(data);
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
            downloadLink.download = 'total_de_horas.xlsx';
            downloadLink.click();
        }
        const exportButton = document.getElementById('export-btn');
        exportButton.addEventListener('click', exportTableToExcel);
    </script>

    <?php include "../includes/footer.php"; ?>
</body>

</html>