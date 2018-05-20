<?php
session_start();
if($_SESSION['autorizado']<>1){
    header("Location: index.php");
}
error_reporting(0);
require('class_lib/class_conecta_mysql.php');
require('class_lib/funciones.php');
$db=new ConexionMySQL();
$fechai=test_input($_POST['fechai']);
$fechaf=test_input($_POST['fechaf']);

$busca=$db->consulta("Select * from gastos where fecha>='$fechai' and fecha<='$fechaf'");
if($db->numero_de_registros($busca)>0){
  echo "<div class='box box-primary print7'>";
  echo "<div class='box-header with-border'>";
  echo "<h4 class='box-title aqui '></h4>";
  echo "</div>";
  echo "<div class='box-body'>";
  echo "<table class='table table-hover table-responsive' id='gastos_registrados'>";
     echo "<thead>";
     echo "<tr>";
     echo "<th>Fecha</th>";
     echo "<th>Proveedor</th>";
     echo "<th>Subtotal</th>";
     echo "<th>IVA</th>";
     echo "<th>Total</th>";
     echo "<th>Edo.</th>";
     echo "<th class='no-print'>Op.</th>";
     echo "</tr>";
     echo "<tbody>";
    while($re=$db->buscar_array($busca)){
      echo "<tr>";
      echo "<td>".$re['fecha']."</td>";
      echo "<td>".$re['proveedor']."</td>";
      echo "<td>".$re['subtotal']."</td>";
      echo "<td>".$re['iva']."</td>";
      echo "<td>".$re['total']."</td>";
      if($re['edo']=='CANCELADO'){
      echo "<td>".$re['edo']."-".strtoupper($re['user_cancela'])."</td>";
       echo "<td><button class='btn btn-xs btn-danger no-print' id='".$re['id']."' onclick='' disabled><i class='fa fa-trash'></i></button></td>";
       echo "<td><button class='btn btn-xs btn-primary no-print' id='".$re['id']."' onclick='detalla_gasto(this.id);'><i class='fa fa-search'></i></button></td>";
      }else{
      echo "<td>".$re['edo']."</td>";
       echo "<td><button class='btn btn-xs btn-danger no-print' id='".$re['id']."' onclick='delete_gasto(this.id);'><i class='fa fa-trash'></i></button></td>";
       echo "<td><button class='btn btn-xs btn-primary no-print' id='".$re['id']."' onclick='detalla_gasto(this.id);'><i class='fa fa-search'></i></button></td>";
      }
       echo "</tr>";
    }
   echo "</tbody>";
   echo "</table>";
  echo "</div>";
  echo "</div>";
}else{
  echo "<div class='callout callout-danger'>No hay gastos registrados en este rango de fechas...</div>";
}
?>