<?php
session_start();
if($_SESSION['autorizado']<>1){
    header("Location: index.php");
}
error_reporting(0);
require("class_lib/class_conecta_mysql.php");
$db=new ConexionMySQL(); 
require("class_lib/funciones.php");

$fi=test_input($_POST['fechai']);
$ff=test_input($_POST['fechaf']);
$caja=test_input($_POST['caja']);
$tipo=test_input($_POST['tipo']);

$montot=0.00;

/*verifica la caja seleccionada*/
   if($caja=="0"){
    $cadena_contado="Select distinct fecha,serie, numero from kardex where tipo='STCO' and fecha>='$fi' and fecha<='$ff' order by id";
    $cadena_credito="Select distinct fecha,serie, numero from kardex where tipo='STCR' and fecha>='$fi' and fecha<='$ff' order by id";
    }
    if($caja=="1"){
    $cadena_contado="Select distinct fecha,serie, numero from kardex where tipo='STCO' and fecha>='$fi' and fecha<='$ff' and serie=1 order by id";
    $cadena_credito="Select distinct fecha,serie, numero from kardex where tipo='STCR' and fecha>='$fi' and fecha<='$ff' and serie=1 order by id";
    }
    if($caja=="2"){
    $cadena_contado="Select distinct fecha,serie, numero from kardex where tipo='STCO' and fecha>='$fi' and fecha<='$ff' and serie=2 order by id";
    $cadena_credito="Select distinct fecha,serie, numero from kardex where tipo='STCR' and fecha>='$fi' and fecha<='$ff' and serie=2 order by id";
    }
    if($caja=="3"){
    $cadena_contado="Select distinct fecha,serie, numero from kardex where tipo='STCO' and fecha>='$fi' and fecha<='$ff' and serie=3 order by id";
    $cadena_credito="Select distinct fecha,serie, numero from kardex where tipo='STCR' and fecha>='$fi' and fecha<='$ff' and serie=3 order by id";
    }
    if($caja=="4"){
    $cadena_contado="Select distinct fecha,serie, numero from kardex where tipo='STCO' and fecha>='$fi' and fecha<='$ff' and serie=4 order by id";
    $cadena_credito="Select distinct fecha,serie, numero from kardex where tipo='STCR' and fecha>='$fi' and fecha<='$ff' and serie=4 order by id";
    }
    $exec=$db->consulta($cadena_contado);
    $exec_credito=$db->consulta($cadena_credito);
      if($db->numero_de_registros($exec)>0){
        echo "<div class='col-md-6'>";
        echo "<div class='box box-danger print1'>";
        echo "<div class='box-header with-border'>";
        echo "<h4 class='box-title'>Ventas de Contado | ".$fi." al ".$ff." <div id='total_contado'></div><br><button class='btn btn-primary no-print' onclick='print1();'><i class='fa fa-print'></i> Imprimir.</button></h4>";
        echo "</div>";
        echo "<div class='box-body'>";
        echo "<table id='tabla_ventas_contado' class='table table-bordered table-hover'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>Fecha</th>";
        echo "<th># Ticket</th>";
        echo "<th>Monto</th>";
        echo "<th>Status</th>";
        echo "<th>Tipo</th>";
        echo "<th>Detalle</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
           while($x=$db->buscar_array($exec)){
            $fecha=$x['fecha'];
            $s=$x['serie'];
            $n=$x['numero'];
            $elid=$s."|".$n;
            echo "<td>".$fecha."</td>";
            echo "<td>".$s."-".$n."</td>";
            $busca="Select tipo, sum(cantidad*preciou) as monto from kardex where serie=$s and numero=$n and tipo<>'CT'";
            $exec_contado=$db->consulta($busca);
              while($y=$db->buscar_array($exec_contado)){
               $tipo=$y['tipo'];
               $monto1=$monto1 + $y['monto'];
              }
             $montot = $montot + $monto1;
             echo "<td>".number_format($monto1,2)."</td>";

             $busca_cancelacion=$db->consulta("Select id from kardex where serie=$s and numero=$n and tipo='CT'");
              if($db->numero_de_registros($busca_cancelacion)>0){
               echo "<td>CANCELADO</td>";
             }else{
               echo "<td>ACTIVA</td>";
              }

           echo "<td><span class='label label-success'>Contado</span></td>";
           echo "<td><button class='btn btn-xs btn-primary confirmacion no-print' id='".$elid."' onclick='muestra_detalle(this.id);'><i class='fa fa-search'></i> Detalles.</button></td>";
           $monto1=0.00;
          echo "</tr>";
          }
          echo "</tbody>";
          echo "</table>";
          $montot=0.00;
        echo "</div>";
      echo "</div>";
      echo "</div>";
      }else{
        echo "<div class='col-md-6'><div class='callout callout-danger'>No se encontraron ventas de Contado...</div></div>";
      }

     /*ventas de credito*/
     if($db->numero_de_registros($exec_credito)>0){
        echo "<div class='col-md-6'>";
        echo "<div class='box box-danger print2'>";
        echo "<div class='box-header with-border'>";
        echo "<h4 class='box-title'>Ventas de Credito | ".$fi." al ".$ff." <div id='total_credito'></div><br><button class='btn btn-primary no-print' onclick='print2();'><i class='fa fa-print'></i> Imprimir.</button></h4>";
        echo "</div>";
        echo "<div class='box-body'>";
        echo "<table id='tabla_ventas_credito' class='table table-bordered table-hover'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>Fecha</th>";
        echo "<th># Ticket</th>";
        echo "<th>Monto</th>";
        echo "<th>Status</th>";
        echo "<th>Tipo</th>";
        echo "<th>Detalle</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
           while($xx=$db->buscar_array($exec_credito)){
            $fecha_credito=$xx['fecha'];
            $s_credito=$xx['serie'];
            $n_credito=$xx['numero'];
            $elid=$s_credito."|".$n_credito;
            echo "<td>".$fecha_credito."</td>";
            echo "<td>".$s_credito."-".$n_credito."</td>";
            $busca_c="Select tipo, sum(cantidad*preciou) as monto from kardex where serie=$s_credito and numero=$n_credito and tipo<>'CT'";
            $exec_credito_busca=$db->consulta($busca_c);
              while($yy=$db->buscar_array($exec_credito_busca)){
               $tipo_credito=$yy['tipo'];
               $monto1=$monto1 + $yy['monto'];
              }
             $montot = $montot + $monto1;
             echo "<td>".number_format($monto1,2)."</td>";

             $busca_cancelacion_credito=$db->consulta("Select id from kardex where serie=$s_credito and numero=$n_credito and tipo='CT'");
              if($db->numero_de_registros($busca_cancelacion_credito)>0){
               echo "<td>CANCELADO</td>";
             }else{
               echo "<td>ACTIVA</td>";
              }

           echo "<td><span class='label label-success'>Credito</span></td>";
           echo "<td><button class='btn btn-xs btn-primary confirmacion no-print' id='".$elid."' onclick='muestra_detalle(this.id);'><i class='fa fa-search'></i> Detalles.</button></td>";
           $monto1=0.00;
           echo "</tr>";
           }
          echo "</tbody>";
          echo "</table>";
          $montot=0.00;
        echo "</div>";
      echo "</div>";
      echo "</div>";
     }else{
        echo "<div class='col-md-6'><div class='callout callout-danger'>No se encontraron ventas de Credito...</div></div>";
      }

   /*pone la tabla de los gastos*/
      $busca_gastos=$db->consulta("Select * from gastos where edo='ACTIVO' and fecha>='$fi' and fecha<='$ff'");
      if($db->numero_de_registros($busca_gastos)>0){
      echo "<div class='col-md-6'>";
        echo "<div class='box box-danger print8'>";
        echo "<div class='box-header with-border'>";
        echo "<h4 class='box-title'>Gastos Registrados | ".$fi." al ".$ff." <div id='total_de_los_gastos'></div><br><button class='btn btn-primary no-print' onclick='print_gastos_corte();'><i class='fa fa-print'></i> Imprimir.</button></h4>";
        echo "</div>";
        echo "<div class='box-body'>";
        echo "<table id='tabla_de_gastos' class='table table-bordered table-hover'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>Fecha</th>";
        echo "<th># Doc</th>";
        echo "<th>Proveedor</th>";
        echo "<th>Subtotal</th>";
        echo "<th>IVA</th>";
        echo "<th>Total</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
          while($ft=$db->buscar_array($busca_gastos)){
            echo "<tr>";
            echo "<td>".$ft['fecha']."</td>";
            echo "<td>".$ft['numero_fact']."</td>";
            echo "<td>".$ft['proveedor']."</td>";
            echo "<td>".$ft['subtotal']."</td>";
            echo "<td>".$ft['iva']."</td>";
            echo "<td>".$ft['total']."</td>";
            echo "</tr>";
          }
          echo "</tbody>";
          echo "</table>";
        echo "</div>";
      echo "</div>";
      echo "</div>";
    }else{
      echo "<div class='col-md-6'><div class='callout callout-danger'>No se encontraron gastos registrados...</div></div>";
    }

   /*pone la tabla de abonos registrados*/
      $busca_abonos=$db->consulta("Select k.fecha,k.preciou,k.serie,k.numero,c.nombre from kardex k,clientes c where k.tipo='ABO' and k.fecha>='$fi' and k.fecha<='$ff' and k.referencia=c.id");
      if($db->numero_de_registros($busca_abonos)>0){
      echo "<div class='col-md-6'>";
        echo "<div class='box box-danger print9'>";
        echo "<div class='box-header with-border'>";
        echo "<h4 class='box-title'>Abonos Registrados | ".$fi." al ".$ff." <div id='total_de_los_abonos'></div><br><button class='btn btn-primary no-print' onclick='print_abonos_corte();'><i class='fa fa-print'></i> Imprimir.</button></h4>";
        echo "</div>";
        echo "<div class='box-body'>";
        echo "<table id='tabla_de_abonos' class='table table-bordered table-hover'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>Fecha</th>";
        echo "<th>Cliente</th>";
        echo "<th>No. Ticket</th>";
        echo "<th>Monto</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
          while($fz=$db->buscar_array($busca_abonos)){
            echo "<tr>";
            echo "<td>".$fz['fecha']."</td>";
            echo "<td>".$fz['nombre']."</td>";
            echo "<td>".$fz['serie']."-".$fz['numero']."</td>";
            echo "<td>".$fz['preciou']."</td>";
            echo "</tr>";
          }
          echo "</tbody>";
          echo "</table>";
        echo "</div>";
      echo "</div>";
      echo "</div>";
    }else{
      echo "<div class='col-md-6'><div class='callout callout-danger'>No se encontraron abonos registrados...</div></div>";
    }
?>