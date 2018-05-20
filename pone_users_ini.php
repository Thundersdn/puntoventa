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
//$fecha_actual=date('Y-m-d');
$consulta=$db->consulta("Select * from usuarios");
if($db->numero_de_registros($consulta)>0){
  while($rf=$db->buscar_array($consulta)){
    $i++;
  }
}

?>
<div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3><?php echo $i; ?></h3>
                  <p>Usuarios registrados.</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <a href="util_usr.php" class="small-box-footer">Operaciones con usuarios <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->