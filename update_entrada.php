<?php
session_start();
if($_SESSION['autorizado']<>1){
    header("Location: index.php");
}
error_reporting(0);
require('class_lib/class_conecta_mysql.php');

$db=new ConexionMySQL();
$cadena_param=$db->consulta("Update parametros set entrada_x_compra=entrada_x_compra+1");

?>