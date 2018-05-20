<?php include "./class_lib/sesionSecurity.php"; ?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
  <head>
    <title>Happy Cake</title>
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

        ?>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Ajuste de Inventarios.
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="inicio.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Ajuste de Inventarios</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
         <!-- Your Page Content Here -->
         <div class='col-md-4'>
         <div class='box box-primary'>
         <div class='box-header with-border'>
         <h3 class='box-title'>Ingresa el codigo del articulo...</h3>
         </div>
         <div class='box-body'>
         <form class='form-horizontal'>
            <div class='form-group'>
                    <label for="codigo" class="col-sm-2 control-label">Codigo:</label>
                    <div class="col-sm-6">
                    <input type="text" class="form-control" id='codigo' placeholder='Codigo del articulo...' onchange='busca_articulo();' required autofocus>
                    </div>
            </div>
            <div class='form-group'>
                    <label for="descripcion" class="col-sm-2 control-label">Descripcion:</label>
                    <div class="col-sm-12">
                    <input type="text" class="form-control" id='descripcion' placeholder='Aqui aparece la descripcion...' disabled>
                    </div>
            </div>
            <div class='form-group'>
                   <label for="exis_anterior" class="col-sm-2 control-label">Anterior:</label>
                    <div class="col-sm-5">
                    <input type="text" class="form-control" id='exis_anterior' placeholder='Existencia...' disabled>
                    </div>
            </div>
            <div class='form-group'>
                    <label for="exis_actual" class="col-sm-2 control-label">Actual:</label>
                    <div class="col-sm-5">
                    <input type="text" class="form-control cantidades" id='exis_actual' placeholder='Existencia...'
                    data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false" disabled>
                    </div>
            </div>
          </form>
         </div>
         <div class='box-footer'>
         <button type='button' class='btn btn-primary pull-left' onclick='verifica_tabla_existencia();agrega_a_lista();'><i class='fa fa-plus'></i> Agregar a la lista.</button>
         <button type='button' class='btn btn-danger pull-right' onclick='cancela();'><i class='fa fa-times'></i> Cancelar.</button>
         </div>
         </div>
         </div>
         <div class='col-md-8'>
         <div class='box box-primary'>
         <div class='box-header with-border'>
         <h3 class='box-title'>Articulos en la lista...</h3>
         </div>
         <div class='box-body'>
         <table id='lista_articulos_existencias' class='table table-bordered'>
         <thead>
         <tr>
         <th>Codigo</th><th>Descripcion</th><th>Ex. Anterior</th><th>Ex. Nueva</th><th>Diferencia</th><th>Tipo</th><th>Eliminar</th>
         </tr>
         </thead>
         <tbody>
         </tbody>
         </table>
         </div>
         <div class='box-footer'>
         <button class='btn btn-primary pull-right' onclick='procesa_lista_ajustes();'><i class='fa fa-thumbs-up'></i> Procesar lista...</button>
         <button class='btn btn-danger pull-left' onclick='cancela_todo();'><i class='fa fa-trash-o'></i> Cancelar...</button>
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
    <script src="dist/js/source_ajuinvs.js"></script>
    <script src="plugins/number/jquery.inputmask.bundle.js"></script>
    <script src="plugins/noty/packaged/jquery.noty.packaged.min.js"></script>
  </body>
</html>