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


        case 'editar_inv':
            editar_inv();
            break;

        case 'editar_prov':
            editar_prov();
            break;


        case 'editar_user':
            editar_user();
            break;

        case 'editar_perfil':
            editar_perfil();
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

    $consulta = "INSERT INTO inventario (id_maquina,id_operador, observacion, horas_t, horas_in, horometraje_i, horometraje_f,lugar_t,fallo,fecha,hora_paro,hora_reinicio,gastos_falla) 
    VALUES ('$id_maquina','$id_operador', '$observacion','$horas_t','$horas_in','$horometraje_i','$horometraje_f','$lugar_t','$fallo','$fecha','$hora_paro','$hora_reinicio','$gastos_falla')";
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


    $consulta = "UPDATE inventario SET id_operador = '$id_operador', observacion = '$observacion', 
        horas_t = '$horas_t',  horas_in = '$horas_in', horometraje_i = '$horometraje_i',
		horometraje_f = '$horometraje_f', lugar_t='$lugar_t',fecha='$fecha',hora_paro='$hora_paro',hora_reinicio='$hora_reinicio', fallo = '$fallo', gastos_falla = '$gastos_falla' WHERE id = '$id' ";
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
