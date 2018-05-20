<?php
session_start();
if($_SESSION['autorizado']<>1){
    header("Location: index.php");
}
error_reporting(0);
require('class_lib/class_conecta_mysql.php');

$db=new ConexionMySQL();
$db->consulta("SET NAMES 'utf8'");
$cadena="select id, nombre from clientes order by id";
$exe=$db->consulta($cadena);
 if($db->numero_de_registros($exe)>0){
   echo "<select class='form-control select2' id='cliente' style='width: 100%;' onchange=''>";
    while($re=$db->buscar_array($exe)){
     echo "<option value=$re[id]>$re[nombre]</option>";
     }
    echo "</select>";
   }
?>