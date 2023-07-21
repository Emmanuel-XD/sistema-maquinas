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
                <h6 class="m-0 font-weight-bold text-primary">Reportes Diarios o Mensuales</h6>

                <form action="../includes/guardar.php" method="POST" accept-charset="utf-8" id="filtro-form">
                    <br>
                    <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><b>Tipo de reporte</b></label>
                            <select   class="form-control selector" name="type" id="type">
                                <option value="">Selecciona una opción</option>
                                <option value="1">Reporte mensual</option>
                                <option value="2">Reporte semanal</option>
                                <option value="3">Reporte diario</option>
                            </select>
                        </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label><b>Del dia</b></label>
                                <input type="date" name="start" id="start" class="selector form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label><b> Hasta el dia</b></label>
                                <input type="date" name="fin" id="fin" class="selector form-control" readonly>
                            </div>
                        </div>

                    </div>

                    <div class="row" id="datosMaquina">
                        <div class="col-md-3">
                            <label for="lang">MAQUINA:</label>
                            <select class="form-control" name="id" id="id">
                                <option value="0">Selecciona una opción</option>
                                <?php
                                include("../includes/db.php");
                                // Código para mostrar categorías desde otra tabla
                                $sql = "SELECT * FROM maquinas ";
                                $resultado = mysqli_query($conexion, $sql);
                                while ($consulta = mysqli_fetch_array($resultado)) {
                                    echo '<option value="' . $consulta['id'] . '">' . $consulta['name'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="for-label">Modelo</label>
                            <input type="text" class="form-control" name="modelo" id="modelo" readonly>
                        </div>
                        <div class="col-md-3">
                            <label for="">Serie</label>
                            <input type="text" class="form-control" name="serie" id="serie" readonly>
                        </div>
                        <div class="col-md-3">
                            <label for="">Ubicacion</label>
                            <input type="text" class="form-control" name="ubicacion" id="ubicacion" readonly>
                        </div>
                        <div class="col-md-3">
                            <label for="">Estado</label>
                            <input type="text" class="form-control" name="status" id="status" readonly>
                        </div>
                        <div class="col-md-3">
                            <label for="">Mantenimiento</label>
                            <input type="text" class="form-control" name="mant" id="mant" readonly>
                        </div>
                        <div class="col-md-3">
                            <label for="">Total de Hrs Activa</label>
                            <input type="text" class="form-control" name="horas_t" id="horas_t" readonly>
                        </div>
                        <div class="col-md-3">
                            <label for="">Total de Hrs Parada</label>
                            <input type="text" class="form-control" name="horas_in" id="horas_in" readonly>
                        </div>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-danger" name="save" id="save">Generar PDF</button>
                    <button id="export-btn" class="btn btn-success" type="button">Exportar a Excel</button><a id="download-link" style="display: none"></a>
                </form>
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
                                <th>HORA DE PARO</th>
                                <th>HORA DE REINICIO</th>
                                <th>GASTOS DE FALLA</th>
                                <th>OBSERVACIONES</th>
                                <th>UPDATE/DEL</th>
                            </tr>
                        </thead>
                        <tbody>
                                
                        
                        </tbody>
                    </table>
                    <?php include "editar_inv.php"; ?>

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
    <script src="../js/inventario.js"></script>
</html>