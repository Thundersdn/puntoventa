<?php
session_start();
if($_SESSION['autorizado']<>1){
    header("Location: index.php");
}
error_reporting(0);
require('class_lib/class_conecta_mysql.php');
require('class_lib/funciones.php');
$db=new ConexionMySQL();
$id=test_input($_POST['idcliente']);
$serie=test_input($_POST['serie']);
$numero=test_input($_POST['numero']);
$tabonos=0.00;
$cabonos=0;
$nombre_cliente=$db->consulta("Select nombre from clientes where id=$id");
while($hy=$db->buscar_array($nombre_cliente)){
  $cliente=$hy['nombre'];
}

 $cuentas=$db->consulta("Select * from kardex where tipo='ABO' and serie=$serie and numero=$numero and referencia='$id'");
 if($db->numero_de_registros($cuentas)>0){
   echo "<div class='box box-primary print_abonos'>";
   echo "<div class='box-header with-border aqui'>";
   echo "<h4>Pagos registrados | Cliente: ".$cliente." | No. Ticket: ".$serie."-".$numero."</h4>";
   echo "</div>";
   echo "<div class='box-body'>";
   echo "<table class='table table-bordered table-hover' id='tabla_cliente_pagos'>";
   echo "<thead>";
   echo "<tr>";
   echo "<th>Fecha</th>";
   echo "<th>Monto.</th>";
   echo "<th>No. Ticket</th>";
   echo "<th>Realizo</th>";
   echo "</tr>";
   echo "</thead>";
   echo "<tbody>";
    while($tr=$db->buscar_array($cuentas)){
      echo "<tr>";
      $tabonos+=$tr['preciou'];
      $cabonos++;
      echo "<td>".$tr['fecha']."</td>";
      echo "<td>".number_format($tr['preciou'],2)."</td>";
      echo "<td>".$tr['serie']."-".$tr['numero']."</td>";
      echo "<td>".$tr['user']."</td>";
      echo "</tr>";
    }
   echo "<tr>";
   echo "<td><b>TOTALES<b></td>";
    echo "<td><b>".number_format($tabonos,2)."</b></td>";
   echo "<td><b>".$cabonos." Pagos"."</b></td>";
   echo "<td></td>";
   echo "</tr>";
   echo '</tbody>';
   echo "</table>";
   echo "</div>";
   echo "</div>";
 }else{
   echo "<div class='callout callout-danger'>No se encontraron registros de abonos de este cliente...</div>";
 }

?>