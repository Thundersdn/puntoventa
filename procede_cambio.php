<?php
session_start();
if($_SESSION['autorizado']<>1){
    header("Location: index.php");
}
error_reporting(0);
require('class_lib/class_conecta_mysql.php');
require('class_lib/funciones.php');
$db=new ConexionMySQL();

$codigo=test_input($_POST['codigo']);
$descripcion=test_input(strtoupper($_POST['descripcion']));
$costo=test_input($_POST['costo']);
$precio=test_input($_POST['precio']);
$proveedor=test_input($_POST['proveedor']);
$linea=test_input($_POST['linea']);
$grupo=test_input($_POST['grupo']);
$codigos=test_input(strtoupper($_POST['codigostock']));
$fecha_cad=test_input($_POST['fecha_caducidad']);
if($grupo=='undefined'){
  $grupo=0;
}

if($costo>=0 and $precio>=0){
$update=$db->consulta("Update articulos set descripcion='$descripcion', costo=$costo, precio=$precio,
     proveedor=$proveedor, linea=$linea, grupo=$grupo, codigostock='$codigos', fecha_cad='$fecha_cad' where codigo='$codigo'");
     }else{
     echo 'error';  
     }
?>