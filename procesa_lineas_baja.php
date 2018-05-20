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
$x=0;
/*verifica si ya existe la linea y grupo*/
if($grupo=="0"){
  $cadena="Select linea,grupo from lineas where linea=$linea and grupo<>0";
  $exe=$db->consulta($cadena);
  if($db->numero_de_registros($exe)>0){
    $x=1;
  }else{
    $x=0;
  }
     if($x==1){
       echo "1";
     }else{
       $elimina="Delete from lineas where linea=$linea and grupo=$grupo";
       $exec=$db->consulta($elimina);
       echo "ELIMINADO";
     }
}else{
  $cadena="Delete from lineas where linea=$linea and grupo=$grupo";
  $exec=$db->consulta($cadena);
  echo "ELIMINADO";
}

?>
