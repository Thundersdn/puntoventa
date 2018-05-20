<?php
session_start();
error_reporting(0);
$xx=$_POST['caja'];
$_SESSION['numero_de_caja']=$xx;
?>