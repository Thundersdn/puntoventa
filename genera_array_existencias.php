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
$array_existe=array();
$array_listo_existe=array();
/*arma array de lineas*/
$busca_lineas=$db->consulta("Select descripcion from lineas where grupo=0");
while($qq=$db->buscar_array($busca_lineas)){
  $name_linea=$qq['descripcion'];
  $array_existe[$name_linea]=array('y'=>$name_linea,'item1'=>0.00);
}


$busca_arts=$db->consulta("Select a.codigo, a.costo,e.cantidad from articulos a, existencias e where a.codigo=e.codigo and e.cantidad<>0");
if($db->numero_de_registros($busca_arts)>0){
  while($sw=$db->buscar_array($busca_arts)){
    $elcodigo=$sw['codigo'];
    $costo=$sw['costo'];
    $cantidad=$sw['cantidad'];
    $busca_linea=$db->consulta("Select a.codigo,l.descripcion from articulos a, lineas l where a.codigo='$elcodigo' and a.linea=l.linea");
    while($gt=$db->buscar_array($busca_linea)){
     $descripcion=$gt['descripcion'];
    }

      if(in_array($array_existe[$descripcion],$array_existe)){
        $array_existe[$descripcion]['item1']=$array_existe[$descripcion]['item1'] + ($cantidad*$costo);
       }

   }

   foreach($array_existe as $l){
     $we['label']=$l['y'];
     $we['value']=$l['item1'];
     array_push($array_listo_existe,$we);
   }

} else{
   $we['label']='No hay existencias...';
   $we['value']=0.00;
   array_push($array_listo_existe,$we);
}
echo json_encode($array_listo_existe);
?>