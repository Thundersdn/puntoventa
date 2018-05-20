<?php
session_start();
if($_SESSION['autorizado']<>1){
    header("Location: index.php");
}
error_reporting(0);
require('class_lib/class_conecta_mysql.php');

$db=new ConexionMySQL();

$cadena="Select linea,grupo,descripcion, marca_eliminada from lineas order by linea+grupo";
$exe=$db->consulta($cadena);
if($db->numero_de_registros($exe)>0){
  echo "<div class='box'>";
  echo "<div class='box-header'>";
  echo "<h3 class='box-title'>Lineas registradas...</h3>";
  echo "</div>";
  echo "<div class='box-body'>";
 echo "<table id='tabla_de_lineas' class='table table-bordered table-striped table-hover'>";
 echo "<thead>";
 echo "<tr>";
 echo "<th>Linea</th><th>Grupo</th><th>Descripcion</th>";
 echo "</tr>";
 echo "</thead>";
 echo "<tbody>";
 while($e=$db->buscar_array($exe)){
   echo "<tr>";
   echo "<td style='text-align: center;'>$e[linea]</td>";
   echo "<td style='text-align: center;'>$e[grupo]</td>";
   echo "<td style='text-align: center;'>$e[descripcion]</td>";
   echo "</tr>";
 }
 echo "</tbody>";
 echo "</table>";
 echo "</div>";
 echo "</div>";
}else{
 echo "Actualmente no hay Lineas registradas...";
}
?>
