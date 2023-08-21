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
                <h6 class="m-0 font-weight-bold text-primary">Registros Generales</h6>
                <br>

                <button id="export-btn" class="btn btn-success" type="button">Exportar a Excel</button><a id="download-link" style="display: none"></a>

            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>

                                <th style="font-size: 13px;">MAQUINA</th>
                                <th style="font-size: 13px;">OPERADOR</th>
                                <th style="font-size: 13px;">FECHA</th>
                                <th style="font-size: 13px;">HORAS TRABAJADAS</th>
                                <th style="font-size: 13px;">HORAS INACTIVA</th>
                                <th style="font-size: 13px;">HOROMETRO INICIAL</th>
                                <th style="font-size: 13px;">HOROMETRO TERMINAL</th>
                                <th style="font-size: 13px;">LUGAR DE TRABAJO</th>
                                <th style="font-size: 13px;">TIPO DE FALLA</th>
                                <th style="font-size: 13px;">HORA DE FALLA</th>
                                <th style="font-size: 13px;">HORA DE REINICIO</th>
                                <th style="font-size: 13px;">GASTOS DE FALLA</th>
                                <th style="font-size: 13px;">OBSERVACIONES</th>
                                <th style="font-size: 13px;">responsable de falla</th>
                                <th style="font-size: 13px;">ACTUALIZAR/ ELIMINAR</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            //  require_once("../includes/db.php");
                            //  $result = mysqli_query($conexion, "SELECT i.id, i.id_maquina,i.id_operador,i.observacion,i.horas_t, 
                            //  i.horas_in,i.horometraje_i,i.horometraje_f,i.lugar_t, i.fallo,i.hora_paro,i.hora_reinicio,i.fecha,
                            //  i.gastos_falla, m.name, o.nombre FROM inventario i INNER JOIN maquinas m ON i.id_maquina = m.id INNER JOIN operadores o
                            //   ON i.id_operador = o.id;");
                            //   while ($fila = mysqli_fetch_assoc($result)) :
                            ?>

                            <?php
                            require_once("../includes/db.php");
                            $result = mysqli_query($conexion, "SELECT i.id, i.id_maquina,i.id_operador,i.observacion,i.horas_t, 
                           i.horas_in,i.horometraje_i,i.horometraje_f,i.lugar_t, i.fallo,i.hora_paro,i.hora_reinicio,i.fecha,
                            i.gastos_falla, m.name, o.nombre, i.responsable_falla FROM inventario i INNER JOIN maquinas m ON i.id_maquina = m.id 
                            INNER JOIN operadores o ON i.id_operador = o.id;;");
                            while ($fila = mysqli_fetch_assoc($result)) :
                            ?>


                                <tr>
                                    <td><?php echo $fila['name']; ?></td>
                                    <td><?php echo $fila['nombre']; ?></td>
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
                                    <td><?php echo $fila['responsable_falla']; ?></td>
                                    <td>
                                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editar<?php echo $fila['id']; ?>">
                                            <i class="fa fa-edit "></i>
                                        </button>

                                        <a href="../includes/eliminar_inv.php?id=<?php echo $fila['id'] ?> " class="btn btn-danger btn-del">
                                            <i class="fa fa-trash "></i></a></button>
                                    </td>
                                </tr>
                                <?php include "editar_inv.php"; ?>
                            <?php endwhile; ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>


    <script>
               $(function(){
      $('.cq-dropdown').dropdownCheckboxes();   
    });
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



    <?php include "../includes/footer.php"; ?>
</body>


</html>