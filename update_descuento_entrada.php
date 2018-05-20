<?php
session_start();
if($_SESSION['autorizado']<>1){
    header("Location: index.php");
}
error_reporting(0);
require('class_lib/class_conecta_mysql.php');
$db=new ConexionMySQL();  
require('class_lib/funciones.php');
$descuento=test_input($_POST['descuento']);
if($descuento==""){
  $descuento=0.00;
}

 /*revisamos si hay entradas en tabla temp*/
 $revisa=$db->consulta("Select tipo from temp where tipo='EC'");
 if($db->buscar_array($revisa)>0){
   $mody=$db->consulta("Update temp set desc_porcentaje=$descuento where tipo='EC'");
 }
?>