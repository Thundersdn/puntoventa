<?php
session_start();
if($_SESSION['autorizado']<>1){
    header("Location: index.php");
}
error_reporting(0);
require('class_lib/class_conecta_mysql.php');
require('class_lib/funciones.php');

$db=new ConexionMySQL();

$codigo=test_input(strtoupper($_POST['codigo']));
$descripcion=test_input(strtoupper($_POST['descripcion']));
$costo=test_input($_POST['costo']);
$precio=test_input($_POST['precio']);
$proveedor=test_input($_POST['proveedor']);
$codigostock=test_input(strtoupper($_POST['codigostock']));
$fecha_caducidad=test_input($_POST['fecha_caducidad']);
$linea=test_input($_POST['linea']);
$grupo=test_input($_POST['grupo']);

if($costo>=0 and $precio>=0){
$revisa_en_existencia=$db->consulta("Select cantidad from existencias where codigo='$codigo'");
if($db->numero_de_registros($revisa_en_existencia)==0){
   $ingresa_en_existencia=$db->consulta("Insert into existencias(codigo,cantidad) values('$codigo',0.00)");
}

$revisa_articulo=$db->consulta("Select * from articulos where codigo='$codigo'");
if($db->numero_de_registros($revisa_articulo)>0){
  echo "3";
}else{
$inserta_articulo="Insert into articulos(codigo,descripcion,costo,precio,proveedor,linea,grupo,codigostock,fecha_cad) values(
'$codigo','$descripcion',$costo,$precio,$proveedor,'$linea','$grupo','$codigostock','$fecha_caducidad')";
$exec=$db->consulta($inserta_articulo);
echo "1";
 }
}else{
  echo "error";
}
?>