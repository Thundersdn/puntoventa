<?php include "./class_lib/sesionSecurity.php"; ?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
  <head>
    <title>SerMac | Software</title>
    <?php include "./class_lib/links.php"; ?>
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
        $opt=$_GET['opt'];
        ?>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Respaldo de la Base de Datos.
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="inicio.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Respaldo de BD</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
         <!-- Your Page Content Here -->
         <div class='col-md-12'>
         <div class='box box-primary'>
         <div class='box-header'>
          <h3>Utilidad para generar respaldo de la Base de Datos.</h3>
         </div>
         <div class='box-footer'>
         <button type='button' class='btn btn-primary pull-right' onclick="respalda();" id='btn-genera'><i class='fa fa-thumbs-up'></i> Generar Respaldo.</button>
         </div>
         </div>
         </div>
         <div class='col-md-6'>
         <div id='respuesta'></div>
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
    <script src="dist/js/source_utils.js"></script>
  </body>
</html>