<?php
session_start();
if($_SESSION['autorizado']<>1){
    header("Location: index.php");
}
error_reporting(0);

$option=$_POST['option'];

if($option=='1'){
echo "<div class='box box-primary'>";
echo "<div class='box-header with-border'>";
echo "<h4 class='box-title'>Selecciona las fechas.</h4>";
echo "</div>";

echo "<div class='box-body'>";
 echo "<div class='form-group'>";
 echo "<label>Fechas:</label>";
 echo "<div class='input-group'>";
 echo "<button class='btn btn-default pull-left' id='daterange-btn'>";
 echo "<i class='fa fa-calendar'></i> Click para seleccionar.";
 echo "<i class='fa fa-caret-down'></i>";
 echo "</button>";
 echo "</div>";
 echo "<span class='fe'></span>";
 echo "<input type='hidden'  class='form-control' id='fi' value=''>";
 echo "<input type='hidden'  class='form-control' id='ff' value=''>";
 echo "</div>";
echo "</div>";

echo "<div class='box-footer'>";
echo "<button class='btn btn-primary pull-right' onclick='busca_ventas();' id='btn-busca'><i class='fa fa-search'></i> Buscar...</button>";
echo "</div>";

echo "</div>";
}

if($option=='2'){
 echo "<div class='box box-primary'>";
echo "<div class='box-header with-border'>";
echo "<h4 class='box-title'>Ingresa el numero de caja y venta.</h4>";
echo "</div>";

echo "<div class='box-body'>";
echo "<form class='form-horizontal'>";
 echo "<div class='form-group'>";
 echo "<label for='tipo_buscar' class='col-sm-3 control-label'>Selecciona el # de Caja:</label>
             <div class='col-sm-3'>
                <select class='form-control select2' id='numero_caja'>
                <option value='1'>Caja 1</option>
                <option value='2'>Caja 2</option>
                <option value='3'>Caja 3</option>
                <option value='4'>Caja 4</option>
                </select>
             </div>";
   echo "</div>";

   echo "<div class='form-group'>";
   echo "<label for='numero_ticket' class='col-sm-3 control-label'>Numero de ticket:</label>";
   echo "<div class='col-sm-2'>";
   echo "<input type='text' class='form-control' id='numero_ticket'>";
   echo "</div>";
   echo "</div>";
 echo "</form>";
echo "</div>";

echo "<div class='box-footer'>";
echo "<button class='btn btn-primary pull-right' onclick='busca_ventas_numero();' id='btn-busca'><i class='fa fa-search'></i> Buscar...</button>";
echo "</div>";

echo "</div>";
}
?>