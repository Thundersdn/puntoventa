<?php
session_start();
if($_SESSION['autorizado']<>1){
    header("Location: index.php");
}
date_default_timezone_set("America/Chihuahua");
error_reporting(0);
include('class_lib/class_conecta_mysql.php');
$db=new ConexionMySQL();
$i=0;
$fecha_actual=date('Y-m-d');
$consulta=$db->consulta("Select distinct numero from kardex where tipo='EC' and fecha='$fecha_actual'");
if($db->numero_de_registros($consulta)>0){
  while($rf=$db->buscar_array($consulta)){
    $i++;
  }
}

?>
<div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3><?php echo $i; ?></h3>
                  <p>Entradas registradas hoy.</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="rev_entrada.php" class="small-box-footer">Ver otras entradas <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->