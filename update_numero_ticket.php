<?php
session_start();
if($_SESSION['autorizado']<>1){
    header("Location: index.php");
}
error_reporting(0);
require('class_lib/class_conecta_mysql.php');
require('class_lib/funciones.php');
$db=new ConexionMySQL();
$caja=test_input($_POST['caja']);


if($caja==1){
  $cadena_param=$db->consulta("Update parametros set caja1=caja1 + 1");
}
if($caja==2){
  $cadena_param=$db->consulta("Update parametros set caja2=caja2 + 1");
}
if($caja==3){
  $cadena_param=$db->consulta("Update parametros set caja3=caja3 + 1");
}
if($caja==4){
  $cadena_param=$db->consulta("Update parametros set caja4=caja4 + 1");
}
?>