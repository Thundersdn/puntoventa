<?php
session_start();
if($_SESSION['autorizado']<>1){
    header("Location: index.php");
}
error_reporting(E_ALL);
require('class_lib/class_conecta_mysql.php');
require('class_lib/funciones.php');
$db=new ConexionMySQL();

$fecha=test_input($_POST['fecha']);
$proveedor=test_input($_POST['proveedor']);
$num_factura=test_input($_POST['num_fact']);
$total = test_input($_POST['total']);

$cadena="INSERT INTO compras (proveedor, emision, total, referencia) VALUES($proveedor,'$fecha',$total,$num_factura)";
	//error_log("$cadena");
echo $db->consulta($cadena);

?>