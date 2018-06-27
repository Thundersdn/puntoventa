<?php
session_start();
if($_SESSION['autorizado']<>1){
    header("Location: index.php");
}
error_reporting(0);
require('class_lib/class_conecta_mysql.php');

$db=new ConexionMySQL();

$cadena="Select existencias.codigo, articulos.descripcion, existencias.cantidad, existencias.stock_min from articulos, existencias where existencias.cantidad <= existencias.stock_min AND existencias.codigo = articulos.codigostock";

$exe=$db->consulta($cadena);
if($db->numero_de_registros($exe)>0){
 echo "<div class='box'>";
 echo "<div class='box-header'>";
 echo "<h3 class='box-title'>Productos Con Stock Minimo</h3>";
 echo "</div>";echo "<div class='box-body'>";
 echo "<table id='tabla_de_Reponer' class='table table-bordered table-striped table-hover'>";
 echo "<thead>";
 echo "<tr>";
 echo "<th>Codigo</th><th>Descripcion</th><th>Cantidad</th><th>Stock Minimo</th>";
 echo "</tr>";
 echo "</thead>";
 echo "<tbody>";
 while($e=$db->buscar_array_assoc($exe)){
   echo "<tr>";
   echo "<td style='text-align: center;'>$e[codigo]</td>";
   echo "<td style='text-align: center;'>$e[descripcion]</td>";
   echo "<td style='text-align: center;'>$e[cantidad]</td>";
   echo "<td style='text-align: center;'>$e[stock_min]</td>";
   echo "</tr>";
 }
 echo "</tbody>";
 echo "</table>";
 echo "</div>";
 echo "</div>";
}else{
 echo "Actualmente no hay productos con stock minimo.";
}
?>