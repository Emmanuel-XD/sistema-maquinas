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
                <form action="../includes/consultar.php" method="POST" accept-charset="utf-8" id="filtro-form">
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
                            <label for="">Estatus</label>
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
                    <!--<button type="submit" class="btn btn-primary" name="save" id="save">Guardar</button>-->
                    <button type="button" class="btn btn-primary" id="filtro">Buscar <i class="fa fa-search" aria-hidden="true"></i></button>
                    <button id="export-btn" class="btn btn-success" type="button">Exportar a Excel</button><a id="download-link" style="display: none"></a>
                </form>

            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Maquina</th>
                                <th>Horas Activas/Trab.</th>
                                <th>Horas Inactivas</th>


                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require_once("../includes/db.php");
                            $result = mysqli_query($conexion, "SELECT i.id, i.id_maquina,i.id_operador,i.observacion,i.horas_t, 
                            i.horas_in,i.horometraje_i,i.horometraje_f,i.lugar_t, i.fallo,i.hora_paro,i.hora_reinicio,i.fecha,
                            i.gastos_falla, m.name FROM inventario i INNER JOIN maquinas m ON i.id_maquina = m.id;");
                            while ($fila = mysqli_fetch_assoc($result)) :
                            ?>
                                <tr>
                                    <td><?php echo $fila['name']; ?></td>
                                    <td><?php echo $fila['horas_t']; ?></td>
                                    <td><?php echo $fila['horas_in']; ?></td>


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
                        $("#horas_t").val(data.total_horas_activas); // Actualizado a $("#horas_a")
                        $("#horas_in").val(data.total_horas_inactivas); // Actualizado a $("#horas_p")

                        if (data.status === "Inactivo") {
                            $("#status").css("background-color", "red");
                            $("#status").css("color", "white");
                        } else if (data.status === "Activo") {
                            $("#status").css("background-color", "green");
                            $("#status").css("color", "white");
                        } else {
                            $("#status").css("background-color", "");
                            $("#status").css("color", "");
                        }
                    }
                });
            });
        });
    </script>

    <script>
        $("#filtro").click(function() {
            var starDate = $("#star").val();
            var endDate = $("#fin").val();
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