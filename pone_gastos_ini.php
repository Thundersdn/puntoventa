<?php
session_start();
if($_SESSION['autorizado']<>1){
    header("Location: index.php");
}
date_default_timezone_set("America/Chihuahua");
error_reporting(0);
include('class_lib/class_conecta_mysql.php');
$db=new ConexionMySQL();
$total_gastos=0.00;
$fecha_actual=date('Y-m-d');
$consulta=$db->consulta("Select sum(total) as total from gastos where edo='ACTIVO' and fecha='$fecha_actual'");
if($db->numero_de_registros($consulta)>0){
  while($rf=$db->buscar_array($consulta)){
    $total_gastos=$rf['total'];
  }
}

?>
<div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3><?php echo number_format($total_gastos,2); ?></h3>
                  <p>Gastos registrados hoy.</p>
                </div>
                <div class="icon">
                  <i class="ion ion-calendar"></i>
                </div>
                <a href="rep_gastos.php" class="small-box-footer">Consultar otros <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->