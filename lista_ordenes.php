<?php
session_start();
if($_SESSION['autorizado']<>1){
    header("Location: index.php");
}
error_reporting(0);
require('class_lib/class_conecta_mysql.php');

$db=new ConexionMySQL();

$cadena="Select * from compras";
$exe=$db->consulta($cadena);
if($db->numero_de_registros($exe)>0){
  echo "<div class='box box-primary'>";
  echo "<div class='box-header'>";
  echo "<h3 class='box-title'>Ordenes de compra registradas.</h3>";
  echo "</div>";
  echo "<div class='box-body'>";
 echo "<table id='tabla_ordenes' class='table table-hover table-condensed'>";
 echo "<thead>";
 echo "<tr>";
 echo "<th>Codigo</th><th>Proveedor</th><th>Fecha Emision</th><th>Fecha de Recepción</th><th>Costo Total</th><th>Detalle</th>";
 echo "</tr>";
 echo "</thead>";
 echo "<tbody>";
 while($e=$db->buscar_array($exe)){
	//buscar nombre proveedor
	$cad = "SELECT nombre FROM proveedores WHERE id = $e[proveedor]";
	$p = $db->buscar_array($db->consulta($cad));
   echo "<tr>";
   echo "<td style='text-align: center;'>".strtoupper($e['referencia'])."</td>";
   echo "<td style='text-align: center;'>".strtoupper($p['nombre'])."</td>";
   echo "<td style='text-align: center;'>".strtoupper($e['emision'])."</td>";
   if(is_null($e['recepcion'])){
	   echo "<td style='text-align: center;'>-</td>";
   }else{
	   echo "<td style='text-align: center;'>$e[recepcion]</td>";
   }
   echo "<td style='text-align: center;'>$".number_format($e['total'],0,',','.')."</td>";
   echo "<td style='text-align: center;'><a href='/imprimir_orden_compra.php?n_orden=$e[referencia]' target='_blank' class='fa fa-file-text'></a></td>";
   echo "</tr>";
 }
 echo "</tbody>";
 echo "</table>";
 echo "</div>";
 echo "</div>";
}else{
 echo "<b>Actualmente no hay ordenes registradas...</b>";
}
?>