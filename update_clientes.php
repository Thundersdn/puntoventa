<?php
session_start();
if($_SESSION['autorizado']<>1){
header("Location: index.php");
}
error_reporting(0);
require('class_lib/class_conecta_mysql.php');
require('class_lib/funciones.php');
$db= new ConexionMySQL();

$id=test_input($_POST['id']);
$nombre=test_input(strtoupper($_POST['nombre']));
$telefono=test_input(strtoupper($_POST['telefono']));
$domicilio=test_input(strtoupper($_POST['domicilio']));
$ciudad=test_input(strtoupper($_POST['ciudad']));

$update="Update clientes set
           nombre='$nombre',
           telefono='$telefono',
           domicilio='$domicilio',
           ciudad='$ciudad'
           where id=$id";


        $ejecuta=$db->consulta($update);
        $jTableResult = array();
		$jTableResult['Result'] = "OK";
		print json_encode($jTableResult);

$db->DesconectaServer();
?>