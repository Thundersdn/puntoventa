<?php
session_start();
if($_SESSION['autorizado']<>1){
    header("Location: index.php");
}
error_reporting(0);
require('class_lib/class_conecta_mysql.php');
require('class_lib/funciones.php');
$db=new ConexionMySQL();
$fecha=test_input($_POST['fechai']);
$fechaf=test_input($_POST['fechaf']);

$cadena="Select distinct numero from kardex where (tipo='EC' or tipo='DP') and fecha>='$fecha' and fecha<='$fechaf' order by numero";
$exe=$db->consulta($cadena);
if($db->numero_de_registros($exe)>0){
  echo "<div class='box box-primary'>";
 echo "<div class='box-header with-border'>";
 echo "<h3 class='box-title'>Entradas registradas.</h3>";
 echo "</div>";
 echo "<div class='box-body'>";
 echo "<table id='tabla' class='table table-bordered table-striped dataTable'>";
 echo "<thead>";
 echo "<tr>";
 echo "<th>#Entrada</th><th>#Fecha</th><th>Proveedor</th><th>Monto</th><th>Descuento</th><th>IVA</th><th>Realizo</th><th>Tipo</th><th>Detalles</th>";
 echo "</tr>";
 echo "</thead>";
 echo "<tbody>";
 while($ww=$db->buscar_array($exe)){
     $numero=$ww['numero'];
     $monto=0.00;
     $consulta_resumen=$db->consulta("Select k.fecha,k.tipo,k.numero,k.user,k.proveedor,k.costou,k.cantidad,k.descuento_porcentaje,k.impuesto_porcentaje,p.nombre from kardex k, proveedores p
     where k.numero=$numero and k.proveedor=p.id");
      while($datas=$db->buscar_array($consulta_resumen)){
          $entrada=$datas['numero'];
          $prov=$datas['nombre'];
          $monto=$monto + ($datas['costou'] * $datas['cantidad']);
          $descuento=$datas['descuento_porcentaje'];
          $iva=$datas['impuesto_porcentaje'];
          $user=$datas['user'];
          $tipo=$datas['tipo'];
          $fecha=$datas['fecha'];
      }
   echo "<tr>";
   echo "<td style='text-align: center;'>$entrada</td>";
   echo "<td style='text-align: center;'>$fecha</td>";
   echo "<td style='text-align: center;'>$prov</td>";
   echo "<td style='text-align: center;'>".number_format($monto,2)."</td>";
   echo "<td style='text-align: center;'>".$descuento."%=".number_format($monto*($descuento/100),2)."</td>";
   echo "<td style='text-align: center;'>".$iva."%"."</td>";
   echo "<td style='text-align: center;'>$user</td>";
   echo "<td style='text-align: center;'>$tipo</td>";
   echo "<td style='text-align: center;'><a href='#modal_tabla' data-toggle='modal'><button type='button' class='btn btn-mini btn-danger' id=$entrada onclick='detalla_entrada(this.id);'><i class='fa fa-search'></i> Detalles</button></a></td>";
   echo "</tr>";
 }
 echo "</tbody>";
 echo "</table>";
 echo "</div>";
 echo "</div>";
}else{
  echo "<div class='callout callout-danger'><b>No se encontraron entradas por compras en las fechas indicadas...</b></div>";
}
?>