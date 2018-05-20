<?php
/*
configuracion de Uploadify
Carlos Delgado
26 de mayo de 2015
*/
error_reporting(0);
include('class_lib/class_conecta_mysql.php');
$db=new ConexionMySQL();
$carpeta= 'AdminSRECC/img_articulos';
$codigo=$_POST['codigo'];
if (!empty($_FILES)){
    $tempFile = $_FILES['Filedata']['tmp_name'];
    $targetPath = $_SERVER['DOCUMENT_ROOT'] . $carpeta;
    $targetFile = rtrim($targetPath,'/') . '/' . $_FILES['Filedata']['name'];
    $nombre_imagen=$_FILES['Filedata']['name'];
    // Validate the file type
    $fileTypes = array('jpg','jpeg','gif','png','JPG','JPEG','GIF','PNG'); // File extensions
    $fileParts = pathinfo($_FILES['Filedata']['name']);

    if (in_array($fileParts['extension'],$fileTypes)){
        move_uploaded_file($tempFile,$targetFile);
       $cadena=$db->consulta("Update articulos set imagen='$nombre_imagen' where codigo='$codigo'");
    } else {
        echo 'Formato de imagen no valida...';
    }
}
?>