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

if($id<>"0"){
 $cuentas=$db->consulta("Select distinct k.serie,k.numero,k.fecha,k.referencia,c.nombre from kardex k, clientes c where k.referencia='$id' and k.tipo='STCR' and c.id=k.referencia order by k.id desc");
 if($db->numero_de_registros($cuentas)>0){
   echo "<div class='box box-primary print4'>";
   echo "<div class='box-header with-border aqui'>";
   echo "<h4>Resumen del Cliente.</h4>";
   echo "</div>";
   echo "<div class='box-body'>";
   echo "<table class='table table-bordered table-hover' id='tabla_cliente_cartera'>";
   echo "<thead>";
   echo "<tr>";
   echo "<th>Cliente</th>";
   echo "<th>Fecha de Comp.</th>";
   echo "<th>No. Ticket</th>";
   echo "<th>Monto</th>";
   echo "<th>Abonado</th>";
   echo "<th>Saldo</th>";
   echo "<th>Oper.</th>";
   echo "</tr>";
   echo "</thead>";
   echo "<tbody>";
    while($tr=$db->buscar_array($cuentas)){
      $elid="";
      /*verfica si no hay una cancelacion de ticket*/
      echo "<tr>";
      echo "<td>".$tr['nombre']."</td>";
      echo "<td>".$tr['fecha']."</td>";
      $elid=$tr['referencia']."|".$tr['nombre'];
      /*busca si el ticket esta cancelado*/
      $busca_cancelacion=$db->consulta("Select * from kardex where serie=$tr[serie] and numero=$tr[numero] and tipo='CT'");
      if($db->numero_de_registros($busca_cancelacion)>0){
        $cancelado=1;
      echo "<td>".$tr['serie']."-".$tr['numero']."  "."<span class='label label-danger'>CANCELADO</span>"."</td>";
      }else{
        $cancelado=0;
      echo "<td>".$tr['serie']."-".$tr['numero']."</td>";
      }
      $elid=$elid."|".$tr['serie']."|".$tr['numero'];
      /*busca todo y suma los articulos del ticket*/
       $busca_compra=$db->consulta("Select sum(cantidad*preciou) as total_ticket from kardex where serie=$tr[serie] and numero=$tr[numero] and tipo='STCR'");
       while($hy=$db->buscar_array($busca_compra)){
        $t1=$hy['total_ticket'];
       echo "<td>".number_format($hy['total_ticket'],2)."</td>";
        $elid=$elid."|".number_format($hy['total_ticket'],2);
       }

       /*busca los abonos realizados a ese ticket*/
       $busca_abonos=$db->consulta("Select sum(preciou) as abonado from kardex where serie=$tr[serie] and numero=$tr[numero] and tipo='ABO'");
       if($db->numero_de_registros($busca_abonos)>0){
       while($hx=$db->buscar_array($busca_abonos)){
         $t2=$hx['abonado'];
         $elid=$elid."|".number_format($hx['abonado'],2);
       echo "<td>".number_format($hx['abonado'],2)."</td>";
        }
       }else{
       echo "<td>0.00</td>";
       }

       if($cancelado==0){
       echo "<td>".number_format($t1-$t2,2)."</td>";
       }else{
       echo "<td><span class='label label-danger'>CANCELADO</span></td>";
       }
       /*botones de operaciones del ticket*/
       if($cancelado==0){
       echo "<td><button id='".$elid."' class='btn btn-xs btn-primary' title='Ver pagos realizados...' onclick='revisa_pagos(this.id);'><i class='fa fa-search'></i></button>
             <button id='".$elid."' class='btn btn-xs btn-warning' title='Realizar un abono...' onclick='abona_ticket(this.id);'><i class='fa fa-arrow-circle-right'></i></button> </td>";
        }else{
          echo "<td><button class='btn btn-xs btn-primary' title='Mostrar detalles del ticket...'><i class='fa fa-search'></i></button>
             <button class='btn btn-xs btn-warning' title='Realizar un abono...' disabled><i class='fa fa-arrow-circle-right'></i></button> </td>";
        }

    }

   echo '</tbody>';
   echo "</table>";
   echo "</div>";
   echo "</div>";
 }else{
   echo "<div class='callout callout-danger'>No se encontraron registros de credito del cliente...</div>";
 }
}
?>