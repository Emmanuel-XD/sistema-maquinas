<?php
include_once "../includes/db.php";

if (isset($_POST['star']) && isset($_POST['fin']) && isset($_POST['id'])) {
    $starDate = $_POST['star'];
    $endDate = $_POST['fin'];
    $idMaquina = $_POST['id'];

    $consulta = "SELECT i.id, i.id_maquina,i.id_operador,i.observacion,i.horas_t, 
    i.horas_in,i.horometraje_i,i.horometraje_f,i.lugar_t, i.fallo,i.hora_paro,i.hora_reinicio,i.fecha,
    i.gastos_falla, m.name FROM inventario i INNER JOIN maquinas m ON i.id_maquina = m.id
    WHERE i.fecha BETWEEN '$starDate' AND '$endDate' AND i.id_maquina = " . $idMaquina;
    $result = mysqli_query($conexion, $consulta);

    // Calcular el total de horas activass e inactivas
    $sqlsum = "SELECT SUM(i.horas_t) AS total_horas_activas, SUM(i.horas_in) AS total_horas_inactivas FROM inventario i 
    INNER JOIN maquinas m ON i.id_maquina = m.id WHERE i.fecha BETWEEN '$starDate' AND '$endDate' AND i.id_maquina = $idMaquina";
    $resultSum = mysqli_query($conexion, $sqlsum);
    $filaSum = mysqli_fetch_assoc($resultSum);
    $totalHorasActivas = $filaSum['total_horas_activas'];
    $totalHorasInactivas = $filaSum['total_horas_inactivas'];

    // Construir la tabla con los resultados y la suma de horas
    if (mysqli_num_rows($result) > 0) {
        echo '<table>';
        echo '<thead>
        <tr>
        <th>Maquina</th>
        <th>Horas Activas/Trab.</th>
        <th>Horas Inactivas</th>
        </tr>
        </thead>';
        echo '<tbody>';
        while ($fila = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>' . $fila['name'] . '</td>';
            echo '<td>' . $fila['horas_t'] . '</td>';
            echo '<td>' . $fila['horas_in'] . '</td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '<tfoot>';
        echo '<tr>';
        echo '<th>Total:</th>';
        echo '<th>' . $totalHorasActivas . '</th>';
        echo '<th>' . $totalHorasInactivas . '</th>';
        echo '</tr>';
        echo '</tfoot>';
        echo '</table>';
    } else {
        // Mostrar alerta SweetAlert2 si no se encontraron resultados
        echo "<script>
                Swal.fire({
                  title: 'Sin resultados',
                  text: 'No se encontraron registros en la base de datos.',
                  icon: 'info',
                  confirmButtonText: 'Aceptar'
                });
              </script>";
    }
}
