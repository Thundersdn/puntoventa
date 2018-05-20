<?php
session_start();
if($_SESSION['autorizado']<>1){
header("Location: index.php");
}
error_reporting(0);
require('class_lib/class_conecta_mysql.php');
require('class_lib/funciones.php');

$db= new ConexionMySQL();
$set_names=$db->consulta("SET NAMES 'utf8'");

$nombre = "";
 if(empty(test_input($_POST['nombre']))){
  $consulta="select id,nombre,telefono,domicilio,ciudad from clientes order by ".$_GET['jtSorting'] ." limit " . $_GET['jtStartIndex'] . ',' . $_GET['jtPageSize'] . "";
  $consulta2="Select COUNT(*) AS RecordCount from clientes";
  }
   else{
  $nombre=$_POST['nombre'];
  $consulta="select id,nombre,telefono,domicilio,ciudad from clientes where nombre like '%$nombre%' order by ".$_GET['jtSorting'] ." limit " . $_GET['jtStartIndex'] . ',' . $_GET['jtPageSize'] . "";
  $consulta2="Select COUNT(*) AS RecordCount from clientes";
  }



$rows=array();
$registros=$db->consulta($consulta2);
$row = mysql_fetch_assoc($registros);
$recordCount = $row['RecordCount'];

$trayendo=$db->consulta($consulta);

   while($row=mysql_fetch_assoc($trayendo)){
     $rows[]=$row;
   }
        $jTableResult = array();
		$jTableResult['Result'] = "OK";
        $jTableResult['TotalRecordCount'] = $recordCount;
		$jTableResult['Records'] = $rows;
		print json_encode($jTableResult);
        //echo "<br>";
        //echo "<pre>";
       // print_r($jTableResult);
       // echo "</pre>";

$db->DesconectaServer();
?>