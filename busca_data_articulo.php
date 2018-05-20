<?php
session_start();
if($_SESSION['autorizado']<>1){
    header("Location: index.php");
}
error_reporting(0);
require('class_lib/class_conecta_mysql.php');
$db=new ConexionMySQL();
require('class_lib/funciones.php');


$codigo=test_input($_POST['codigo']);
$cadena="select a.costo,a.descripcion,e.cantidad from articulos a,existencias e where a.codigo='$codigo' and e.codigo=a.codigo";
$exe=$db->consulta($cadena);
 if($db->numero_de_registros($exe)>0){
    while($re=$db->buscar_array($exe)){
      echo "<div class='well'><h5 class='text-success'>$re[descripcion]<br>";
      echo "<b>".$re['cantidad']."</b> en existencia</h5></div>";
      echo "<input type='hidden' id='desc' value='$re[descripcion]'>";
      echo "<div class='control-group'>";
	  echo "<label class='control-label' for='precio'>Costo Unitario:</label>";
      echo "<div class='controls'>";
	  echo "$<input type='text' id='costo'  class='input-small'  value=$re[costo] />";
	  echo "</div>";
      echo "</div>";

      echo "<div class='control-group'>";
	  echo "<label class='control-label' for='cantidad'>Cantidad:</label>";
      echo "<div class='controls'>";
	  echo "<input type='text' id='cantidad'  class='input-small'  value=1.00 />";
	  echo "</div>";
      echo "</div>";

      echo "<div class='form-actions'>";
	  echo "<button class='btn btn-app btn-danger btn-mini' type='button' onclick='agrega_a_lista();' id='btn-agrega'>";
	  echo "<i class='icon-share-alt bigger-200'></i>";
	  echo "Agregar";
	  echo "</button>";
      echo "&nbsp;&nbsp;&nbsp;";
      echo "<button class='btn btn-app btn-success btn-mini' type='button' onclick='cancela_operacion();' id='btn-cancela'>";
	  echo "<i class='icon-trash bigger-200'></i>";
	  echo "Cancelar";
	  echo "</button>";
      echo "</div>";
    }
 }else{
      echo "<div class='well'><h5 class='text-success'>No existe el articulo...</h5></div>";
 }
?>
