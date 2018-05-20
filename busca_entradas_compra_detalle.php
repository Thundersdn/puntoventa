<?php
session_start();
if($_SESSION['autorizado']<>1){
    header("Location: index.php");
}
error_reporting(0);
require('class_lib/class_conecta_mysql.php');
require('class_lib/funciones.php');
$db=new ConexionMySQL();
$entrada=test_input($_POST['entrada']);

$cadena="Select k.user,k.referencia,k.proveedor,k.codigo,k.cantidad,k.costou,k.descuento_porcentaje,k.impuesto_porcentaje,a.descripcion from kardex k, articulos a where k.tipo='EC' and k.numero=$entrada and a.codigo=k.codigo order by k.id";
$exe=$db->consulta($cadena);
if($db->numero_de_registros($exe)>0){
  $monto=0.00;
 echo "<table id='sample-table-4' class='table table-hover table-bordered'>";
 echo "<thead>";
 echo "<tr>";
 echo "<th>Articulo</th><th>Descripcion</th><th>Cantidad</th><th>Costo U.</th><th>Total</th>";
 echo "</tr>";
 echo "</thead>";
 echo "<tbody>";
  while($re=$db->buscar_array($exe)){
   $refer=$re['proveedor'];
   $doc=$re['referencia'];
   $u=$re['user'];
   echo "<tr>";
   echo "<td style='text-align: center;'>".strtoupper($re['codigo'])."</td>";
   echo "<td style='text-align: center;'>".strtoupper($re['descripcion'])."</td>";
   echo "<td style='text-align: center;'>$re[cantidad]</td>";
   echo "<td style='text-align: center;'>$re[costou]</td>";
   $monto += ($re['cantidad']*$re['costou']);
   $descuento=$re['descuento_porcentaje'];
   $iva=$re['impuesto_porcentaje'];
   echo "<td style='text-align: center;'>".number_format($re['costou']*$re['cantidad'],2)."</td>";
   echo "</tr>";
   }
 }
 echo "</tbody>";
 echo "</table>";
 echo "<hr>";
 $monto2=$monto - ($monto*$descuento/100);

 /*busca nombre de proveedor*/
 $busca_name=$db->consulta("Select nombre from proveedores where id=$refer");
 while($yh=$db->buscar_array($busca_name)){
   $el_name=$yh['nombre'];
 }

 echo "<div class='callout callout-success'><b>Resumen de la Entrada por Compra #".$entrada."</b><br>
 <b>Proveedor: </b>".strtoupper($el_name)."<br>
 <b>Numero de Documento Origen: </b>".strtoupper($doc)."<br>
 <b>Monto Total: </b>".number_format($monto,2)."<br>
 <b>Descuento: </b>".$descuento."% = ".number_format($monto*$descuento/100,2)."<br>
 <b>IVA: </b>".$iva."% = ".number_format($monto2*$iva/100,2)."<br>
 <b>Neto: </b>".number_format($monto2+ ($monto2*$iva/100),2)."<br>
 <b>Realizo: </b>".strtoupper($u)."</div>";
?>