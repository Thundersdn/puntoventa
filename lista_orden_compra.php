<?php include "./class_lib/sesionSecurity.php"; ?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
  <head>
    <title>Ordenes</title>
    <?php include "./class_lib/links.php"; ?>
    <link rel="stylesheet" href="plugins/select2/select2.min.css">
    <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="plugins/datepicker/css/bootstrap-datepicker3.css">
  </head>
  <body onload="lista_ordenes();">

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
                <!-- Main content -->
        <section class="content">

          <!-- Your Page Content Here -->
          <div class='row'>
           <div class='col-md-12'>


           </div>

           <div class='col-md-12'>
           <div id='lista_ordenes'>
           </div>
           </div>
          </div>


        </section><!-- /.content -->
         </div><!-- /.content-wrapper -->


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
    <script src="plugins/fastclick/fastclick.min.js"></script>
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script src="plugins/noty/packaged/jquery.noty.packaged.min.js"></script>
    <script src="plugins/number/jquery.inputmask.bundle.js"></script>
    <script src="plugins/noty/packaged/jquery.noty.packaged.min.js"></script>
    <script src="plugins/uploadify/jquery.uploadify.js"></script>
    <script src="plugins/select2/select2.full.min.js"></script>
    <script src="plugins/datepicker/js/bootstrap-datepicker.js"></script>
    <script src="plugins/datepicker/locales/bootstrap-datepicker.es.min.js"></script>
    <script src="dist/js/source_lista_orden.js"></script>
	<script src="dist/js/definicion_inputmask.js"></script>
    <script>
      $(document).ready(function(){
      $(".cantidades").inputmask();
      });

      $("#fecha_caducidad").datepicker({
        language: "es",
        format: "yyyy-mm-dd"
      });
    </script>
  </body>
</html>
