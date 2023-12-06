<?php
include("../includes/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id_empleado"])) {
    $id_empleado = $_POST["id_empleado"];
    $fecha_actual = date("Y-m-d");

    // Obtener el último folio registrado por el empleado para el día actual
    $ultimoFolioRegistrado = obtenerUltimoFolioRegistrado($conexion, $id_empleado, $fecha_actual);

    if (isset($ultimoFolioRegistrado['error'])) {
        echo json_encode(array("error" => $ultimoFolioRegistrado['error']));
    } else {
        // Devolver el último folio registrado por el empleado para el día actual
        echo json_encode(array("ultimoFolioRegistrado" => $ultimoFolioRegistrado));
    }

    mysqli_close($conexion);
} else {
    // Petición no válida
    echo json_encode(array("error" => "Petición no válida"));
}
function obtenerUltimoFolioRegistrado($conexion, $id_empleado, $fecha_actual)
{
    $consulta = "SELECT folio FROM resguardos WHERE id_empleado = $id_empleado AND DATE(fecha) = '$fecha_actual' ORDER BY id DESC LIMIT 1";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        $row = mysqli_fetch_assoc($resultado);

        if ($row && isset($row['folio'])) {
            // Devolver el último folio registrado por el empleado para el día actual
            return $row['folio'];
        } else {
            // Si no hay registros para el empleado hoy, devolver un valor predeterminado
            return obtenerFolioInicial($conexion, $id_empleado, $fecha_actual);
        }
    } else {
        return array("error" => "Error en la consulta: " . mysqli_error($conexion));
    }
}

function obtenerFolioInicial($conexion, $id_empleado, $fecha_actual)
{
    // Obtener el folio inicial para el empleado y el día actual
    $consulta = "SELECT MAX(CONVERT(SUBSTRING_INDEX(folio, '-', -1), SIGNED)) AS ultimo_consecutivo FROM resguardos WHERE DATE(fecha) = '$fecha_actual'";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        $row = mysqli_fetch_assoc($resultado);
        $ultimoConsecutivo = ($row && !is_null($row['ultimo_consecutivo'])) ? $row['ultimo_consecutivo'] : 0;

        // Obtener el máximo consecutivo global para cualquier empleado
        $consulta_global = "SELECT MAX(CONVERT(SUBSTRING_INDEX(folio, '-', -1), SIGNED)) AS max_global FROM resguardos";
        $resultado_global = mysqli_query($conexion, $consulta_global);

        if ($resultado_global) {
            $row_global = mysqli_fetch_assoc($resultado_global);
            $max_global = ($row_global && !is_null($row_global['max_global'])) ? $row_global['max_global'] : 0;
            $consecutivo_global = max($ultimoConsecutivo, $max_global) + 1;

            // Devolver solo el consecutivo global sin el guion
            return sprintf("%02d", $consecutivo_global);
        } else {

            return array("error" => "Error en la consulta de folio global: " . mysqli_error($conexion));
        }
    } else {

        return array("error" => "Error en la consulta de folio inicial: " . mysqli_error($conexion));
    }
}
