<?php
error_reporting(0);
session_start();
?>

<?php include "../includes/header.php"; ?>
<script src="https://unpkg.com/xlsx/dist/xlsx.full.min.js"></script>
<style>
    .control {

        /* width: 100%; */
        height: calc(1.5em + 0.75rem + 2px);
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: #6e707e;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #d1d3e2;
        border-radius: 0.35rem;
        transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
    }
</style>

<body id="page-top">
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Historial De Mantenimiento</h6>
                <br>
                <form action="../includes/reporte_historial.php" method="POST" accept-charset="utf-8" id="filtro-form" target="_blank">
                    <select name="id_maquina" id="id_maquina" class="control">
                        <option value="0"><-Selecciona una opción-></option>
                        <?php
                        include("../includes/db.php");
                        $sql = "SELECT * FROM maquinas";
                        $resultado = mysqli_query($conexion, $sql);
                        while ($consulta = mysqli_fetch_array($resultado)) {
                            echo '<option value="' . $consulta['id'] . '">' . $consulta['name'] . '</option>';
                        }
                        ?>
                    </select>
                    <button class="btn btn-danger" name="generar" id="generar" type="submit">Generar PDF</button>
                    <button id="export-btn" class="btn btn-outline-success" type="button">Exportar a Excel</button>
                    <a id="download-link" style="display: none"></a>
                </form>


            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Maquina</th>
                                <th>Status</th>
                                <th>Inicio</th>
                                <th>Fin</th>
                                <th>Fecha Mantenimiento</th>
                                <th>Usuario</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require_once("../includes/db.php");
                            $result = mysqli_query($conexion, "SELECT h.id, h.id_maquina, h.status, h.inicio, h.fin, h.datetime, h.usuario,
                            m.name FROM historial h INNER JOIN maquinas m ON h.id_maquina = m.id");
                            while ($fila = mysqli_fetch_assoc($result)) :
                            ?>
                                <tr>
                                    <td><?php echo $fila['name']; ?></td>
                                    <td><?php echo $fila['status']; ?></td>
                                    <td><?php echo $fila['inicio']; ?></td>
                                    <td><?php echo $fila['fin']; ?></td>
                                    <td><?php echo $fila['datetime']; ?></td>
                                    <td><?php echo $fila['usuario']; ?></td>

                                </tr>

                            <?php endwhile; ?>

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#id_maquina').change(function() {
                var idMaquina = $(this).val();
                buscarMaquina(idMaquina);
            });
            $('#generar').click(function(event) {
                var idMaquina = $('#id_maquina').val();

                if (idMaquina === '0') {
                    Swal.fire({
                        title: '¡Atención!',
                        text: 'Por favor, seleccione una máquina antes de generar el reporte.',
                        icon: 'warning',
                        confirmButtonText: 'Aceptar'
                    });
                    event.preventDefault();
                }
            });

            function buscarMaquina(idMaquina) {
                $.ajax({
                    url: 'obtener_maquina.php',
                    method: 'POST',
                    data: {
                        id_maquina: idMaquina
                    },
                    success: function(data) {

                        $('#dataTable tbody').html(data);
                    },
                    error: function() {
                        alert('Error al cargar los registros de la máquina.');
                    }
                });
            }
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
            downloadLink.download = 'historial_mantenimiento.xlsx';
            downloadLink.click();
        }
        const exportButton = document.getElementById('export-btn');
        exportButton.addEventListener('click', exportTableToExcel);
    </script>




    <?php include "../includes/footer.php"; ?>
</body>

</html>