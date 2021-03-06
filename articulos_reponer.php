<?php include "./class_lib/sesionSecurity.php"; ?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
  <head>
    <title>Articulos a reponer</title>
    <?php include "./class_lib/links.php"; ?>
    <link rel="stylesheet" href="plugins/select2/select2.min.css">
    <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
  </head>
  <body onload="pone_lista_Reponer();">

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
            Articulos Con Stock Minimo.
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="inicio.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Art. Por Venver.</li>
          </ol>
        </section>


        <section class="content">

          <div class='row'>
           <div class='col-md-12'>
             <div class='nav-tabs-custom'><!--
                  <ul class="nav nav-tabs pull-right">
                  <li><a href="#cambios" data-toggle="tab">Cambios</a></li>
                  <li><a href="#bajas" data-toggle="tab">Baja</a></li>
                  <li class="active"><a href="#altas" data-toggle="tab">Alta</a></li>

                  <li class="pull-left header"><i class="fa fa-file-text"></i> Lista de Articulos Que estan Por Vencer.</li>
                </ul>
		
			-->
           <div class='col-md-12'>
           <div id='lista_Reponer'></div>
           </div>
			
          </div>


        </section>
         </div>


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
		<!-- jQuery 3.1.1 -->
	<script src="./js/jquery-3.1.1.min.js"></script>
	<!-- Bootstrap 3.3.7 -->
	<script src="./js/bootstrap.min.js"></script>
	<!-- Script AjaxForms-->
	<script src="./js/AjaxForms.js"></script>
	<!-- Sweet Alert 2-->
	<script src="./js/sweetalert2.min.js"></script>
	<!-- AdminLTE App -->
	<script src="dist/js/app.js"></script>

    <?php# include "./class_lib/scripts.php"; ?>
    <script src="plugins/fastclick/fastclick.min.js"></script>
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script src="plugins/noty/packaged/jquery.noty.packaged.min.js"></script>
    <script src="plugins/number/jquery.inputmask.bundle.js"></script>
    <script src="plugins/noty/packaged/jquery.noty.packaged.min.js"></script>
    <script src="plugins/select2/select2.full.min.js"></script>
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script src="dist/js/source_reponer.js"></script>
	<script src="./js/main.js"></script>
    <script>
    $(document).ready(function(){
    $(".cantidades").inputmask();
    });
    </script>
  </body>
</html>