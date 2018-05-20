<?php
session_start();
if($_SESSION['autorizado']<>1){
    header("Location: index.php");
}
error_reporting(0);
require('class_lib/class_conecta_mysql.php');
require('class_lib/funciones.php');
$db=new ConexionMySQL();

$linea=test_input($_POST['linea']);
$grupo=test_input($_POST['grupo']);
$descripcion=test_input(strtoupper($_POST['descripcion']));

$cadena="Update lineas set descripcion='$descripcion' where linea=$linea and grupo=$grupo";
$db->consulta($cadena);

?>
