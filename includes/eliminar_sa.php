<?php

session_start();
error_reporting(0);


	$id = $_GET['id'];
	include "db.php";
	$query = mysqli_query($conexion,"DELETE FROM salida_almacen WHERE id = '$id'");
	
	header ('Location: ../views/salidas_almacen.php?m=1');
