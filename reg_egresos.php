<?php include "./class_lib/sesionSecurity.php"; ?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
  <head>
    <title>Registro de Gastos</title>
    <?php include "./class_lib/links.php"; ?>
    <link rel="stylesheet" href="plugins/select2/select2.min.css">
    <link rel="stylesheet" href="plugins/printarea/jquery.printarea.css">
    <link rel="stylesheet" href="plugins/datepicker/css/bootstrap-datepicker3.css">
  </head>
  <body onload="">

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
            Registro de Gastos
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="inicio.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Registro de Gastos.</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Your Page Content Here -->
          <div class='row'>
          <div class='col-md-12'>
          <div class='box box-primary'>
          <div class='box-header with-border'>
          <h3 class='box-title'>Datos del gasto...</h3>
          </div>
          <div class='box-body'>
           <form class="form-horizontal">

                    <div class='form-group'>
                    <label for="codigo" class="col-sm-2 control-label">Fecha:</label>
                    <div class="col-sm-2">
                    <input type="text" class="form-control" id="fecha" autocomplete="off" placeholder='Fecha del gasto...'>
                    </div>
                    </div>

                    <div class='form-group'>
                    <label for="codigostock" class="col-sm-2 control-label">Numero de Doc. Origen:</label>
                    <div class="col-sm-2">
                    <input type="text" class="form-control" id='num_dock' placeholder='Numero de comprobante...'>
                    </div>
                    </div>

                    <div class='form-group'>
                    <label for="descripcion" class="col-sm-2 control-label">Proveedor:</label>
                    <div class="col-sm-6">
                    <input type="text" class="form-control" id='proveedor' placeholder='Nombre de proveedor del gasto...'>
                    </div>
                    </div>

                    <div class='form-group'>
                    <label for="descripcion" class="col-sm-2 control-label">Concepto:</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id='concepto' placeholder='Concepto o comentarios acerca del gasto...'>
                    </div>
                    </div>

                    <div class='form-group'>
                    <label for="costo" class="col-sm-2 control-label">SubTotal:</label>
                    <div class="col-sm-2">
                    <input type="text" class="form-control cantidades" id='subtotal' placeholder='Subtotal...'
                     data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'placeholder': '0'">
                    </div>
                    </div>

                    <div class='form-group'>
                    <label for="precio" class="col-sm-2 control-label">IVA (16%):</label>
                    <div class="col-sm-2">
                    <input type="text" class="form-control cantidades" id='iva' placeholder='IVA...'
                     data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'placeholder': '0'">
                    </div>
                    </div>

                    <div class='form-group'>
                    <label for="precio" class="col-sm-2 control-label">Total:</label>
                    <div class="col-sm-2">
                    <input type="text" class="form-control cantidades" id='total' placeholder='Total del Doc...'
                     data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'placeholder': '0'">
                    </div>
                    </div>



                    <br>
                    <div class="btn-group">
                    <button type='button' class='btn btn-primary btn-lg' onclick='alta_gasto();' id='btn-altas'><i class='fa fa-check-circle'></i> Registrar el gasto.</button>
                    <button type='button' class='btn btn-danger btn-lg' onclick='cancela_campos_gasto();' id='btn-alta-cancela'><i class='fa fa-times'></i> Cancelar.</button>
                    </div>
                    </form>

          </div>

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
    <script src="plugins/datepicker/js/bootstrap-datepicker.js"></script>
    <script src="plugins/datepicker/locales/bootstrap-datepicker.es.min.js"></script>
    <script src="plugins/moment/moment.min.js"></script>
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
    <script src="plugins/number/jquery.inputmask.bundle.js"></script>
    <script src="plugins/noty/packaged/jquery.noty.packaged.min.js"></script>
    <script src="dist/js/source_utils.js"></script>
    <script>
    $("#fecha").datepicker({
      language: "es",
      format: "yyyy-mm-dd"
    });

    $(".cantidades").inputmask();
    </script>
  </body>
</html>