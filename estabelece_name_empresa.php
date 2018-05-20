<?php
session_start();
if($_SESSION['autorizado']<>1){
    header("Location: index.php");
}
error_reporting(0);
require('class_lib/class_conecta_mysql.php');
require('class_lib/funciones.php');
$db=new ConexionMySQL();
$name=test_input(strtoupper($_POST['name']));
$dir=test_input(strtoupper($_POST['dom']));

$cadena=$db->consulta("Update parametros set nombre_empresa='$name', domicilio_empresa='$dir'");
?>