<?php
if (isset($_POST['accion'])) {
    switch ($_POST['accion']) {
            //casos de registros


        case 'insertar_maquina':
            insertar_maquina();
            break;

        case 'insertar_inventario':
            insertar_inventario();
            break;


        case 'insertar_operador':
            insertar_operador();
            break;

        case 'insert_carga':
            insert_carga();
            break;


        case 'editar_inv':
            editar_inv();
            break;

        case 'editar_prov':
            editar_prov();
            break;

        case 'editar_operador':
            editar_operador();
            break;


        case 'editar_user':
            editar_user();
            break;

        case 'editar_perfil':
            editar_perfil();
            break;

        case 'editar_carga':
            editar_carga();
            break;
    }
}



function insertar_maquina()
{
    global $conexion;
    extract($_POST);
    include "db.php";

    $consulta = "INSERT INTO maquinas (name, modelo, serie, ubicacion, status) 
    VALUES ('$name', '$modelo','$serie','$ubicacion','$status')";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        $response = array(
            'status' => 'success',
            'message' => 'Los datos se guardaron correctamente'
        );
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'Ocurrió un error inesperado'
        );
    }

    echo json_encode($response);
}

function insertar_operador()
{
    global $conexion;
    extract($_POST);
    include "db.php";

    $consulta = "INSERT INTO operadores (nombre, apellido, edad, telefono) 
    VALUES ('$nombre', '$apellido','$edad','$telefono')";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        $response = array(
            'status' => 'success',
            'message' => 'Los datos se guardaron correctamente'
        );
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'Ocurrió un error inesperado'
        );
    }

    echo json_encode($response);
}

function insertar_inventario()
{
    global $conexion;
    extract($_POST);
    include "db.php";

    // Convertimos el arreglo de fallas a una cadena para almacenar en la base de datos
    $fallos =  json_decode($fallas);
    $fallas_str = implode(",", $fallos);
    if ($fallas_str === "") {
        $fallas_str = "sin fallas";
    }
    $consulta = "INSERT INTO inventario (id_maquina, id_operador, observacion, horas_t, horas_in, horometraje_i, horometraje_f, lugar_t, fallo, fecha, hora_paro, hora_reinicio, gastos_falla, responsable_falla) 
    VALUES ('$id_maquina', '$id_operador', '$observacion', '$horas_t', '$horas_in', '$horometraje_i', '$horometraje_f', '$lugar_t', '$fallas_str', '$fecha', '$hora_paro', '$hora_reinicio', '$gastos_falla', '$responsable_falla')";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        $response = array(
            'status' => 'success',
            'message' => 'Los datos se guardaron correctamente'
        );
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'Ocurrió un error inesperado'
        );
    }

    echo json_encode($response);
}

function insert_carga()
{
    global $conexion;
    extract($_POST);
    include "db.php";
    session_start();
    $user = $_SESSION['usuario'];

    // Verificar si el folio ya existe
    $consulta_verificacion = "SELECT folio FROM acarreos WHERE folio LIKE '$folio%'";
    $resultado_verificacion = mysqli_query($conexion, $consulta_verificacion);
    $num_registros = mysqli_num_rows($resultado_verificacion);

    if ($num_registros > 0) {
        // El folio ya existe, encuentra el máximo consecutivo existente
        $consecutivos = array();
        while ($row = mysqli_fetch_assoc($resultado_verificacion)) {
            $folio_existente = $row['folio'];
            $partes_folio = explode("-", $folio_existente);
            $consecutivos[] = intval(end($partes_folio));
        }

        // Encuentra el máximo consecutivo y agrega 1
        $max_consecutivo = max($consecutivos);
        $consecutivo = $max_consecutivo + 1;

        // Genera el nuevo folio
        $parte_aleatoria = "A" . mt_rand(1000, 9999);
        $nuevo_folio = $parte_aleatoria . "-" . sprintf("%02d", $consecutivo);
        $folio = $nuevo_folio;
    }

    // Procesar las imágenes
    if (!empty($_FILES['image1']['name'])) {
        $imagen1_tmp = $_FILES['image1']['tmp_name'];
        $imagen1_ruta = 'images/' . $_FILES['image1']['name'];
        move_uploaded_file($imagen1_tmp, $imagen1_ruta);
    }

    if (!empty($_FILES['image2']['name'])) {
        $imagen2_tmp = $_FILES['image2']['tmp_name'];
        $imagen2_ruta = 'images/' . $_FILES['image2']['name'];
        move_uploaded_file($imagen2_tmp, $imagen2_ruta);
    }

    $material = json_decode($material);
    $material_str = implode(",", $material);
    if ($material_str === "") {
        $material_str = "sin material";
    }

    $consulta = "INSERT INTO acarreos (folio, transporte, placa, cant, material, image1, image2, user) 
    VALUES ('$folio', '$transporte', '$placa', '$cant', '$material_str', '$imagen1_ruta', '$imagen2_ruta', '$user')";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        $response = array(
            'status' => 'success',
            'message' => 'Los datos se guardaron correctamente'
        );
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'Ocurrió un error inesperado'
        );
    }

    echo json_encode($response);
}



