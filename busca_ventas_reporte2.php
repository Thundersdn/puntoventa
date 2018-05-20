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


if($tipo=='por_linea'){
   $linea=test_input($_POST['linea']);
   $grupo=test_input($_POST['grupo']);
  if($caja=='0'){
    $cadena="Select k.tipo,k.codigo,a.descripcion,a.costo,k.preciou,k.cantidad from kardex k, articulos a
    where (k.tipo='STCR' or k.tipo='STCO' or k.tipo='CT') and k.fecha>='$fi' and k.fecha<='$ff' and
    k.codigo=a.codigo and a.linea=$linea and a.grupo=$grupo order by k.id";
  }
  if($caja=='1'){
    $cadena="Select k.tipo,k.codigo,a.descripcion,a.costo,k.preciou,k.cantidad from kardex k, articulos a
    where (k.tipo='STCR' or k.tipo='STCO' or k.tipo='CT') and k.fecha>='$fi' and k.fecha<='$ff' and
    k.codigo=a.codigo and k.serie=1 and a.linea=$linea and a.grupo=$grupo order by k.id";
  }
  if($caja=='2'){
    $cadena="Select k.tipo,k.codigo,a.descripcion,a.costo,k.preciou,k.cantidad from kardex k, articulos a
    where (k.tipo='STCR' or k.tipo='STCO' or k.tipo='CT') and k.fecha>='$fi' and k.fecha<='$ff' and
    k.codigo=a.codigo and k.serie=2 and a.linea=$linea and a.grupo=$grupo order by k.id";
  }
  if($caja=='3'){
    $cadena="Select k.tipo,k.codigo,a.descripcion,a.costo,k.preciou,k.cantidad from kardex k, articulos a
    where (k.tipo='STCR' or k.tipo='STCO' or k.tipo='CT') and k.fecha>='$fi' and k.fecha<='$ff' and
    k.codigo=a.codigo and k.serie=3 and a.linea=$linea and a.grupo=$grupo order by k.id";
  }
  if($caja=='4'){
    $cadena="Select k.tipo,k.codigo,a.descripcion,a.costo,k.preciou,k.cantidad from kardex k, articulos a
    where (k.tipo='STCR' or k.tipo='STCO' or k.tipo='CT') and k.fecha>='$fi' and k.fecha<='$ff' and
    k.codigo=a.codigo and k.serie=4 and a.linea=$linea and a.grupo=$grupo order by k.id";
  }
  $exec=$db->consulta($cadena);
  if($db->numero_de_registros($exec)>0){
     echo "<div class='box box-primary print5'>";
     echo "<div class='box-header with-border'>";
     echo "<h4 class='box-title aqui'></h4>";
     echo "</div>";
     echo "<div class='box-body'>";
     echo "<table class='table table-hover table-responsive' id='ventas_lineas'>";
     echo "<thead>";
     echo "<tr>";
     echo "<th>Codigo</th>";
     echo "<th>Descripcion</th>";
     echo "<th>Cantidad</th>";
     echo "<th>Costo U.</th>";
     echo "<th>Precio U.</th>";
     echo "<th>Monto</th>";
     echo "<th>Tipo/Estado</th>";
     echo "</tr>";
     echo "<tbody>";
     while($dd=$db->buscar_array($exec)){
        echo "<tr>";
        echo "<td>".strtoupper($dd['codigo'])."</td>";
        echo "<td>".strtoupper($dd['descripcion'])."</td>";
        echo "<td>".number_format($dd['cantidad'],2)."</td>";
        echo "<td>".number_format($dd['costo'],2)."</td>";
        echo "<td>".number_format($dd['preciou'],2)."</td>";
        echo "<td>".number_format($dd['preciou']*$dd['cantidad'],2)."</td>";
        $edo=$dd['tipo'];
        if($edo=='STCR'){
        echo "<td>CREDITO</td>";
        }
        if($edo=='STCO'){
        echo "<td>CONTADO</td>";
        }
        if($edo=='CT'){
        echo "<td>CANCELADO</td>";
        }
        echo "</tr>";
     }
     echo "</tbody>";
     echo "</table>";
     echo "</div>";
     echo "</div>";
  } else{
    echo "<div class='callout callout-danger'><b>No se encontraron ventas registradas...</b></div>";
  }
}

