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
$cantidad=test_input($_POST['cantidad']);
$preciou=test_input($_POST['preciou']);
$usuario=test_input($_SESSION['nombre_de_usuario']);
$credito=test_input($_POST['credito']);
$clienteid=test_input($_POST['clienteid']);
$caja=test_input($_POST['caja']);
$busca_costo=$db->consulta("Select costo from articulos where codigo='$codigo'");
while($y=$db->buscar_array($busca_costo)){
   $costo_articulo=$y['costo'];
}

if($caja=='1'){
$busca_numero_ticket=$db->consulta("Select caja1 as numero from parametros");
}
if($caja=='2'){
$busca_numero_ticket=$db->consulta("Select caja2 as numero from parametros");
}
if($caja=='3'){
$busca_numero_ticket=$db->consulta("Select caja3 as numero from parametros");
}
if($caja=='4'){
$busca_numero_ticket=$db->consulta("Select caja4 as numero from parametros");
}
while($x=$db->buscar_array($busca_numero_ticket)){
   $numero_ticket=$x['numero']+1;
}

if($credito=='0'){
$cadena_insert=$db->consulta("Insert into kardex(codigo,cantidad,tipo,fecha,user,costou,preciou,proveedor,descuento_porcentaje,impuesto_porcentaje,serie,numero,fecha_proceso,referencia,referencia1,referencia2) values(
'$codigo',$cantidad,'STCO',now(),'$usuario',$costo_articulo,$preciou,0,0.00,0.00,$caja,$numero_ticket,now(),'','','')");
}
if($credito=='1'){
$cadena_insert=$db->consulta("Insert into kardex(codigo,cantidad,tipo,fecha,user,costou,preciou,proveedor,descuento_porcentaje,impuesto_porcentaje,serie,numero,fecha_proceso,referencia,referencia1,referencia2) values(
'$codigo',$cantidad,'STCR',now(),'$usuario',$costo_articulo,$preciou,0,0.00,0.00,$caja,$numero_ticket,now(),'$clienteid','','')");
}

$cadena_update=$db->consulta("Update existencias set cantidad=cantidad-$cantidad where codigo='$codigo'");

?>