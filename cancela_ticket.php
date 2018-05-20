<?php
session_start();
if($_SESSION['autorizado']<>1){
    header("Location: index.php");
}
error_reporting(0);
require("class_lib/class_conecta_mysql.php");
require("class_lib/funciones.php");

$db= new ConexionMySQL();
$serie=test_input($_POST['serie']);
$numero=test_input($_POST['numero']);
$user=test_input($_SESSION['nombre_de_usuario']);

$revisa=$db->consulta("Select * from kardex where serie=$serie and numero=$numero and tipo='CT'");
if($db->numero_de_registros($revisa)>0){
  }else{
$busca_articulos=$db->consulta("Select * from kardex where serie=$serie and numero=$numero");
while($data=$db->buscar_array($busca_articulos)){
  $articulo=$data['codigo'];
  $cantidad=$data['cantidad'];
  $costou=$data['costou'];
  $preciou=$data['preciou'];
  $cliente=$data['referencia'];
  $cancela=$db->consulta("Insert into kardex(codigo,cantidad,tipo,fecha,user,costou,preciou,
proveedor,descuento_porcentaje,impuesto_porcentaje,serie,numero,fecha_proceso,referencia,
referencia1,referencia2) values('$articulo',$cantidad,'CT',now(),'$user',$costou,$preciou,
0,0.00,0.00,$serie,$numero,now(),'$cliente','','')");
  $ajusta_existencias=$db->consulta("Update existencias set cantidad=cantidad + $cantidad where codigo='$articulo'");
 }
}
?>