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
$fecha=test_input($_POST['fecha']);
$costou=test_input($_POST['costou']);
$proveedor=test_input($_POST['proveedor']);
$descuento=test_input($_POST['descuento']);
if($descuento==""){
  $descuento=0.00;
}
$usuario=test_input($_SESSION['nombre_de_usuario']);
$iva=test_input($_POST['tasa_iva']);
$numero_entrada=test_input($_POST['num_entrada']);
$num_factura=test_input($_POST['num_fact']);

/*registra en el kardex*/
$cadena="Insert into kardex(codigo,cantidad,tipo,fecha,user,costou,preciou,proveedor,descuento_porcentaje,impuesto_porcentaje,serie,numero,fecha_proceso,referencia) values('$codigo',$cantidad,'EC','$fecha','$usuario',$costou,0.00,$proveedor,$descuento,$iva,0,$numero_entrada,'$fecha','$num_factura')";
echo $db->consulta($cadena);

/*actualiza existencias*/
$cadena_update=$db->consulta("Update existencias set cantidad=cantidad+$cantidad where codigo='$codigo'");

/*actualiza costo del articulo en tabla articulos*/
$update=$db->consulta("Update articulos set costo=$costou where codigo='$codigo'");
?>