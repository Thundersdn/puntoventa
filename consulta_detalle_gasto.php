<?php
session_start();
if($_SESSION['autorizado']<>1){
    header("Location: index.php");
}
error_reporting(0);
require('class_lib/class_conecta_mysql.php');
require('class_lib/funciones.php');
$db=new ConexionMySQL();
$id=test_input($_POST['id_gasto']);
$c=$db->consulta("Select * from gastos where id=$id");

while($rr=$db->buscar_array($c)){
  $edo=$rr['edo'];
  echo "<div class='callout callout-success'><b>Concepto del gasto:</b><br>".strtoupper($rr['concepto'])."</div>";
  if($edo=='CANCELADO'){
  echo "<div class='callout callout-danger'><b>El gasto fue cancelado por:</b><br> ".strtoupper($rr['user_cancela'])."</div>";
  }
}

?>