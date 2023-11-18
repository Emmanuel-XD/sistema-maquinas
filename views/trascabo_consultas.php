<?php include "../includes/header.php"; ?>
<script src="https://unpkg.com/xlsx/dist/xlsx.full.min.js"></script>

<body id="page-top">
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Reportes semanales / editar y eliminar reportes </h6>
                <form action="../includes/reporte_horas.php" method="POST" accept-charset="utf-8" id="filtro-form" target="_blank">
                    <br>
                    <div class="row">

                        <div class="col-md-6">

                            <div class="form-group">
                                <label><b>Fecha Inicio</b></label>
                                <input type="date" name="start" id="start" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="maquina">Maquina: </label>
                            <select class="form-control" name="id_maquina" id="id_maquina" required>
                            <option value="">Selecciona una opción</option>
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
                    </div>

                    <br>

                    <button type="button" class="btn btn-primary" id="searchData">Buscar datos de semana <i class="fa fa-search" aria-hidden="true"></i></button>
                    <button id="printExcel" class="btn btn-success" type="button">Exportar a Excel</button><a id="download-link" style="display: none"></a>
                </form>

            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Fecha de reporte</th>
                                <th>Maquina de reporte</th>
                                <th>Acciones</th>


                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
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
    <script src="../js/trascaboPrint.js"></script>
    <?php include "../includes/footer.php"; ?>
</body>

</html>