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
$tipo=test_input($_POST['tipo']);
$date= date('Y-m-d');
$monto=0.00;
$cantidad=0.00;
$cantidad_acumulada=0.00;
$montoss=0.00;
$elid=$linea."|".$grupo."|".$fecha;

echo "<div class='box box-primary print4'>";
echo "<div class='box-header with-border aqui'>";
echo "<h4>Existencias a la Fecha: ".$fecha."</h4>";
echo "</div>";
echo "<div class='box-body'>";
echo "<table class='table table-bordered table-hover' id='tabla_inventarios'>";
echo "<thead>";
echo "<tr>";
echo "<th>Linea</th>";
echo "<th>Grupo</th>";
echo "<th>Cantidad</th>";
echo "<th>Costo Total</th>";
echo "<th>Ver Detalles</th>";
echo "</tr>";
echo "</thead>";
echo "<tbody>";
/*******************************si es por linea****************************************/
if($tipo=='por_linea'){
 /*nombre de las linea*/
 $name_linea='';
 $name_grupo='';
 $name_l=$db->consulta("Select descripcion from lineas where linea=$linea and grupo=0");
  while($x=$db->buscar_array($name_l)){
    $name_linea=$x['descripcion'];
  }
  /*compara las fechas*/
 if($fecha>=$date){
   if($grupo=='0'){
     $name_grupo='';
     $cadena="Select codigo, costo from articulos where linea=$linea";
   }else{
     $name_g=$db->consulta("Select descripcion from lineas where linea=$linea and grupo=$grupo");
      while($x=$db->buscar_array($name_g)){
       $name_grupo=$x['descripcion'];
        }
     $cadena="Select codigo, costo from articulos where linea=$linea and grupo=$grupo";
   }
   $exec=$db->consulta($cadena);
   while($data=$db->buscar_array($exec)){
     $articulo=$data['codigo'];
     $costo_de_articulo=$data['costo'];
      $busca_existencia=$db->consulta("Select cantidad from existencias where codigo='$articulo'");
       while($cuanto=$db->buscar_array($busca_existencia)){
        $cantidad=$cuanto['cantidad'];
        $cantidad_acumulada+= $cantidad;
        $monto+=($costo_de_articulo * $cantidad);
     }
   }
   echo "<tr>";
   echo "<td>".$name_linea."</td>";
   echo "<td>".$name_grupo."</td>";
   echo "<td>".number_format($cantidad_acumulada,2)."</td>";
   echo "<td>".number_format($monto,2)."</td>";

   echo "<td><button class='btn btn-success btn-xs' id='".$elid."' onclick='detalla_por_linea(this.id);'><i class='fa fa-search'></i> Detalles.</button></td>";
   echo "</tr>";
 }

/*si la fecha es menor que la actual, buscamos en kardex los movimiento y hacemos las operaciones*/
  if($fecha<$date){
   if($grupo=='0'){
    $name_linea='';
    $name_grupo='';
    $name_l=$db->consulta("Select descripcion from lineas where linea=$linea and grupo=0");
      while($x=$db->buscar_array($name_l)){
     $name_linea=$x['descripcion'];
      }
      $cadena="Select costo, codigo from articulos where linea=$linea";
   }else{
     $name_g=$db->consulta("Select descripcion from lineas where linea=$linea and grupo=$grupo");
      while($x=$db->buscar_array($name_g)){
       $name_grupo=$x['descripcion'];
      }
      $cadena="Select codigo, costo from articulos where linea=$linea and grupo=$grupo";
   }

   $exec=$db->consulta($cadena);
   while($data=$db->buscar_array($exec)){
     $articulo=$data['codigo'];
     $costo_de_articulo=$data['costo'];
     $busca_existencia=$db->consulta("Select tipo,cantidad from kardex where fecha<='$fecha' and codigo='$articulo'");
       while($cuanto=$db->buscar_array($busca_existencia)){
         $cantidad=$cuanto['cantidad'];
         $eltipo=$cuanto['tipo'];
        if($eltipo=='EC' || $eltipo=='A' || $eltipo=='CT'){
           $cantidad_total_articulos+=$cantidad;
           $costo_total = $costo_total + ($cantidad * $costo_de_articulo);
        }
        if($eltipo=='STCR' || $eltipo=='STCO' || $eltipo=='DP' || $eltipo=='A-'){
           $cantidad_total_articulos-=$cantidad;
           $costo_total = $costo_total - ($cantidad * $costo_de_articulo);
        }

      }
    }
   echo "<tr>";
   echo "<td>".$name_linea."</td>";
   echo "<td>".$name_grupo."</td>";
   echo "<td>".number_format($cantidad_total_articulos,2)."</td>";
   echo "<td>".number_format($costo_total,2)."</td>";
   echo "<td><button class='btn btn-success btn-xs' id='".$elid."' onclick='detalla_por_linea(this.id);'><i class='fa fa-search'></i> Detalles.</button></td>";
   echo "</tr>";
 }



}

