<?php
session_start();
if($_SESSION['autorizado']<>1){
    header("Location: index.php");
}
error_reporting(E_ALL);
require('class_lib/class_conecta_mysql.php');
require('class_lib/funciones.php');
$db=new ConexionMySQL();

$codigo=test_input($_POST['codigo']);
$cantidad=test_input($_POST['cantidad']);
$fecha=test_input($_POST['fecha']);
$costou=test_input($_POST['costou']);
$proveedor=test_input($_POST['proveedor']);
$descuento=test_input($_POST['descuento']);
if($descuento==""){
  $descuento=0.00;
}
$usuario=test_input($_SESSION['nombre_de_usuario']);
$iva=test_input($_POST['tasa_iva']);
$numero_entrada=test_input($_POST['num_orden']);
$num_factura=test_input($_POST['num_fact']);
//$total = test_input($_POST['total']);
/*
error_log("codigo=$codigo 
cantidad=$cantidad
fecha=$fecha
costou=$costou
proveedor=$proveedor
descuento=$descuento");*/
/*registra en el kardex*/
$cadena="INSERT INTO kardex (codigo,cantidad,tipo,fecha,user,costou,preciou,proveedor,descuento_porcentaje,impuesto_porcentaje,serie,numero,fecha_proceso,referencia) VALUES($codigo,$cantidad,'OC','$fecha','$usuario',$costou,0,$proveedor,$descuento,$iva,0,$numero_entrada,'$fecha',$num_factura)  ";
//error_log("$cadena");
echo $db->consulta($cadena);

/* registrar en compras si no existe entrada */
/*
$revisar = "SELECT * from compras where referencia = $num_factura";
$res = $db->consulta($cadena);
if($db->numero_de_registros($res) == 0){
	$cadena="INSERT INTO compras (proveedor, emision, total, referencia) VALUES($proveedor,'$fecha',$total,$num_factura)";
	//error_log("$cadena");
	$db->consulta($cadena);
}
*/
/*actualiza existencias*/
//$cadena_update=$db->consulta("Update existencias set cantidad=cantidad+$cantidad where codigo='$codigo'");

/*actualiza costo del articulo en tabla articulos*/
//$update=$db->consulta("Update articulos set costo=$costou where codigo='$codigo'");
?>