<?php
session_start();
if($_SESSION['autorizado']<>1){
    header("Location: index.php");
}
error_reporting(0);
require("class_lib/class_conecta_mysql.php");
require("class_lib/funciones.php");
$db= new ConexionMySQL();
$fechai=test_input($_POST['fechai']);
$fechaf=test_input($_POST['fechaf']);
$linea=test_input($_POST['linea']);
$ca=test_input($_POST['caja']);

if($ca=='0'){
$rrr="Select k.tipo,k.codigo,a.descripcion,k.costou,k.preciou,k.cantidad from kardex k, articulos a where  k.fecha>='$fechai' and k.fecha<='$fechaf' and
(k.tipo='STCR' or k.tipo='STCO' or k.tipo='CT') and k.codigo=a.codigo and a.linea=$linea";
}
if($ca=='1'){
$rrr="Select k.tipo,k.codigo,a.descripcion,k.costou,k.preciou,k.cantidad from kardex k, articulos a where  k.fecha>='$fechai' and k.fecha<='$fechaf' and
(k.tipo='STCR' or k.tipo='STCO' or k.tipo='CT') and k.codigo=a.codigo and a.linea=$linea and k.serie=1";
}
if($ca=='2'){
$rrr="Select k.tipo,k.codigo,a.descripcion,k.costou,k.preciou,k.cantidad from kardex k, articulos a where  k.fecha>='$fechai' and k.fecha<='$fechaf' and
(k.tipo='STCR' or k.tipo='STCO' or k.tipo='CT') and k.codigo=a.codigo and a.linea=$linea and k.serie=2";
}
if($ca=='3'){
$rrr="Select k.tipo,k.codigo,a.descripcion,k.costou,k.preciou,k.cantidad from kardex k, articulos a where  k.fecha>='$fechai' and k.fecha<='$fechaf' and
(k.tipo='STCR' or k.tipo='STCO' or k.tipo='CT') and k.codigo=a.codigo and a.linea=$linea and k.serie=3";
}
if($ca=='4'){
$rrr="Select k.tipo,k.codigo,a.descripcion,k.costou,k.preciou,k.cantidad from kardex k, articulos a where  k.fecha>='$fechai' and k.fecha<='$fechaf' and
(k.tipo='STCR' or k.tipo='STCO' or k.tipo='CT') and k.codigo=a.codigo and a.linea=$linea and k.serie=4";
}
$busca_v=$db->consulta($rrr);

if($db->numero_de_registros($busca_v)>0){
  /*dibuja y llena la tabla*/
     echo "<div class='box box-primary print5'>";
     echo "<div class='box-header with-border'>";
     echo "<h4 class='box-title aqui'></h4>";
     echo "</div>";
     echo "<div class='box-body no-padding'>";
     echo "<table class='table table-condensed' id='ventas_lineas_xx'>";
     echo "<thead>";
     echo "<tr>";
     echo "<th>Codigo</th>";
     echo "<th>Descripcion</th>";
     echo "<th>Costo U.</th>";
     echo "<th>Precio u.</th>";
     echo "<th>Cant.</th>";
     echo "<th>Costo T.</th>";
     echo "<th>Monto T.</th>";
     echo "<th>Edo.</th>";
     echo "</tr>";
     echo "<tbody>";
     while($cd=$db->buscar_array($busca_v)){
       echo "<tr>";
       echo "<td>".strtoupper($cd['codigo'])."</td>";
       echo "<td>".strtoupper($cd['descripcion'])."</td>";
       echo "<td>".number_format($cd['costou'],2)."</td>";
       echo "<td>".number_format($cd['preciou'],2)."</td>";
       echo "<td>".number_format($cd['cantidad'],2)."</td>";
       echo "<td>".number_format($cd['cantidad']*$cd['costou'],2)."</td>";
       echo "<td>".number_format($cd['cantidad']*$cd['preciou'],2)."</td>";
       if($cd['tipo']=='CT'){
         echo "<td>CANCELADO</td>";
       }
       if($cd['tipo']=='STCR'){
         echo "<td>CREDITO</td>";
       }
       if($cd['tipo']=='STCO'){
         echo "<td>CONTADO</td>";
       }
       echo "</tr>";
     }
    echo "</tbody>";
    echo "</table>";
    echo "</div>";
    echo "</div>";
}else{
  echo "<div class='callout callout-danger'>No hay regsitros de ventas...</div>";
}
?>