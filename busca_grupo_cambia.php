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

$cadena="select descripcion from lineas where linea=$linea and grupo=$grupo";
$exe=$db->consulta($cadena);
 if($db->numero_de_registros($exe)>0){
    while($re=$db->buscar_array($exe)){
      $s=$re['descripcion'];
    }
    echo $s;
 }else{
   echo "0";
 }
?>