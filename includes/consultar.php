<?php
include_once "../includes/db.php";

if (isset($_POST['star']) && isset($_POST['fin'])) {
    $starDate = $_POST['star'];
    $endDate = $_POST['fin'];

   
    $consulta_totales = "SELECT m.name AS maquina, m.serie, m.modelo, SUM(i.horas_t) AS total_horas_activas,
    SUM(i.horas_in) AS total_horas_inactivas FROM maquinas m LEFT JOIN inventario i ON i.id_maquina = m.id AND i.fecha BETWEEN '$starDate' AND '$endDate'
    GROUP BY m.name, m.serie, m.modelo";
    $result_totales = mysqli_query($conexion, $consulta_totales);

    $totales_por_maquina = array();
    while ($fila_total = mysqli_fetch_assoc($result_totales)) {
        $renta = 1670.40;
        $totales_por_maquina[$fila_total['maquina']] = array(
            'serie' => $fila_total['serie'],
            'modelo' => $fila_total['modelo'],
            'total_horas_activas' => $fila_total['total_horas_activas'],
            'total_horas_inactivas' => $fila_total['total_horas_inactivas']
        );
    }

    echo '<table>';
    echo '<thead>
<tr>
<th>Maquina</th>
<th>Serie</th>
<th>Modelo</th>
<th>Horas Activas/Trabajadas</th>
<th>Horas Inactivas</th>
<th>Precio Renta</th>
</tr>
</thead>';
    echo '<tbody>';
    foreach ($totales_por_maquina as $maquina_nombre => $totales) {
        echo '<tr>';
        echo '<td>' . $maquina_nombre . '</td>';
        echo '<td>' . $totales['serie'] . '</td>';
        echo '<td>' . $totales['modelo'] . '</td>';
        echo '<td>' . $totales['total_horas_activas'] . '</td>';
        echo '<td>' . $totales['total_horas_inactivas'] . '</td>';
        echo '<td>' . '$', $totales['total_horas_activas'] * $renta . '</td>';
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
}