/********************sila busqueda es general**********************************************/
if($tipo=='general'){
  $array=array();
   $trae_lineas=$db->consulta("Select linea,descripcion from lineas where linea<>0 and grupo=0 order by linea");
   while($lin=$db->buscar_array($trae_lineas)){
     $nombre_lin=$lin['descripcion'];
     $numero_lin=$lin['linea'];
     $array[$numero_lin]=array('linea'=>$numero_lin,'nombre'=>strtoupper($nombre_lin),'cantidad'=>0.00,'costo'=>0.00,'monto'=>0.00);
 }

 if($caja=='0'){
   $b="Select k.tipo,k.cantidad,k.codigo,a.linea,k.costou,k.preciou from kardex k, articulos a where
 k.fecha>='$fi' and k.fecha<='$ff' and (k.tipo='STCR' or k.tipo='STCO' or k.tipo='CT') and k.codigo=a.codigo";
 }
 if($caja=='1'){
   $b="Select k.tipo,k.cantidad,k.codigo,a.linea,k.costou,k.preciou from kardex k, articulos a where
 k.fecha>='$fi' and k.fecha<='$ff' and (k.tipo='STCR' or k.tipo='STCO' or k.tipo='CT') and k.serie=1 and k.codigo=a.codigo";
 }
 if($caja=='2'){
   $b="Select k.tipo,k.cantidad,k.codigo,a.linea,k.costou,k.preciou from kardex k, articulos a where
 k.fecha>='$fi' and k.fecha<='$ff' and (k.tipo='STCR' or k.tipo='STCO' or k.tipo='CT') and k.serie=2 and k.codigo=a.codigo";
 }
 if($caja=='3'){
   $b="Select k.tipo,k.cantidad,k.codigo,a.linea,k.costou,k.preciou from kardex k, articulos a where
 k.fecha>='$fi' and k.fecha<='$ff' and (k.tipo='STCR' or k.tipo='STCO' or k.tipo='CT') and k.serie=3 and k.codigo=a.codigo";
 }
 if($caja=='4'){
   $b="Select k.tipo,k.cantidad,k.codigo,a.linea,k.costou,k.preciou from kardex k, articulos a where
 k.fecha>='$fi' and k.fecha<='$ff' and (k.tipo='STCR' or k.tipo='STCO' or k.tipo='CT') and k.serie=4 and k.codigo=a.codigo";
 }
 $busca_ventas=$db->consulta($b);
 if($db->numero_de_registros($busca_ventas)>0){
  while($s=$db->buscar_array($busca_ventas)){
    $ln=$s['linea'];
    $costo=$s['costou'];
    $preciou=$s['preciou'];
    $cantidad=$s['cantidad'];
    $eltipo=$s['tipo'];
    if(in_array($array[$ln],$array)){
       if($eltipo=='STCR' || $eltipo=='STCO'){
         $array[$ln]['cantidad']=$array[$ln]['cantidad']+$cantidad;
         $array[$ln]['costo']=$array[$ln]['costo']+($cantidad * $costo);
         $array[$ln]['monto']=$array[$ln]['monto']+($cantidad * $preciou);
       }
       if($eltipo=='CT'){
         $array[$ln]['cantidad']=$array[$ln]['cantidad']-$cantidad;
         $array[$ln]['costo']=$array[$ln]['costo']-($cantidad * $costo);
         $array[$ln]['monto']=$array[$ln]['monto']-($cantidad * $preciou);
       }
    }
  }
  /*dibuja y llena la tabla*/
     echo "<div class='box box-primary print6'>";
     echo "<div class='box-header with-border'>";
     echo "<h4 class='box-title aqui'></h4>";
     echo "</div>";
     echo "<div class='box-body'>";
     echo "<table class='table table-hover table-responsive' id='ventas_lineas_yy'>";
     echo "<thead>";
     echo "<tr>";
     echo "<th>Linea</th>";
     echo "<th>Cantidad</th>";
     echo "<th>Costo Total</th>";
     echo "<th>Monto Total</th>";
     echo "<th>Detalles</th>";
     echo "</tr>";
     echo "<tbody>";

     foreach($array as $yy){
      echo "<tr>";
      echo "<td>".$yy['nombre']."</td>";
      echo "<td>".number_format($yy['cantidad'],2)."</td>";
      echo "<td>".number_format($yy['costo'],2)."</td>";
      echo "<td>".number_format($yy['monto'],2)."</td>";
      $elid2=$yy['linea']."|".$fi."|".$ff."|".$caja;
      echo "<td><button class='btn btn-success btn-xs' id='".$elid2."' onclick='detalla_por_linea2(this.id);'><i class='fa fa-search'></i> Detalles.</button></td>";
      echo "</tr>";
    }
    echo "</tbody";
    echo "</table>";
    echo "</div>";
    echo "</div>";
  }else{
   echo "<div class='callout callout-danger'><b>No se encontraron ventas registradas...</b></div>";
  }
}


?>