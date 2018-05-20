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
$cadena="select a.costo,a.descripcion,e.cantidad from articulos a,existencias e where a.codigo='$codigo' and e.codigo=a.codigo";
$exe=$db->consulta($cadena);
 if($db->numero_de_registros($exe)>0){
   $array=array();
    while($re=$db->buscar_array($exe)){
      $array=$re;
    }
    echo json_encode($array);
 }else{
      echo "0";
 }
?>
