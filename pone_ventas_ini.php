<?php
session_start();
if($_SESSION['autorizado']<>1){
    header("Location: index.php");
}
date_default_timezone_set("America/Chihuahua");
error_reporting(0);
include('class_lib/class_conecta_mysql.php');
$db=new ConexionMySQL();
$monto =0.00;
$monto_cancelado=0.00;
$fecha_actual=date('Y-m-d');
$consulta=$db->consulta("Select sum(cantidad*preciou) as monto from kardex where (tipo='STCO' or tipo='STCR') and fecha='$fecha_actual'");
if($db->numero_de_registros($consulta)>0){
  while($rf=$db->buscar_array($consulta)){
    $monto=$rf['monto'];
  }
} else{
  $monto=0.00;
}

$consulta2=$db->consulta("Select sum(cantidad*preciou) as monto2 from kardex where tipo='CT' and fecha='$fecha_actual'");
if($db->numero_de_registros($consulta2)>0){
   while($ew=$db->buscar_array($consulta2)){
     $monto_cancelado=$ew['monto2'];
   }
}

?>
<div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3><?php echo number_format($monto-$monto_cancelado,2); ?></h3>
                  <p>Ventas al dia de hoy.</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="rep_ventas_s.php" class="small-box-footer">Consultar otra fecha <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->