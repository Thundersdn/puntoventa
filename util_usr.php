<?php include "./class_lib/sesionSecurity.php"; ?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
  <head>
    <title>Usuarios</title>
    <?php include "./class_lib/links.php"; ?>
  </head>
  <body onload="pone_users_registrados();">

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
        ?>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
          Movimientos de Usuarios.
              <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="inicio.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Usuarios</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
         <div class='row'>
         <div class='col-md-12'>
         <div class='box box-warning'>
         <div class="box-header with-border">
         <h3 class='box-title'>Crear nuevo usuario</h3>
         </div>
         <div class='box-body'>
         <form class="form-horizontal">
         <div class='form-group'>
                    <label for="codigo" class="col-sm-2 control-label">Nombre completo:</label>
                    <div class="col-sm-5">
                    <input type="text" class="form-control" id='nombre' placeholder='Nombre del usuario...' required>
                    </div>
                    </div>

         <div class='form-group'>
                    <label for="codigo" class="col-sm-2 control-label">Usuario:</label>
                    <div class="col-sm-3">
                    <input type="text" class="form-control" id='clave' placeholder='Clave del usuario...' required>
                    </div>
                    </div>

         <div class='form-group'>
                    <label for="codigo" class="col-sm-2 control-label">Password:</label>
                    <div class="col-sm-3">
                    <input type="password" class="form-control" id='pass' placeholder='Password del usuario...' required>
                    </div>
                    </div>

         </form>
         </div>
         <div class='box-footer'>
         <button type='button' class='btn btn-danger pull-right' onclick='registra_usr();' id='btn-reg-usr'>Registrar</button>
         </div>
         </div>
         </div>

         <div class='col-md-12'>
         <div id='users_registrados'></div>
         </div>
         </div>
          <!-- Your Page Content Here -->

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
    <script src="dist/js/source_parameters.js"></script>
  </body>
</html>