function editar_inv()
{
    require_once("db.php");

    extract($_POST);
    $id_operador = $_POST['id_operador'];
    $fallos =  json_decode($_POST["fallas"]);
    // Procesar los valores de los checkboxes en un solo string

    $fallas_str = implode(',', $fallos);
    if ($fallas_str === "") {
        $fallas_str = "sin fallas";
    }
    $consulta = "UPDATE inventario SET id_operador = '$id_operador', observacion = '$observacion', 
        horas_t = '$horas_t', horas_in = '$horas_in', horometraje_i = '$horometraje_i',
		horometraje_f = '$horometraje_f', lugar_t='$lugar_t', fecha='$fecha', hora_paro='$hora_paro', hora_reinicio='$hora_reinicio', fallo = '$fallas_str', gastos_falla = '$gastos_falla', responsable_falla='$responsable_falla' WHERE id = '$id' ";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        echo json_encode("correcto");
    } else {
        echo json_encode("error");
    }
}

function editar_carga()
{
    require_once("db.php");

    extract($_POST);
    $cant = $_POST['cant'];

    // El valor de $_POST["materiales"] ya es un array
    $materiales_str = implode(',', $materiales);
    if ($materiales_str === "") {
        $materiales_str = "sin materiales";
    }

    $consulta = "UPDATE acarreos SET transporte = '$transporte', placa = '$placa', 
    cant = '$cant', material = '$materiales_str' WHERE id = '$id' ";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        echo json_encode("correcto");
    } else {
        echo json_encode("error");
    }
}


function editar_prov()
{
    require_once("db.php");

    extract($_POST);


    $consulta = "UPDATE maquinas SET name = '$name', modelo = '$modelo', 
    serie = '$serie' , ubicacion = '$ubicacion', status = '$status' WHERE id = '$id' ";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        echo json_encode("correcto");
    } else {
        echo json_encode("error");
    }
}

function editar_operador()
{
    require_once("db.php");

    extract($_POST);


    $consulta = "UPDATE operadores SET nombre = '$nombre', apellido = '$apellido', 
    edad = '$edad' , telefono = '$telefono' WHERE id = '$id' ";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        echo json_encode("correcto");
    } else {
        echo json_encode("error");
    }
}

function editar_user()
{
    require_once("db.php");
    extract($_POST);
    $password = trim($_POST['password']);
    $password = password_hash($password, PASSWORD_DEFAULT, ['cost' => 5]);
    $consulta = "UPDATE users SET usuario = '$usuario', correo = '$correo', password = '$password',
		telefono='$telefono', id_rol='$id_rol' WHERE id = '$id' ";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        echo json_encode("correcto");
    } else {
        echo json_encode("error");
    }
}

function editar_perfil()
{
    include "db.php";
    extract($_POST);
    $consulta = "UPDATE users SET usuario = '$usuario', correo = '$correo' WHERE id = '$id' ";
    $resultado = mysqli_query($conexion, $consulta);
    if ($resultado === true) {
        echo json_encode("updated");
    }
    if ($resultado === false) {
        echo json_encode("error");
    }
}
