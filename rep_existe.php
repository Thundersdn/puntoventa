<?php include "./class_lib/sesionSecurity.php"; ?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
  <head>
    <title>Reportes|Rep. de Existencias</title>
    <?php include "./class_lib/links.php"; ?>
    <link rel="stylesheet" href="plugins/select2/select2.min.css">
    <link rel="stylesheet" href="plugins/printarea/jquery.printarea.css">
    <link rel="stylesheet" href="plugins/datepicker/css/bootstrap-datepicker3.css">

  </head>
  <body onload="pone_opcion_existe();">

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


        ?>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Reportes | Reportes de Existencias.
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="inicio.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Reportes de Existencias.</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Your Page Content Here -->
          <div class='row'>
          <div class='col-md-6'>
          <div class='box box-primary'>
          <div class='box-header with-border'>
          <h3 class='box-title'>Ingresa la Fecha...</h3>
          </div>
          <div class='box-body'>
            <div class="input-group">
            <span class='input-group-addon bg-purple'><i class="fa fa-calendar"></i> Fecha:</span>
             <input type="text" class="form-control pull-right" id="fecha" onchange="" autocomplete="off">
            </div><!-- /.form group -->
          </div>

          </div>
          </div>

          <div class='col-md-6'>
          <div id='opcion'></div>
          </div>

          </div>

          <div class='row'>
          <div class='col-md-12'>
          <div id='existencias'></div>
          </div>
          </div>
        </section><!-- /.content -->
         </div><!-- /.content-wrapper -->

     <div class="modal fade" id ="modal_tabla_detalle_existe" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
            <h4 class="modal-title">Detalle de Existencias:</h4>
          </div>
          <div class="modal-body">
            <div id='detalle_exis' class='printing'></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" onclick='print_detalle_existe();'><i class='fa fa-print'></i> Imprimir</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

      <!-- Main Footer -->
      <?php
      include('class_lib/main_fotter.php');
      ?>


      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    <!-- REQUIRED JS SCRIPTS -->
    <div class="MsjAjaxForm"></div>
    <?php include "./class_lib/scripts.php"; ?>
    <script src="plugins/select2/select2.full.min.js"></script>
    <script src="plugins/fastclick/fastclick.min.js"></script>
    <script src="plugins/datepicker/js/bootstrap-datepicker.js"></script>
    <script src="plugins/datepicker/locales/bootstrap-datepicker.es.min.js"></script>
    <script src="plugins/printarea/jquery.printarea.js"></script>
    <script src="plugins/moment/moment.min.js"></script>
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script src="plugins/fastclick/fastclick.min.js"></script>
    <script src="dist/js/source_report.js"></script>
    <script>
    $("#fecha").datepicker({
      language: "es",
      format: "yyyy-mm-dd"
    });
    </script>
  </body>
</html>