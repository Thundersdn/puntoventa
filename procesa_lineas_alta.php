<?php
session_start();
if($_SESSION['autorizado']<>1){
    header("Location: index.php");
}
error_reporting(0);
require('class_lib/class_conecta_mysql.php');
require('class_lib/funciones.php');
$db=new ConexionMySQL();

$linea=test_input($_POST['linea']);
$grupo=test_input($_POST['grupo']);
$descripcion=test_input(strtoupper($_POST['descripcion']));


/*verifica si ya existe la linea y grupo*/
$cadena="Select linea, grupo from lineas where linea=$linea and grupo=$grupo";
$exe=$db->consulta($cadena);
if($db->numero_de_registros($exe)>0){
  echo "EXISTE";
}else{
  $cadena2="Insert into lineas(linea,grupo,descripcion,marca_eliminada) values($linea,$grupo,'$descripcion','NO')";
  if($db->consulta($cadena2)){
    echo "PROCESADO";
  }else{
    echo "ERROR";
  }
}

?>
