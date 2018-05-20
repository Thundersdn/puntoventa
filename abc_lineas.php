<?php include "./class_lib/sesionSecurity.php"; ?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
  <head>
    <title>Lineas</title>
    <?php include "./class_lib/links.php"; ?>
    <link rel="stylesheet" href="plugins/select2/select2.min.css">
    <link rel="stylesheet" href="dist/css/skins/skin-purple.min.css">
    <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
  </head>
  <body onload="pone_lista_lineas();">

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
            Mantenimiento de Lineas.
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="inicio.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Mtto. de Lineas.</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Your Page Content Here -->
          <div class='row'>
           <div class='col-md-12'>
             <div class='nav-tabs-custom'>
                  <ul class="nav nav-tabs pull-right">
                  <li><a href="#cambios" data-toggle="tab">Cambios</a></li>
                  <li><a href="#bajas" data-toggle="tab">Baja</a></li>
                  <li class="active"><a href="#altas" data-toggle="tab">Alta</a></li>

                  <li class="pull-left header"><i class="fa fa-file-text"></i> Operaciones con Lineas.</li>
                </ul>
               <div class="tab-content">
                  <div class="tab-pane active" id="altas">
                    <form class="form-horizontal">

                    <div class='form-group'>
                    <label for="linea" class="col-sm-2 control-label">Linea:</label>
                    <div class="col-sm-2">
                    <input type="text" class="form-control cantidades" id='linea' placeholder='# Linea'
                    data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 0, 'digitsOptional': false">
                    </div>
                    </div>

                    <div class='form-group'>
                    <label for="grupo" class="col-sm-2 control-label">Grupo:</label>
                    <div class="col-sm-2">
                    <input type="text" class="form-control cantidades" id='grupo' placeholder='# Grupo'
                    data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 0, 'digitsOptional': false">
                    </div>
                    </div>

                    <div class='form-group'>
                    <label for="descripcion" class="col-sm-2 control-label">Descripcion:</label>
                    <div class="col-sm-7">
                    <input type="text" class="form-control" id='descripcion' placeholder='Descripcion...'>
                    </div>
                    </div>

                    <br>
                    <div class="btn-group">
                    <button type='button' class='btn btn-primary btn-lg' onclick='procesa_lineas();' id='btn-altas'><i class='fa fa-check-circle'></i> Registrar linea.</button>
                    </div>
                    </form>
                  </div><!-- /.tab-pane -->

                  <div class="tab-pane" id="bajas">
                    <form class="form-horizontal">

                    <div class='form-group'>
                    <label for="linea" class="col-sm-2 control-label">Linea:</label>
                    <div class="col-sm-2">
                    <input type="text" class="form-control cantidades" id='linea_baja' placeholder='# Linea' onblur="busca_linea();"
                    data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 0, 'digitsOptional': false">
                    <br>
                    <div id='linea_baja_descripcion'></div>
                    </div>
                    </div>

                    <div class='form-group'>
                    <label for="grupo" class="col-sm-2 control-label">Grupo:</label>
                    <div class="col-sm-2">
                    <input type="text" class="form-control cantidades" id='grupo_baja' placeholder='# Grupo' onblur="busca_grupo();"
                    data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 0, 'digitsOptional': false" disabled>
                    <br>
                    <div id='grupo_baja_descripcion'></div>
                    </div>
                    </div>

                    <br>
                    <div class="btn-group">
                    <button type='button' class='btn btn-danger btn-lg' onclick='procesa_lineas_baja();' id='btn-bajas' disabled><i class='fa fa-check-circle'></i> Eliminar.</button>
                    </div>
                    </form>
                  </div><!-- /.tab-pane -->


                  <div class="tab-pane" id="cambios">
                    <form class="form-horizontal">

                    <div class='form-group'>
                    <label for="linea" class="col-sm-2 control-label">Linea:</label>
                    <div class="col-sm-2">
                    <input type="text" class="form-control cantidades" id='linea_cambia' onblur='busca_linea_cambia();' placeholder='# Linea'
                    data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 0, 'digitsOptional': false">
                    <br>
                    <div id='linea_cambia_descripcion'></div>
                    </div>
                    </div>

                    <div class='form-group'>
                    <label for="grupo" class="col-sm-2 control-label">Grupo:</label>
                    <div class="col-sm-2">
                    <input type="text" class="form-control cantidades" id='grupo_cambia' onblur='busca_grupo_cambia();' placeholder='# Grupo'
                    data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 0, 'digitsOptional': false" disabled>
                    <br>
                    <div id='grupo_cambia_descripcion'></div>
                    </div>
                    </div>

                    <div class='form-group'>
                    <label for="descripcion" class="col-sm-2 control-label">Descripcion:</label>
                    <div class="col-sm-7">
                    <input type="text" class="form-control" id='descripcion_cambia' placeholder='Descripcion...' disabled>
                    </div>
                    </div>

                    <br>
                    <div class="btn-group">
                    <button type='button' class='btn btn-primary btn-lg' onclick='actualiza_lineas();' id='btn-actualiza' disabled><i class='fa fa-recycle'></i> Actualizar.</button>
                    </div>
                    </form>
                  </div><!-- /.tab-pane -->
                </div><!-- /.tab-content -->

             </div>
           </div>

           <div class='col-md-12'>
           <div id='lista_lineas'></div>
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
    <script src="plugins/select2/select2.full.min.js"></script>
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script src="dist/js/source_lines.js"></script>
    <script>
      $(document).ready(function(){
        $(".cantidades").inputmask();
      });
    </script>
  </body>
</html>