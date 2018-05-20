<?php include "./class_lib/sesionSecurity.php"; ?>
<!DOCTYPE html>
<html>
  <head>
    <title>SerMac | Software</title>
    <?php include "./class_lib/links.php"; ?>
  </head>
  <body onload="revisa_compras();revisa_ventas();pone_gastos();pone_users();genera_grafica();genera_grafica_existe();revisa_caducidades();">
    <div class="wrapper">

      <!-- Main Header -->
      <header class="main-header">

        <!-- Logo -->
        <?php
        include('class_lib/nav_header.php');
        ?>

      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <?php
        include('class_lib/sidebar.php');
        include('class_lib/class_conecta_mysql.php');
        $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","S�bado");
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $fecha=$dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;
        $db=new ConexionMySQL();
        $consulta=$db->consulta("Select nombre_empresa from parametros");
        while($sw=$db->buscar_array($consulta)){
          $name_empresa=$sw['nombre_empresa'];
        }
        ?>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
          <?php
          echo $name_empresa;
          ?>
            <small><?php echo $fecha; ?></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="inicio.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Inicio</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class='row'>
          <div id='pone_compras'></div>
          <div id='pone_ventas'></div>
          <div id='pone_gastos'></div>
          <div id='pone_users'></div>
          <div class='col-md-6'>
          <!-- solid sales graph -->
              <div class="box box-solid">
                <div class="box-header">
                  <i class="fa fa-th"></i>
                  <h3 class="box-title">Grafica de ventas por lineas ($).</h3>
                  <div class="box-tools pull-right">
                    <button class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
                </div>
                <div class="box-body border-radius-none">
                  <div class="chart" id="line-chart-ventas" style="height: 250px;"></div>
                </div><!-- /.box-body -->
                <div class="box-footer no-border">

                </div><!-- /.box-footer -->
              </div><!-- /.box -->
          </div>

          <div class='col-md-6'>
          <!-- solid sales graph -->
              <div class="box box-solid">
                <div class="box-header">
                  <i class="fa fa-th"></i>
                  <h3 class="box-title">Grafica de existencias por lineas ($).</h3>
                  <div class="box-tools pull-right">
                    <button class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
                </div>
                <div class="box-body border-radius-none">
                  <div class="chart" id="line-chart-existe" style="height: 250px;"></div>
                </div><!-- /.box-body -->
                <div class="box-footer no-border">

                </div><!-- /.box-footer -->
              </div><!-- /.box -->
          </div>

          </div>

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <!-- Main Footer -->
      <?php include('./class_lib/main_fotter.php'); ?>
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    <div class="MsjAjaxForm"></div>
    <?php include "./class_lib/scripts.php"; ?>
    <script src="plugins/morris/morris.min.js"></script>
    <script src="plugins/morris/raphael-min.js"></script>
    <script src="dist/js/source_init.js"></script>
  </body>
</html>
