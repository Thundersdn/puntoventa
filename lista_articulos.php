<?php
session_start();
if($_SESSION['autorizado']<>1){
    header("Location: index.php");
}
error_reporting(0);
require('class_lib/class_conecta_mysql.php');

$db=new ConexionMySQL();

$cadena="Select * from articulos";
$exe=$db->consulta($cadena);
if($db->numero_de_registros($exe)>0){
  echo "<div class='box box-primary'>";
  echo "<div class='box-header'>";
  echo "<h3 class='box-title'>Articulos registrados.</h3>";
  echo "</div>";
  echo "<div class='box-body'>";
 echo "<table id='tabla_articulos' class='table table-hover table-condensed'>";
 echo "<thead>";
 echo "<tr>";
 echo "<th>Codigo</th><th>Cod. Stock</th><th>Descripcion</th><th>Costo</th><th>Precio</th><th>Prov.</th><th>Lin.</th><th>Gru.</th>";
 echo "</tr>";
 echo "</thead>";
 echo "<tbody>";
 while($e=$db->buscar_array($exe)){
   echo "<tr>";
   echo "<td style='text-align: center;'>".strtoupper($e['codigo'])."</td>";
   echo "<td style='text-align: center;'>".strtoupper($e['codigostock'])."</td>";
   echo "<td style='text-align: center;'>".strtoupper($e['descripcion'])."</td>";
   echo "<td style='text-align: center;'>$e[costo]</td>";
   echo "<td style='text-align: center;'>$e[precio]</td>";
   echo "<td style='text-align: center;'>$e[proveedor]</td>";
   echo "<td style='text-align: center;'>$e[linea]</td>";
   echo "<td style='text-align: center;'>$e[grupo]</td>";
   echo "</tr>";
 }
 echo "</tbody>";
 echo "</table>";
 echo "</div>";
 echo "</div>";
}else{
 echo "<b>Actualmente no hay articulos registrados...</b>";
}
?>