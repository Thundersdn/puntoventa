<?php
session_start();
if($_SESSION['autorizado']<>1){
    header("Location: index.php");
}
error_reporting(0);
require('class_lib/class_conecta_mysql.php');
require('class_lib/funciones.php');
$data = array();
$db= new ConexionMySQL();
$fechaa = date('Y-m-d');
/*aqui cambias el numero de dias que quieres agregar a nueva_fecha*/
$nueva_fecha = strtotime('+15 day', strtotime($fechaa));
$nueva_fecha = date('Y-m-d', $nueva_fecha);
/*******************************************************************/
$revisa = $db->consulta("Select a.codigo,a.descripcion,e.cantidad,a.fecha_cad from articulos a, existencias e where e.cantidad>0 and a.fecha_cad<='$nueva_fecha' and a.codigo=e.codigo");
if($db->numero_de_registros($revisa)>0){
   while($ww=$db->buscar_array($revisa)){
      array_push($data, $ww);
   }
}
print json_encode($data);

$db->DesconectaServer();
?>