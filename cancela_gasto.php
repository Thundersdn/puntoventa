<?php
session_start();
if($_SESSION['autorizado']<>1){
    header("Location: index.php");
}
error_reporting(0);
require('class_lib/class_conecta_mysql.php');
require('class_lib/funciones.php');
$db=new ConexionMySQL();
$id=test_input($_POST['idgasto']);
$user=$_SESSION['nombre_de_usuario'];
$cancel=$db->consulta("Update gastos set user_cancela='$user', edo='CANCELADO' where id=$id");

?>