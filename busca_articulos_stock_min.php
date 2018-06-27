<?php
session_start();
if($_SESSION['autorizado']<>1){
    header("Location: index.php");
}
error_reporting(1);
require('class_lib/class_conecta_mysql.php');

$db=new ConexionMySQL();
$c = mysql_num_rows($db->consulta("SELECT * from existencias WHERE cantidad <= stock_min"));
#error_log($c);
if($c){
	echo $c;
}else{
	echo 0;
}
?>
