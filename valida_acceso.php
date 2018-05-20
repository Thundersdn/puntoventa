<?php
session_start();
if($_SESSION['autorizado']<>1){
    header("Location: index.php");
}

///********VERIFICA LA OPCION CORRESPONDIENTE*****************///
require('class_lib/funciones.php');
$p=test_input($_POST['pass']);
$opt=test_input($_POST['opt']);
$contra_ajustes="admin2017";
$contra_respaldo="admin2017";

if($opt==1265780909){
if($p==$contra_ajustes){
  $_SESSION['autorization']=1;
  echo "1";
}else{
  echo "0";
 }
}

if($opt==582963741){
if($p==$contra_respaldo){
  $_SESSION['autorization_bd']=1;
  echo "3";
}else{
  echo "2";
 }
}
?>
