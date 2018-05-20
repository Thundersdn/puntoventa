<?php
session_start();
if($_SESSION['autorizado']<>1){
    header("Location: index.php");
}
error_reporting(0);
require('class_lib/class_conecta_mysql.php');

$db=new ConexionMySQL();
$db->consulta("SET NAMES 'utf8'");

echo "<div class='box box-primary'>";

echo "<div class='box-header with-border'>";
echo "<h4>Selecciona opcion.</h4>";
echo "</div>";

echo "<div class='box-body'>";

echo "<div class='form-group'>";
echo "<label>";
echo "<input type='radio' name='r1' id='por_linea' onclick='revisa();'> Por lineas:";
$cadena="select linea, descripcion from lineas where grupo=0 and marca_eliminada='NO' order by linea";
$exe=$db->consulta($cadena);
 if($db->numero_de_registros($exe)>0){
   echo "<select class='form-control select2' id='linea' onchange='pone_grupos();' style='width: 100%' disabled>";
   echo "<option value='0' selected>Selecciona una linea...</option>";
    while($re=$db->buscar_array($exe)){
     echo "<option value=$re[linea]>$re[linea] - $re[descripcion]</option>";
     }
    echo "</select>";
    echo "<br>";
    echo "<div id='pone_grupos'></div>";
   }
echo "</label>";
echo "</div>";

echo "<div class='form-group'>";
echo "<label>";
echo "<input type='radio' name='r1' id='general' onclick='revisa();'> General";
echo "</label>";
echo "</div>";

echo "</div>";

echo "<div class='box-footer'>";
echo "<button type='button' class='btn btn-primary pull-right' onclick='trae_existencia();' id='btn-listo'><i class='fa fa-search'></i> Buscar</button>";
echo "</div>";

echo "</div>";
?>
