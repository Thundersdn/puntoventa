<?php
session_start();
if($_SESSION['autorizado']<>1){
    header("Location: index.php");
}
date_default_timezone_set("America/Chihuahua");
error_reporting(0);
include('class_lib/class_conecta_mysql.php');
$db=new ConexionMySQL();
$fecha_actual=date('Y-m-d');
$array=array();
$array_listo=array();
/*arma array de lineas*/
$busca_lineas=$db->consulta("Select descripcion from lineas where grupo=0");
while($qq=$db->buscar_array($busca_lineas)){
  $name_linea=$qq['descripcion'];
  $array[$name_linea]=array('y'=>$name_linea,'item1'=>0.00);
}


$busca_ventas=$db->consulta("Select codigo, cantidad, preciou from kardex where (tipo='STCO' or tipo='STCR' or tipo='CT') and fecha='$fecha_actual'");
if($db->numero_de_registros($busca_ventas)>0){
  while($sw=$db->buscar_array($busca_ventas)){
    $elcodigo=$sw['codigo'];
    $cant=$sw['cantidad'];
    $preciou=$sw['preciou'];
    $busca_linea=$db->consulta("Select a.codigo,l.descripcion from articulos a, lineas l where a.codigo='$elcodigo' and a.linea=l.linea");
    while($gt=$db->buscar_array($busca_linea)){
     $descripcion=$gt['descripcion'];
    }

      if(in_array($array[$descripcion],$array)){
        $array[$descripcion]['item1']=$array[$descripcion]['item1'] + ($cant*$preciou);
       }

   }

   foreach($array as $l){
     $we['label']=$l['y'];
     $we['value']=$l['item1'];
     array_push($array_listo,$we);
   }

} else{
   $we['label']='No hay ventas...';
   $we['value']=0.00;
   array_push($array_listo,$we);
}
echo json_encode($array_listo);
?>