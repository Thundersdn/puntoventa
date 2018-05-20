<?php
session_start();
if($_SESSION['autorizado']<>1){
    header("Location: index.php");
}
error_reporting(0);
require('class_lib/class_conecta_mysql.php');
require('class_lib/funciones.php');
$db=new ConexionMySQL();

$fecha=test_input($_POST['fecha']);
$numero_fact=test_input($_POST['numero_fact']);
$proveedor=test_input(strtoupper($_POST['proveedor']));
$subtotal=test_input($_POST['subtotal']);
if($subtotal==""){
  $subtotal=0.00;
}
$iva=test_input($_POST['iva']);
if($iva==""){
  $iva=0.00;
}
$total=test_input($_POST['total']);
$concepto=test_input(strtoupper($_POST['concepto']));
$user=$_SESSION['nombre_de_usuario'];

if($subtotal>=0 and $iva>=0 and $total>=0){
$registra=$db->consulta("Insert into gastos(fecha,numero_fact,proveedor,subtotal,iva,total,
edo,user,concepto) values('$fecha','$numero_fact','$proveedor',$subtotal,$iva,$total,'ACTIVO',
'$user','$concepto')");
}else{
 echo "error";
}
?>