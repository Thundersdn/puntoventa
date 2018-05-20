<?php
session_start();
if($_SESSION['autorizado']<>1){
    header("Location: index.php");
}
error_reporting(0);
require("class_lib/class_conecta_mysql.php");
$db=new ConexionMySQL(); 
require("class_lib/funciones.php");

$serie1=test_input($_POST['serie_c']);
$numero1=test_input($_POST['numero_t']);
$monto1=0.00;

$cadena2="Select tipo,fecha,serie,cantidad,preciou,numero,referencia from kardex where (tipo='STCO' or tipo='STCR') and serie=$serie1 and numero=$numero1 and tipo<>'CT'";
$exec2=$db->consulta($cadena2);
if($db->numero_de_registros($exec2)>0){
   echo "<div class='box box-danger'>";
  echo "<div class='box-header with-border'>";
  echo "<h4 class='box-title'>Ventas realizadas...</h4>";
  echo "</div>";
  echo "<div class='box-body'>";
   echo "<table id='tabla_ventas' class='table table-bordered table-hover'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>Fecha</th>";
    echo "<th># Ticket</th>";
    echo "<th>Monto</th>";
    echo "<th>Status</th>";
    echo "<th>Tipo</th>";
    echo "<th>Operacion</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
   while($dato=$db->buscar_array($exec2)){
      $fecha=$dato['fecha'];
      $s=$dato['serie'];
      $n=$dato['numero'];
      $elid=$s."|".$n;
      $monto1=$monto1 + ($dato['cantidad']*$dato['preciou']);
      $cliente=$dato['referencia'];
      $tipo=$dato['tipo'];
   }
   echo "<tr>";
   echo "<td>".$fecha."</td>";
   echo "<td>".$s."-".$n."</td>";
   echo "<td>".number_format($monto1,2)."</td>";


    $busca_cancelacion=$db->consulta("Select id from kardex where serie=$serie1 and numero=$numero1 and tipo='CT'");
     if($db->numero_de_registros($busca_cancelacion)>0){
       echo "<td><span class='label label-danger'>CANCELADO</span></td>";
     }else{
       echo "<td><span class='label label-warning'>ACTIVA</span></td>";
     }

     if($tipo=='STCR'){
        $busca_cliente=$db->consulta("Select nombre from clientes where id=$cliente");
        while($cl=$db->buscar_array($busca_cliente)){
          $nombre_cliente=$cl['nombre'];
        }
       echo "<td><span class='label label-primary'>Credito | Cliente: ".$nombre_cliente."</span></td>";
     }else{
       if($tipo=='STCO'){
        echo "<td><span class='label label-success'>Contado</span></td>";
       }
     }

     if($db->numero_de_registros($busca_cancelacion)>0){
       echo "<td><button class='btn btn-xs btn-primary confirmacion' id='".$elid."' onclick='muestra_detalle(this.id);'><i class='fa fa-search'></i> Detalles.</button></td>";
      }else{
     echo "<td><button class='btn btn-xs btn-danger confirmacion' id='".$elid."' onclick='cancela_ticket(this.id);'><i class='fa fa-times'></i> Cancelar.</button>
           <button class='btn btn-xs btn-primary confirmacion' id='".$elid."' onclick='muestra_detalle(this.id);'><i class='fa fa-search'></i> Detalles.</button
           </td>";
       }
   echo "</tr>";
   echo "</tbody>";
   echo "</table>";
  echo "</div>";
  echo "</div>";

  }else{
   echo "<div class='callout callout-danger'>No se encontraron registros de ventas...</div>";
}
$db->DesconectaServer();
?>