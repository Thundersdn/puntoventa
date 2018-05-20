<?php
session_start();
if($_SESSION['autorizado']<>1){
    header("Location: index.php");
}
error_reporting(0);
require('class_lib/class_conecta_mysql.php');

$db=new ConexionMySQL();
$fechaa = date('Y-m-d');
/*******************************************************************/
$nueva_fecha = strtotime('+15 day', strtotime($fechaa));
$nueva_fecha = date('Y-m-d', $nueva_fecha);
/******************************************************************/
$cadena="Select a.codigo,a.descripcion,e.cantidad,a.fecha_cad from articulos a, existencias e where e.cantidad>0 and a.fecha_cad<='$nueva_fecha' and a.codigo=e.codigo";
$exe=$db->consulta($cadena);
if($db->numero_de_registros($exe)>0){
 echo "<div class='box'>";
 echo "<div class='box-header'>";
 echo "<h3 class='box-title'>Productos Para Vencer...</h3>";
 echo "</div>";echo "<div class='box-body'>";
 echo "<table id='tabla_de_Caducar' class='table table-bordered table-striped table-hover'>";
 echo "<thead>";
 echo "<tr>";
 echo "<th>Codigo</th><th>Descripcion</th><th>Cantidad</th><th>Fecha de Caducidad</th>";
 echo "</tr>";
 echo "</thead>";
 echo "<tbody>";
 while($e=$db->buscar_array($exe)){
   echo "<tr>";
   echo "<td style='text-align: center;'>$e[codigo]</td>";
   echo "<td style='text-align: center;'>$e[descripcion]</td>";
   echo "<td style='text-align: center;'>$e[cantidad]</td>";
   echo "<td style='text-align: center;'>$e[fecha_cad]</td>";
   echo "</tr>";
 }
 echo "</tbody>";
 echo "</table>";
 echo "</div>";
 echo "</div>";
}else{
 echo "Actualmente no hay Productos Para Vencer...";
}
?>
