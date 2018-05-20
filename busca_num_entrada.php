<?php
session_start();
if($_SESSION['autorizado']<>1){
    header("Location: index.php");
}
error_reporting(0);
require('class_lib/class_conecta_mysql.php');

$db=new ConexionMySQL();

$cadena="Select entrada_x_compra from parametros";
$exe=$db->consulta($cadena);
 if($db->numero_de_registros($exe)>0){
    while($re=$db->buscar_array($exe)){
      $s=$re['entrada_x_compra'] + 1;
    }
    echo $s;
 }
?>