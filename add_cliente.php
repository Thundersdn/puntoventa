<?php
session_start();
if($_SESSION['autorizado']<>1){
header("Location: index.php");
}
error_reporting(0);
require('class_lib/class_conecta_mysql.php');
require('class_lib/funciones.php');
$db= new ConexionMySQL();

$nombre=test_input(strtoupper($_POST['nombre']));
$telefono=test_input(strtoupper($_POST['telefono']));
$domicilio=test_input(strtoupper($_POST['domicilio']));
$ciudad=test_input(strtoupper($_POST['ciudad']));

$create="insert into clientes(nombre,telefono,domicilio,ciudad) values
('$nombre','$telefono','$domicilio','$ciudad')";
$ejecuta=$db->consulta($create);

$ultimoid="SELECT * FROM clientes WHERE id = LAST_INSERT_ID();";
$exe=$db->consulta($ultimoid);

        $jTableResult = array();
		$jTableResult['Result'] = "OK";
        $jTableResult['Record'] = mysql_fetch_array($exe);
		print json_encode($jTableResult);

$db->DesconectaServer();
?>