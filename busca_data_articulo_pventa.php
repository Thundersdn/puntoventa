
<?php
/*busca el articulo para punto de venta*/
session_start();
if($_SESSION['autorizado']<>1){
    header("Location: index.php");
}
error_reporting(0);
require('class_lib/class_conecta_mysql.php');
$db=new ConexionMySQL();    
require('class_lib/funciones.php');



$codigo=test_input($_POST['codigo']);
$cadena="select a.precio,a.descripcion,e.cantidad,a.imagen from articulos a,existencias e where a.codigo='$codigo' and e.codigo=a.codigo";
$exe=$db->consulta($cadena);
 if($db->numero_de_registros($exe)>0){
   $array=array();
   $i=0;
    while($re=$db->buscar_array($exe)){
      $array[$i]=$re;
      $i++;
   }
   echo json_encode($array);
 }else{
   echo "0";
 }
?>