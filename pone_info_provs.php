<?php
session_start();
if($_SESSION['autorizado']<>1){
    header("Location: index.php");
}
error_reporting(1);
require('class_lib/class_conecta_mysql.php');
$db=new ConexionMySQL();  
require('class_lib/funciones.php');

$id_prov=test_input($_POST['id_prov']);

$info = $db->consulta("Select telefono, domicilio from proveedores where id=$id_prov limit 1");

$arr = $db->buscar_array_assoc($info);

echo json_encode($arr);


?>