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

$db->consulta("SET NAMES 'utf8'");
if($caja=="1"){
 $cadena='Select caja1 as numero from parametros';
}
if($caja=="2"){
 $cadena='Select caja2 as numero from parametros';
}
if($caja=="3"){
 $cadena='Select caja3 as numero from parametros';
}
if($caja=="4"){
 $cadena='Select caja4 as numero from parametros';
}
$exe=$db->consulta($cadena);
 if($db->numero_de_registros($exe)>0){
   while($re=$db->buscar_array($exe)){
       $sig_ticket=intval($re['numero']) + 1;
     }
   echo $sig_ticket;
   }
?>
