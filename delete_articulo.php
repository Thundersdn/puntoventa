<?php
session_start();
if($_SESSION['autorizado']<>1){
    header("Location: index.php");
}
error_reporting(0);
require('class_lib/class_conecta_mysql.php');
require('class_lib/funciones.php');
$db=new ConexionMySQL();

$codigo=test_input($_POST['codigo']);
$carpeta_img='img_articulos/';
$cadena=$db->consulta("Select imagen from articulos where codigo='$codigo'");
if($db->numero_de_registros($cadena)>0){
   while($e=$db->buscar_array($cadena)){
      unlink($carpeta_img.$e['imagen']);
   }
}

$delete=$db->consulta("Delete from articulos where codigo='$codigo'");
?>