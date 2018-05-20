<?php include "./class_lib/sesionSecurity.php"; ?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
  <head>
    <title>Cancelaciones de Ventas</title>
    <?php include "./class_lib/links.php"; ?>
    <link rel="stylesheet" href="plugins/select2/select2.min.css">
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker-bs3.css">
    <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
  </head>
  <body>
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
            Cancelacion de Ventas
            <small>Credito y/o contado.</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="inicio.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Cancelacion de venta.</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Your Page Content Here -->
          <div class='row'>
         <div class='col-md-6'>
         <div class='box box-primary'>
         <div class='box-header with-border'>
         <h4 class='title'>Busqueda de la venta.</h4>
         </div>
         <div class='box-body'>
         <form class='form-horizontal'>
         <div class='form-group'>
            <label for="tipo_buscar" class="col-sm-4 control-label">Buscar por:</label>
             <div class="col-sm-6">
                <select class='form-control' id='tipo_buscar' onchange='limpia_divs();'>
                <option value='1'>Por un rango de Fecha.</option>
                <option value='2'>Por numero de Ticket.</option>
                </select>
             </div>
          </div>
          </form>
         </div>
         <div class='box-footer'>
         <button type='button' class='btn btn-primary btn-raised pull-right' onclick='genera_opcion();'><i class='fa fa-thumbs-up'></i> Continuar...</button>
         </div>
         </div>
         </div>
         <div class='col-md-6'>
         <div id='pone_opcion'></div>
         </div>
         </div>
         <div class='row'>
         <div class='col-md-12'>
         <div id='data'></div>
         </div>
         </div>
        </section><!-- /.content -->


        <div class="modal fade" id ="modal_detalle_venta" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
            <h4 class="modal-title nuticket"></h4>
          </div>
          <div class="modal-body">
            <div id='detalle_de_venta'></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
      </div><!-- /.content-wrapper -->

      <!-- Main Footer -->
      <?php
      include('class_lib/main_fotter.php');
      ?>


      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->
    
    <div class="MsjAjaxForm"></div>
    <?php include "./class_lib/scripts.php"; ?>
    <script src="plugins/fastclick/fastclick.min.js"></script>
    <script src="plugins/select2/select2.full.min.js"></script>
    <script src="plugins/datepicker/js/bootstrap-datepicker.js"></script>
    <script src="plugins/datepicker/locales/bootstrap-datepicker.es.min.js"></script>
    <script src="plugins/moment/moment.min.js"></script>
    <script src="plugins/noty/packaged/jquery.noty.packaged.min.js"></script>
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script src="plugins/number/jquery.inputmask.bundle.js"></script>
    <script src="dist/js/source_utils.js"></script>
    <script>
    $(document).ready(function(){
      $(".select2").select2();

    })
    </script>
  </body>
</html>
