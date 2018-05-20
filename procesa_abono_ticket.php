<?php
session_start();
if($_SESSION['autorizado']<>1){
    header("Location: index.php");
}
error_reporting(0);
require('class_lib/class_conecta_mysql.php');
require('class_lib/funciones.php');
$db=new ConexionMySQL();
$serie=test_input($_POST['serie']);
$numero=test_input($_POST['numero']);
$abono=test_input($_POST['monto']);
$usuario=test_input($_SESSION['nombre_de_usuario']);
$id=test_input($_POST['id_cliente']);

$pone_abono=$db->consulta("Insert into kardex(codigo,cantidad,tipo,fecha,user,costou,preciou,
proveedor,descuento_porcentaje,impuesto_porcentaje,serie,numero,fecha_proceso,referencia,referencia1,referencia2)
values('',0.00,'ABO',now(),'$usuario',0.00,$abono,0,0.00,0.00,$serie,$numero,now(),'$id','','')");
echo $pone_abono;
?>