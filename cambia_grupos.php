<?php
session_start();
if($_SESSION['autorizado']<>1){
    header("Location: index.php");
}
error_reporting(0);
require('class_lib/class_conecta_mysql.php');
$db=new ConexionMySQL();  
require('class_lib/funciones.php');
$linea=test_input($_POST['linea']);

$db->consulta("SET NAMES 'utf8'");
echo "<div class='form-group' id='grupo_para_cambiar'>";
echo "<label class='col-sm-2 control-label' for='grupo_cambio'>Grupo:</label>";
echo "<div class='col-sm-4'>";
$cadena="select grupo, descripcion from lineas where linea=$linea  and grupo<>0 order by grupo";
$exe=$db->consulta($cadena);
 if($db->numero_de_registros($exe)>0){
   echo "<select class='form-control select2' id='grupo_cambio' data-placeholder='Selecciona un grupo...'>";
   //echo "<option value=0>Selecciona una linea...</option>";
    while($re=$db->buscar_array($exe)){
     echo "<option value=$re[grupo]>$re[grupo] - $re[descripcion]</option>";
     }
    echo "</select>";
   echo "</div>";
  echo "</div>";
   }else{
   echo "<select class='form-control select2' id='grupo_cambio' data-placeholder='Selecciona un grupo...'>";
    echo "<option value='0'>No hay grupos registrados...</option>";
    echo "</select>";
   }
?>