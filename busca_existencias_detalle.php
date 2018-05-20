<?php
session_start();
if($_SESSION['autorizado']<>1){
    header("Location: index.php");
}
error_reporting(0);
require("class_lib/class_conecta_mysql.php");
require("class_lib/funciones.php");
$db= new ConexionMySQL();
$fecha=test_input($_POST['fecha']);
$linea=test_input($_POST['linea']);
$grupo=test_input($_POST['grupo']);
$cantidades=0.00;
$montos=0.00;
$date= date('Y-m-d');

if($fecha>=$date){
if($grupo=='0'){
  $cadena="Select a.codigo,a.descripcion,a.costo,e.cantidad from articulos a, existencias e
  where a.linea=$linea and a.codigo=e.codigo";
}else{
  $cadena="Select a.codigo,a.descripcion,a.costo,e.cantidad from articulos a, existencias e
  where a.linea=$linea and a.grupo=$grupo and a.codigo=e.codigo";
}
$exec=$db->consulta($cadena);
if($db->numero_de_registros($exec)>0){
echo "<table class='table table-bordered table-hover'>";
echo "<thead>";
echo "<tr>";
echo "<th>Codigo</th>";
echo "<th>Descripcion</th>";
echo "<th>Cantidad</th>";
echo "<th>Costo U.</th>";
echo "<th>Costo T.</th>";
echo "</tr>";
echo "</thead>";
echo "<tbody>";
 while($d=$db->buscar_array($exec)){
    echo "<tr>";
    echo "<td>".strtoupper($d['codigo'])."</td>";
    echo "<td>".strtoupper($d['descripcion'])."</td>";
    $cantidades+=$d['cantidad'];
    echo "<td>".$d['cantidad']."</td>";
    $montos+=($d['costo'] * $d['cantidad']);
    echo "<td>".$d['costo']."</td>";
    echo "<td>".number_format($d['cantidad'] * $d['costo'],2)."</td>";
    echo "</tr>";
 }
echo "<tr><td></td>
          <td><b>TOTALES</b></td>
          <td><b>".number_format($cantidades,2)."</b></td>
          <td></td>
          <td><b>".number_format($montos,2)."</b></td></tr>";
echo "</tbody>";
echo "</table>";
}else{
  echo "<div class='callout callout-danger'>No se encontraron registros...</div>";
}
}

/*si la fecha es menor que la actual calcula en base al kardex*/
if($fecha<$date){
if($grupo=='0'){
  $cadena="Select codigo,descripcion,costo from articulos where linea=$linea";
}else{
  $cadena="Select codigo,descripcion,costo from articulos where linea=$linea and grupo=$grupo";
}
$exec=$db->consulta($cadena);
if($db->numero_de_registros($exec)>0){
echo "<table class='table table-bordered table-hover'>";
echo "<thead>";
echo "<tr>";
echo "<th>Codigo</th>";
echo "<th>Descripcion</th>";
echo "<th>Cantidad</th>";
echo "<th>Costo U.</th>";
echo "<th>Costo T.</th>";
echo "</tr>";
echo "</thead>";
echo "<tbody>";
 while($d=$db->buscar_array($exec)){
    echo "<tr>";
    $articulo=$d['codigo'];
    echo "<td>".strtoupper($articulo)."</td>";
    echo "<td>".strtoupper($d['descripcion'])."</td>";
     /*busca por articulo en el kardex*/
     $exec2=$db->consulta("Select tipo,cantidad from kardex where codigo='$articulo' and fecha<='$fecha'");
     while($data=$db->buscar_array($exec2)){
    if($data['tipo']=='EC' || $data['tipo']=='A' || $data['tipo']=='CT'){
      $tot+=$data['cantidad'];
      $cantidades+=$data['cantidad'];
      $montos+=($d['costo'] * $data['cantidad']);
      $montoss+=($d['costo'] * $data['cantidad']);
     }
    if($data['tipo']=='STCR' || $data['tipo']=='STCO' || $data['tipo']=='DP' || $data['tipo']=='A-'){
      $tot-=$data['cantidad'];
      $cantidades-=$data['cantidad'];
      $montos-=($d['costo'] * $data['cantidad']);
      $montoss-=($d['costo'] * $data['cantidad']);
     }
    }
    echo "<td>".number_format($tot,2)."</td>";
    echo "<td>".$d['costo']."</td>";
    echo "<td>".number_format($tot * $d['costo'],2)."</td>";
    echo "</tr>";
    $tot=0.00;
    $montos=0.00;
 }
echo "<tr><td></td>
          <td><b>TOTALES</b></td>
          <td><b>".number_format($cantidades,2)."</b></td>
          <td></td>
          <td><b>".number_format($montoss,2)."</b></td></tr>";
echo "</tbody>";
echo "</table>";
}else{
  echo "<div class='callout callout-danger'>No se encontraron registros...</div>";
}
}
?>