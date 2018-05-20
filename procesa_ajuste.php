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
$cantidad=test_input($_POST['cantidad']);
$tipo=test_input($_POST['tipo']);
$dif=test_input($_POST['diferencia']);
$usuario=test_input($_SESSION['nombre_de_usuario']);
$dif=abs($dif);
$cadena_insert=$db->consulta("Insert into kardex(codigo,cantidad,tipo,fecha,user,costou,preciou,proveedor,descuento_porcentaje,impuesto_porcentaje,serie,numero) values(
'$codigo',$dif,'$tipo',now(),'$usuario',0.00,0.00,0,0.00,0.00,0,0)");

$cadena_update=$db->consulta("Update existencias set cantidad=$cantidad where codigo='$codigo'");
?>