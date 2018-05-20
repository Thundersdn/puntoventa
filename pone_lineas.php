<?php
session_start();
if($_SESSION['autorizado']<>1){
    header("Location: index.php");
}
error_reporting(0);
require('class_lib/class_conecta_mysql.php');

$db=new ConexionMySQL();
$db->consulta("SET NAMES 'utf8'");
$cadena="select linea, descripcion from lineas where grupo=0 and marca_eliminada='NO' order by linea";
$exe=$db->consulta($cadena);
 if($db->numero_de_registros($exe)>0){
   echo "<select class='form-control select2' id='linea' onchange='pone_grupos();' style='width: 100%'>";
   echo "<option value=0>Selecciona una linea...</option>";
    while($re=$db->buscar_array($exe)){
     echo "<option value=$re[linea]>$re[linea] - $re[descripcion]</option>";
     }
    echo "</select>";
   }
?>
