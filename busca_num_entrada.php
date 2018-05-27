<?php
session_start();
if($_SESSION['autorizado']<>1){
    header("Location: index.php");
}
error_reporting(1);
require('class_lib/class_conecta_mysql.php');

$db=new ConexionMySQL();
/**
$cadena="Select entrada_x_compra from parametros";
$exe=$db->consulta($cadena);
 if($db->numero_de_registros($exe)>0){
    while($re=$db->buscar_array($exe)){
      $s=$re['entrada_x_compra'] + 1;
    }
    echo $s;
 }else{
	 #no existe el parametro entrada_x_compra en BD
	 $cadena="Insert into parametros entrada_x_compra 
	 
 }
 **/
 $cadena="SELECT COUNT(*) FROM kardex WHERE tipo = 'EC'";
 #error_log($cadena);
 $res = $db->consulta($cadena);
 #error_log($db->buscar_array($res));
 $res = $db->buscar_array($res)['COUNT(*)'];
 $s = $res+1;
 echo $s;
 
 
?>