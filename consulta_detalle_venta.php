<?php
session_start();
if($_SESSION['autorizado']<>1){
    header("Location: index.php");
}
error_reporting(0);
require('class_lib/class_conecta_mysql.php');
require('class_lib/funciones.php');
$db=new ConexionMySQL();
$serie=test_input($_POST['serie']);
$numero=test_input($_POST['numero']);
$montototal=0.00;
$busca_detalle=$db->consulta("Select k.codigo, a.descripcion, k.cantidad, k.preciou from
kardex as k, articulos as a where k.serie=$serie and k.numero=$numero and a.codigo=k.codigo and tipo<>'CT'");
echo "<table class='table table-bordered table-hover'>";
echo "<thead>";
echo "<tr>";
echo "<th>Codigo</th>";
echo "<th>Descripcion</th>";
echo "<th>Cantidad</th>";
echo "<th>Precio U.</th>";
echo "<th>Monto</th>";
echo "</tr>";
echo "</thead>";
echo "<tbody>";
while($data=$db->buscar_array($busca_detalle)){
echo "<tr>";
echo "<td>".$data['codigo']."</td>";
echo "<td>".strtoupper($data['descripcion'])."</td>";
echo "<td>".$data['cantidad']."</td>";
echo "<td>".$data['preciou']."</td>";
$montototal=$montototal+($data['cantidad'] * $data['preciou']);
echo "<td>$ ".number_format($data['cantidad'] * $data['preciou'],2)."</td>";
echo "</tr>";
}
echo "<tr>";
echo "<td></td>";
echo "<td></td>";
echo "<td></td>";
echo "<td><span class='label label-success'>TOTAL</span></td>";
echo "<td><span class='label label-success'>$ ".number_format($montototal,2)."</span></td>";
echo "</tr>";
?>