/****************************si el reporte es general*********************************/
if($tipo=='general'){
  $array=array();
   $trae_lineas=$db->consulta("Select linea,descripcion from lineas where linea<>0 and grupo=0 order by linea");
   while($lin=$db->buscar_array($trae_lineas)){
     $nombre_lin=$lin['descripcion'];
     $numero_lin=$lin['linea'];
     $array[$numero_lin]=array('linea'=>$numero_lin,'nombre'=>strtoupper($nombre_lin),'cantidad'=>0.00,'costo'=>0.00);
   }

  if($fecha>=$date){
    $busca_movs=$db->consulta("Select a.codigo,a.linea,a.costo,e.cantidad from articulos a, existencias e where e.cantidad<>0 and a.codigo=e.codigo");
    while($rf=$db->buscar_array($busca_movs)){
      $la_cantidad=$rf['cantidad'];
      $el_costo=$rf['costo'];
      $la_linea=$rf['linea'];
      if(in_array($array[$la_linea],$array)){
         $array[$la_linea]['cantidad']=$array[$la_linea]['cantidad'] + $la_cantidad;
         $array[$la_linea]['costo']=$array[$la_linea]['costo'] + ($el_costo * $la_cantidad);
      }
    }

    foreach($array as $yy){
      echo "<tr>";
      echo "<td>".$yy['nombre']."</td>";
      echo "<td></td>";
      echo "<td>".number_format($yy['cantidad'],2)."</td>";
      echo "<td>".number_format($yy['costo'],2)."</td>";
      $elid2=$yy['linea']."|0|".$fecha;
      echo "<td><button class='btn btn-success btn-xs' id='".$elid2."' onclick='detalla_por_linea(this.id);'><i class='fa fa-search'></i> Detalles.</button></td>";
      echo "</tr>";
    }
  }

/*si la fecha es menor que ahora*/
  if($fecha<$date){
    $busca_movs=$db->consulta("Select k.cantidad,a.costo,a.linea,k.tipo from kardex k, articulos a
    where k.fecha<='$fecha' and k.codigo=a.codigo");
    while($rf=$db->buscar_array($busca_movs)){
       $la_cantidad=$rf['cantidad'];
       $el_costo=$rf['costo'];
       $la_linea=$rf['linea'];
       $el_tipo=$rf['tipo'];
       if(in_array($array[$la_linea], $array)){
          if($el_tipo=='EC' || $el_tipo=='A' || $el_tipo=='CT'){
          $array[$la_linea]['cantidad']=$array[$la_linea]['cantidad'] + $la_cantidad;
          $array[$la_linea]['costo']=$array[$la_linea]['costo'] + ($el_costo * $la_cantidad);
          }
          if($el_tipo=='STCR' || $el_tipo=='STCO' || $el_tipo=='DP' || $el_tipo=='A-'){
          $array[$la_linea]['cantidad']=$array[$la_linea]['cantidad'] - $la_cantidad;
          $array[$la_linea]['costo']=$array[$la_linea]['costo'] - ($el_costo * $la_cantidad);
          }
       }
    }

    foreach($array as $yy){
      echo "<tr>";
      echo "<td>".$yy['nombre']."</td>";
      echo "<td></td>";
      echo "<td>".number_format($yy['cantidad'],2)."</td>";
      echo "<td>".number_format($yy['costo'],2)."</td>";
      $elid2=$yy['linea']."|0|".$fecha;
      echo "<td><button class='btn btn-success btn-xs' id='".$elid2."' onclick='detalla_por_linea(this.id);'><i class='fa fa-search'></i> Detalles.</button></td>";
      echo "</tr>";
    }

  }

}


echo "</tbody>";
echo "</table>";
echo "</div>";
echo "</div>";
?>