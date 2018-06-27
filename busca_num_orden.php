<?php
session_start();
if($_SESSION['autorizado']<>1){
    header("Location: index.php");
}
error_reporting(1);
require('class_lib/class_conecta_mysql.php');

$db=new ConexionMySQL();

 $cadena="SELECT COUNT(*) FROM compras";
 #error_log($cadena);
 $res = $db->consulta($cadena);
 #error_log($db->buscar_array($res));
 $res = $db->buscar_array($res)['COUNT(*)'];
 $s = $res+1;
 echo $s;
 
 
?>